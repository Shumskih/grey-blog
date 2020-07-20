<?php


namespace Shumskih\Comments\Classes\Repository\BitrixApiRepository\Dao;


use CUser;

class UsersDao
{
    public static function getByIds(string $usersIds)
    {
        $sort = 'ID';
        $order = 'ASC';
        $arFilter = [
            "ID" => $usersIds
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