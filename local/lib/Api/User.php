<?php


namespace App\Api;


use App\Api\Repository\UsersRepository;
use CFile;

class User extends Entity
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $surname;
    /**
     * @var string
     */
    private $avatar;
    /**
     * @var UsersRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new UsersRepository();
    }

    public function create(string $id, string $name, string $surname, string $photo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->avatar = $photo;

        return $this;
    }

    /**
     * @param int $userId
     */
    public function getById(int $userId)
    {
        // TODO: Implement getById() method
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getUsersList(array $userIds)
    {
        return $this->repository->get()->getUsersList($userIds);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'avatar' => $this->getAvatar()
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
     * @return User
     */
    public function setId(int $id): User
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
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param int $photoId
     */
    public function setAvatar(int $photoId): void
    {
        $this->avatar = CFile::GetPath($photoId);
    }

    /**
     * @param array $arUsersIds
     * @return string
     */
    public static function getFilteredUsersIdsString(array $arUsersIds): string
    {
        $arUsersIds = array_unique($arUsersIds);

        return implode(' | ', $arUsersIds);
    }
}