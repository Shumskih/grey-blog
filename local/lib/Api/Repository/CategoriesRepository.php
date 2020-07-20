<?php


namespace App\Api\Repository;


use App\Api\Repository\BitrixApiRepository\CategoriesBitrixApiRepository;
use App\Api\Settings\RepositoryConfig;

class CategoriesRepository extends Repository
{
    public function get()
    {
        if (RepositoryConfig::REPOSITORY == 'BITRIX_API')
            return new CategoriesBitrixApiRepository();
    }
}