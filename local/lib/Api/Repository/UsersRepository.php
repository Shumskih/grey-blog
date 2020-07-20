<?php


namespace App\Api\Repository;


use App\Api\Repository\BitrixApiRepository\UsersBitrixApiRepository;
use App\Api\Settings\RepositoryConfig;

class UsersRepository extends Repository
{
    public function get()
    {
        if (RepositoryConfig::REPOSITORY == 'BITRIX_API')
            return new UsersBitrixApiRepository();
    }
}