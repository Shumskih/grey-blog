<?php


namespace App\Api;


use App\Api\Repository\ArticlesRepository;
use App\Api\Repository\BitrixApiRepository\ArticlesBitrixApiRepository;
use CFile;

class Article extends Entity
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $preview;
    /**
     * @var string
     */
    private $text;
    /**
     * @var string
     */
    private $createdBy;
    /**
     * @var string
     */
    private $activeFrom;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $img;
    /**
     * @var string
     */
    private $date;
    /**
     * @var array
     */
    private $categories;
    /**
     * @var User
     */
    private $author;
    /**
     * @var array
     */
    private $comments;
    /**
     * @var string
     */
    private $countComments;
    /**
     * @var int
     */
    private $iBlockElementId;
    /**
     * @var ArticlesBitrixApiRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new ArticlesRepository();
    }

    /**
     * @param string $id
     * @param string $activeFrom
     * @param string $createdBy
     * @param string $title
     * @param string $previewText
     * @param int $img
     * @return $this
     */
    public function create(string $id, string $activeFrom, string $createdBy, string $title, string $previewText, int $img)
    {
        $this->id = $id;
        $this->activeFrom = $activeFrom;
        $this->createdBy = $createdBy;
        $this->title = $title;
        $this->preview = $previewText;
        $this->img = $img;

        return $this;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getByCategoryId(int $id)
    {
        return $this->repository->get()->getByCategoryId($id);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->repository->get()->getAll();
    }

    /**
     * @param int $nTopCount
     * @return array
     */
    public function getTopArticles(int $nTopCount)
    {
        return $this->repository->get()->getTopArticles($nTopCount);
    }

    /**
     * @param int $nTopCount
     * @return array
     */
    public function getMostCommented(int $nTopCount)
    {
        return $this->repository->get()->getMostCommented($nTopCount);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'date' => $this->getActiveFrom(),
            'title' => $this->getTitle(),
            'preview' => $this->getPreview(),
            'img' => $this->getImg(),
            'countComments' => $this->getCountComments(),
            'author' => $this->getAuthor(),
            'categories' => $this->getCategories()
        ];
    }

    /**
     * @param int $id
     * @return string|null
     */
    private function getImagePath(int $id)
    {
        return CFile::GetPath($id);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Article
     */
    public function setId(string $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     * @return Article
     */
    public function setCreatedBy(string $createdBy): Article
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     * @return Article
     */
    public function setPreview(string $preview): Article
    {
        $this->preview = $preview;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Article
     */
    public function setText(string $text): Article
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getActiveFrom(): string
    {
        return $this->activeFrom;
    }

    /**
     * @param string $activeFrom
     * @return Article
     */
    public function setActiveFrom(string $activeFrom): Article
    {
        $this->activeFrom = $activeFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Article
     */
    public function setUrl(string $url): Article
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        if ($this->img == NULL) return 'No Image';

        return $this->img;
    }

    /**
     * @param int $imgId
     * @return Article
     */
    public function setImg(int $imgId): Article
    {
        $this->img = $this->getImagePath($imgId);
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Article
     */
    public function setDate(string $date): Article
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return Article
     */
    public function setCategories(array $categories): Article
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Article
     */
    public function setAuthor(User $author): Article
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     * @return Article
     */
    public function setComments(array $comments): Article
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountComments(): string
    {
        if (!isset($this->countComments)) $this->countComments = "0";

        return $this->countComments;
    }

    /**
     * @param string $countComments
     * @return Article
     */
    public function setCountComments(string $countComments): Article
    {
        $this->countComments = $countComments;
        return $this;
    }

    /**
     * @return int
     */
    public function getIBlockElementId(): int
    {
        return $this->iBlockElementId;
    }

    /**
     * @param int $iBlockElementId
     */
    public function setIBlockElementId(int $iBlockElementId): void
    {
        $this->iBlockElementId = $iBlockElementId;
    }
}