<?php


namespace Shumskih\Comments\Classes\Repository\BitrixApiRepository;

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/components/shumskih/comments/classes/Repository/BitrixApiRepository/Dao/UsersDao.php';


use App\Api\User;
use CFile;
use Shumskih\Comments\Classes\Repository\BitrixApiRepository\Dao\UsersDao;

class UsersBitrixApiRepository
{

    public static function getByIds(array $usersIds)
    {
        $array = [];

        $filteredAuthorsIdsString = User::getFilteredUsersIdsString($usersIds);

        $result = UsersDao::getByIds($filteredAuthorsIdsString);

        while ($user = $result->GetNext(true, false)) {
            $array[$user['ID']] = $user;
            $array[$user['ID']]["PERSONAL_PHOTO"] = self::getAvatarPath($user['PERSONAL_PHOTO']);
        }

        return $array;
    }

    private static function getAvatarPath($photoId)
    {
        return CFile::GetPath($photoId);
    }
}