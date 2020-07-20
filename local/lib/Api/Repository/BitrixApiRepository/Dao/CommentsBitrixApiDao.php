<?php


namespace App\Api\Repository\BitrixApiRepository\Dao;


use App\Api\Pagination;
use App\Api\Settings\Settings;
use CIBlockElement;
use CIBlockResult;

class CommentsBitrixApiDao extends EntitiesBitrixApiDao
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
     * @param array $articlesIds
     * @return CIBlockResult|int
     */
    public function getCountByArticleIds(array $articlesIds)
    {
        $arOrder = [];
        $arFilter = [
            "IBLOCK_ID"           => Settings::I_BLOCK_ID_COMMENTS,
            "PROPERTY_ARTICLE_ID" => $articlesIds,
            "ACTIVE"              => "Y"
        ];
        $arGroupBy = [
            "PROPERTY_ARTICLE_ID"
        ];
        $arSelectFields = [];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            $arGroupBy,
            false,
            $arSelectFields
        );
    }

    /**
     * @param int $articleId
     * @return CIBlockResult|int
     */
    public function getParentComments(int $articleId)
    {
        $navParams = Pagination::getInstance();

        $arOrder = [
            "ID" => "DESC"
        ];
        $arFilter = [
            "IBLOCK_ID"                  => Settings::I_BLOCK_ID_COMMENTS,
            "PROPERTY_ARTICLE_ID"        => $articleId,
            "PROPERTY_PARENT_COMMENT_ID" => false
        ];
        $arNavParams = [
            "iNumPage"  => $navParams->getINumPage(),
            "nPageSize" => $navParams->getNPageSize()
        ];
        $arSelect = [
            'ID',
            "ACTIVE_FROM",
            "CREATED_BY",
            'NAME',
            'DETAIL_TEXT',
            'PROPERTY_ARTICLE_ID',
            'PROPERTY_PARENT_COMMENT_ID'
        ];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            $arNavParams,
            $arSelect
        );
    }

    /**
     * @param array $parentCommentsIds
     * @return CIBlockResult|int
     */
    public function getChildComments(array $parentCommentsIds)
    {
        $arOrder = [
            "ID" => "ASC"
        ];
        $arFilter = [
            "IBLOCK_ID"                  => Settings::I_BLOCK_ID_COMMENTS,
            "PROPERTY_PARENT_COMMENT_ID" => $parentCommentsIds
        ];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            false,
            [
                'ID',
                "ACTIVE_FROM",
                "CREATED_BY",
                'NAME',
                'DETAIL_TEXT',
                'PROPERTY_PARENT_COMMENT_ID',

            ]
        );
    }

    public function getMostCommentedArticlesIds(int $nTopCount)
    {
        $arOrder = [
            "CNT" => "DESC"
        ];
        $arFilter = [
            "IBLOCK_ID" => Settings::I_BLOCK_ID_COMMENTS
        ];
        $arGroupBy = [
            "PROPERTY_ARTICLE_ID"
        ];
        $arNavParams = [
            "nTopCount" => $nTopCount
        ];
        $arSelectFields = [];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            $arGroupBy,
            $arNavParams,
            $arSelectFields
        );
    }
}