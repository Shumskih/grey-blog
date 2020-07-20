<?php


namespace App\Api\Repository\BitrixApiRepository;


use App\Api\Repository\BitrixApiRepository\Dao\UsersBitrixApiDao;
use App\Api\User;
use CFile;

class UsersBitrixApiRepository implements BitrixApiRepository
{

    /**
     * @var array User
     */
    private $users;
    /**
     * @var UsersBitrixApiDao
     */
    private $dao;

    public function __construct()
    {
        $this->dao = new UsersBitrixApiDao();
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
     * @param array $usersIds
     * @return array
     */
    public function getUsersList(array $usersIds)
    {
        $result = $this->dao->getUsersList($usersIds);

        while ($u = $result->GetNext(true, false)) {
            $avatar = $this->getAvatarPath($u["PERSONAL_PHOTO"]);
            $user = $this->createUser($u['ID'], $u['NAME'], $u['LAST_NAME'], $avatar);

            $this->users[] = $user;

            unset($user);

        }

        return $this->users;
    }

    /**
     * @param string $id
     * @param string $name
     * @param string $surname
     * @param string $photo
     * @return User
     */
    public function createUser(string $id, string $name, string $surname, string $photo)
    {
        $user = new User();
        $user->create($id, $name, $surname, $photo);

        return $user;
    }

    /**
     * @param $photoId
     * @return string|null
     */
    private function getAvatarPath($photoId)
    {
        return CFile::GetPath($photoId);
    }

}