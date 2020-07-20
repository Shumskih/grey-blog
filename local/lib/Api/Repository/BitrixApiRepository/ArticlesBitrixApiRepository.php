<?php


namespace App\Api\Repository\BitrixApiRepository;


use App\Api\Article;
use App\Api\Category;
use App\Api\Comment;
use App\Api\Pagination;
use App\Api\Repository\BitrixApiRepository\Dao\ArticlesBitrixApiDao;
use App\Api\Repository\BitrixApiRepository\Dao\CommentsBitrixApiDao;
use App\Api\User;
use App\Helpers\DateHelper;
use CIBlockResult;

class ArticlesBitrixApiRepository implements BitrixApiRepository
{
    /**
     * @var array
     */
    private $articles;
    /**
     * @var array
     */
    private $articlesIds;
    /**
     * @var array
     */
    private $authorsIds;

    /**
     * @var ArticlesBitrixApiDao
     */
    private $dao;

    public function __construct()
    {
        $this->dao = new ArticlesBitrixApiDao();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $result = $this->dao->getAll();

        return $this->toArrayOfArticleObjects($result);
    }

    /**
     * @param int $id
     * @return void
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param int $nTopCount
     * @return array
     */
    public function getTopArticles(int $nTopCount)
    {
        $result = $this->dao->getTopArticles($nTopCount);

        return $this->toArrayOfArticleObjects($result);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getByCategoryId(int $id)
    {
        $result = $this->dao->getByCategoryId($id);

        return $this->toArrayOfArticleObjects($result);
    }

    /**
     * @param int $nTopCount
     * @return array
     */
    public function getMostCommentedArticlesIds(int $nTopCount)
    {
        $array = [];

        $commentsDao = new CommentsBitrixApiDao();
        $result = $commentsDao->getMostCommentedArticlesIds($nTopCount);
        unset($commentsDao);

        while ($r = $result->GetNext(true, false)) {
            $array['articleIds'][] = $r['PROPERTY_ARTICLE_ID_VALUE'];
            $array['commentsCount'][] = $r;
        }

        return $array;
    }

    /**
     * @param array $articleIds
     * @param array $commentsCount
     * @return array
     */
    public function getMostCommentedArticles(array $articleIds, array $commentsCount): array
    {
        $array = [];

        $result = $this->dao->getMostCommentedArticles($articleIds);

        while ($r = $result->GetNext(true, false)) {
            foreach ($commentsCount as $count) {
                if ($r['ID'] == $count['PROPERTY_ARTICLE_ID_VALUE']) {
                    $r['COMMENTS_COUNT'] = $count['CNT'];
                }
            }

            $array[] = $r;
        }

        return $array;
    }

    /**
     * Сортирует по количеству комментариев от максимального к минимальному
     * @param array $articles
     * @return array
     */
    public function sort(array $articles)
    {
        $array = $articles;

        usort($array, function ($a, $b) {
            return $b['COMMENTS_COUNT'] - $a['COMMENTS_COUNT'];
        });
        unset($articles);

        return $array;
    }

    /**
     * @param int $nTopCount
     * @return array
     */
    public function getMostCommented(int $nTopCount)
    {
        $array = $this->getMostCommentedArticlesIds($nTopCount);

        $articles = $this->getMostCommentedArticles($array['articleIds'], $array['commentsCount']);

        $articles = $this->sort($articles);

        return $this->toArrayOfArticleObjects($articles);
    }

    /**
     * @param CIBlockResult $result
     */
    private function fromCIBlockResult(CIBlockResult $result)
    {
        while ($arFields = $result->GetNext(true, false)) {
            $this->createArticle(
                $arFields['ID'],
                $arFields['ACTIVE_FROM'],
                $arFields['CREATED_BY'],
                $arFields['NAME'],
                $arFields['PREVIEW_TEXT'],
                $arFields['PREVIEW_PICTURE']
            );
        }
    }

    /**
     * @param array $articles
     */
    private function fromArray(array $articles)
    {
        foreach ($articles as $article) {
            $this->createArticle(
                $article['ID'],
                $article['ACTIVE_FROM'],
                $article['CREATED_BY'],
                $article['NAME'],
                $article['PREVIEW_TEXT'],
                $article['PREVIEW_PICTURE']
            );
        }
    }

    /**
     * @param string $id
     * @param string $activeFrom
     * @param string $createdBy
     * @param string $name
     * @param string $previewText
     * @param int $previewPicture
     */
    private function createArticle(string $id, string $activeFrom, string $createdBy, string $name, string $previewText, int $previewPicture)
    {
        $article = new Article();
        $article->create(
            $id,
            DateHelper::getArticleDateForApi($activeFrom),
            $createdBy,
            $name,
            $previewText,
            (integer)$previewPicture
        );

        $this->authorsIds[] = $createdBy;
        $this->articlesIds[] = $id;

        $this->articles[] = $article;

        unset($article);
    }

    /**
     * @param CIBlockResult|array $data
     * @return array
     */
    public function toArrayOfArticleObjects($data)
    {
        if (is_a($data, CIBlockResult::class)) {
            $this->fromCIBlockResult($data);
        }
        if (is_array($data)) {
            $this->fromArray($data);
        }

        $this->articles = $this->getAuthors($this->articles, $this->authorsIds);
        $this->articles = $this->getCategories($this->articles, $this->articlesIds);
        $this->articles = $this->getCountComments($this->articlesIds, $this->articles);

        if (is_a($data, CIBlockResult::class)) {
            $navParams = Pagination::getInstance();
            $this->articles['paginationData'] = $navParams->getPaginationData($navParams, $data);
        }

        return $this->articles;
    }

    /**
     * @param array $articlesIds
     * @param array $articles
     * @return array
     */
    private function getCountComments(array $articlesIds, array $articles)
    {
        $comment = new Comment();
        $count = $comment->getCountByArticleIds($articlesIds);
        unset($comment);

        $articlesNew = [];

        foreach ($articles as $article) {
            if (isset($count[$article->getId()])) {
                $article->setCountComments($count[$article->getId()]);
            }
            $articlesNew[] = $article;
        }

        return $articlesNew;
    }

    /**
     * @param array $articles
     * @param array $articleIds
     * @return array
     */
    private function getCategories(array $articles, array $articleIds)
    {
        $category = new Category();
        $categories = $category->getByArticleIds($articleIds);
        unset($category);

        $articlesNew = [];

        foreach ($articles as $article) {
            if (isset($categories[$article->getId()])) {
                $article->setCategories($categories[$article->getId()]);

                $articlesNew[] = $article;
            }
        }

        return $articlesNew;
    }

    /**
     * @param array $articles
     * @param array $authorIds
     * @return array
     */
    public function getAuthors(array $articles, array $authorIds)
    {
        $user = new User();
        $users = $user->getUsersList($authorIds);
        unset($user);

        $articlesNew = [];

        foreach ($articles as $article) {
            foreach ($users as $user) {
                if ($article->getCreatedBy() == $user->getId()) {
                    $article->setAuthor($user);

                    $articlesNew[] = $article;
                }
            }
        }

        return $articlesNew;
    }
}