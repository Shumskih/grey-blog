<?php


namespace App\Api;


use App\Api\Repository\CommentsRepository;

class Comment extends Entity
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $text;
    /**
     * @var string
     */
    private $date;
    /**
     * @var User
     */
    private $user;
    /**
     * @var int
     */
    private $parentCommentId;
    /**
     * @var array
     */
    private $answers;
    /**
     * @var CommentsRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new CommentsRepository();
    }

    /**
     * @param string $id
     * @param string $text
     * @param string $date
     * @param string|NULL $parentCommentId
     * @return $this
     */
    public function create(string $id, string $text, string $date, string $parentCommentId = NULL)
    {
        $this->id = $id;
        $this->text = $text;
        $this->date = $date;
        $this->parentCommentId = $parentCommentId;

        return $this;
    }

    /**
     * @param int $articleId
     * @return array
     */
    public function getByArticleId(int $articleId)
    {
        return $this->repository->get()->getComments($articleId);
    }

    /**
     * @param array $articlesIds
     * @return array
     */
    public function getCountByArticleIds(array $articlesIds)
    {
        return $this->repository->get()->getCountByArticleIds($articlesIds);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        if ($this->answers == NULL) {
            return [
                'id'   => $this->getId(),
                'text' => $this->getText(),
                'date' => $this->getDate(),
                'user' => $this->getUser()
            ];
        }

        return [
            'id'      => $this->getId(),
            'text'    => $this->getText(),
            'date'    => $this->getDate(),
            'user' => $this->getUser(),
            'answers' => $this->getAnswers()
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Comment
     */
    public function setId(int $id): Comment
    {
        $this->id = $id;

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
     * @return Comment
     */
    public function setText(string $text): Comment
    {
        $this->text = $text;

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
     * @return Comment
     */
    public function setDate(string $date): Comment
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Comment
     */
    public function setUser(User $user): Comment
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return int
     */
    public function getParentCommentId(): int
    {
        return $this->parentCommentId;
    }

    /**
     * @param int $parentCommentId
     * @return Comment
     */
    public function setParentCommentId(int $parentCommentId): Comment
    {
        $this->parentCommentId = $parentCommentId;

        return $this;
    }

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @param array $answers
     */
    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }
}