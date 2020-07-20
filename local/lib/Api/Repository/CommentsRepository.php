<?php


namespace App\Api\Repository;


use App\Api\Repository\BitrixApiRepository\CommentsBitrixApiRepository;
use App\Api\Settings\RepositoryConfig;

class CommentsRepository extends Repository
{
    public function get()
    {
        if (RepositoryConfig::REPOSITORY == 'BITRIX_API')
            return new CommentsBitrixApiRepository();
    }
}