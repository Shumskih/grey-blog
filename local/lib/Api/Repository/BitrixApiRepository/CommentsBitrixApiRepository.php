<?php


namespace App\Api\Repository\BitrixApiRepository;


use App\Api\Comment;
use App\Api\Repository\BitrixApiRepository\Dao\CommentsBitrixApiDao;
use App\Api\User;
use App\Helpers\DateHelper;
use CIBlockResult;

class CommentsBitrixApiRepository implements BitrixApiRepository
{
    /**
     * @var array User::class
     */
    private $users;
    /**
     * @var array
     */
    private $usersIds;
    /**
     * @var CommentsBitrixApiDao
     */
    private $dao;

    public function __construct()
    {
        $this->dao = new CommentsBitrixApiDao();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param int $id
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param array $articlesIds
     * @return array
     */
    public function getCountByArticleIds(array $articlesIds)
    {
        $result = $this->dao->getCountByArticleIds($articlesIds);

        $countComments = [];

        while ($c = $result->Fetch()) {
            $countComments[$c['PROPERTY_ARTICLE_ID_VALUE']] = $c['CNT'];
        }

        return $countComments;

    }

    /**
     * @param int $articleId
     * @return array
     */
    public function getComments(int $articleId)
    {
        $parentComments = $this->getParentComments($articleId);
        $childComments = $this->getChildComments($parentComments['parentCommentsIds']);
        $answers = $this->setAnswers($parentComments, $childComments);

        return $this->getCombined($parentComments, $answers);
    }

    /**
     * @param int $articleId
     * @return array
     */
    private function getParentComments(int $articleId)
    {
        $result = $this->dao->getParentComments($articleId);
        return $this->getArrayOfCommentObjects($result, $parentCommentsIds = true);
    }

    /**
     * @param array $parentCommentsIds
     * @return array
     */
    public function getChildComments(array $parentCommentsIds)
    {
        $result = $this->dao->getChildComments($parentCommentsIds);
        return $this->getArrayOfCommentObjects($result);
    }

    /**
     * @param CIBlockResult $result
     * @param bool $parentCommentsIds
     * @return array
     */
    public function getArrayOfCommentObjects(CIBlockResult $result, bool $parentCommentsIds = false): array
    {
        $array = [];

        while ($arFields = $result->GetNext(true, false)) {
            $comment = $this->createComment($arFields['ID'], $arFields['DETAIL_TEXT'], DateHelper::getCommentsDate($arFields['ACTIVE_FROM']), (integer)$arFields['PROPERTY_PARENT_COMMENT_ID_VALUE']);

            $array['comments'][] = $comment;
            $this->usersIds[] = $arFields["CREATED_BY"];

            if ($parentCommentsIds) {
                $array['parentCommentsIds'][] = $arFields['ID'];
            }

            $this->getUsers();
            $comment->setUser($this->getUser($arFields["CREATED_BY"]));

            unset($comment);
        }

        return $array;
    }

    /**
     * @param array $parentComments
     * @param array $answers
     * @return array
     */
    public function getCombined(array $parentComments, array $answers)
    {
        $combined = [];

        foreach ($parentComments['comments'] as $parent) {
            if ($answers[$parent->getId()]) {
                $parent->setAnswers($answers[$parent->getId()]);
            }
            $combined[] = $parent;
        }

        return $combined;
    }

    /**
     * @param array $parentComments
     * @param array $childComments
     * @return array
     */
    private function setAnswers(array $parentComments, array $childComments)
    {
        $answers = [];

        foreach ($parentComments['comments'] as $parent) {
            foreach ($childComments['comments'] as $child) {
                if ($child->getParentCommentId() == $parent->getId()) {
                    $answers[$parent->getId()][] = $child;
                }
            }
        }

        return $answers;
    }

    /**
     * @param string $id
     * @param string $text
     * @param string $date
     * @param string|NULL $parentCommentId
     * @return Comment
     */
    public function createComment(string $id, string $text, string $date, string $parentCommentId = NULL)
    {
        $comment = new Comment();
        $comment->create($id, $text, $date, $parentCommentId);

        return $comment;
    }

    /**
     * @return void
     */
    public function getUsers()
    {
        $user = new User();
        $this->users = $user->getUsersList($this->usersIds);
    }

    /**
     * @param string $commentCreatedBy
     * @return mixed
     */
    public function getUser(string $commentCreatedBy)
    {
        foreach ($this->users as $user)
        {
            if ($user->getId() == $commentCreatedBy)
                return $user;
        }
    }
}