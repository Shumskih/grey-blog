<?php


namespace App\Api\Repository\BitrixApiRepository\Dao;


use App\Api\User;
use CDBResult;
use CIBlockResult;
use CUser;

class UsersBitrixApiDao extends EntitiesBitrixApiDao
{
    /**
     * @return CIBlockResult
     */
    public function getAll(): CIBlockResult
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param int $id
     * @return CIBlockResult
     */
    public function getById(int $id): CIBlockResult
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param array $usersIds
     * @return CDBResult
     */
    public function getUsersList(array $usersIds): CDBResult
    {
        $filteredAuthorsIdsString = User::getFilteredUsersIdsString($usersIds);

        $sort = 'ID';
        $order = 'ASC';
        $arFilter = [
            "ID" => $filteredAuthorsIdsString
        ];
        $arParameters = [
            'FIELDS' => [
                'ID',
                "NAME",
                "LAST_NAME",
                "PERSONAL_PHOTO"
            ]
        ];

        return CUser::GetList(
            $sort,
            $order,
            $arFilter,
            $arParameters
        );
    }

}