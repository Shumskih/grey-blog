<?php


namespace App\Api;


use App\Api\Repository\CategoriesRepository;

class Category extends Entity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $articles = [];

    /**
     * @var CategoriesRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new CategoriesRepository();
    }

    public function create(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;

        return $this;
    }

    /**
     * @return array of Category objects
     */
    public function getAll(): array
    {
        return $this->repository->get()->getAll();
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getById(int $id)
    {
        return $this->repository->get()->getById($id);
    }

    /**
     * @param array $articleIds
     * @return array
     */
    public function getByArticleIds(array $articleIds)
    {
        return $this->repository->get()->getByArticleIds($articleIds);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        if (!$this->getArticles() == NULL) {
            return [
                'id'       => $this->getId(),
                'name'     => $this->getName(),
                'articles' => $this->getArticles()
            ];

        }
        return
            [
                'id'   => $this->getId(),
                'name' => $this->getName()
            ];
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
     * @return Category
     */
    public function setId(string $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
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
     * @return Category
     */
    public function setUrl(string $url): Category
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return array
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @param array $articles
     * @return Category
     */
    public function setArticles(array $articles): Category
    {
        $this->articles = $articles;
        return $this;
    }
}