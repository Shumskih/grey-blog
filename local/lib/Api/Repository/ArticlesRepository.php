<?php


namespace App\Api\Repository;


use App\Api\Repository\BitrixApiRepository\ArticlesBitrixApiRepository;
use App\Api\Settings\RepositoryConfig;

class ArticlesRepository extends Repository
{
    public function get()
    {
        if (RepositoryConfig::REPOSITORY == 'BITRIX_API')
            return new ArticlesBitrixApiRepository();
    }
}