<?php


namespace App\Api\Repository\BitrixApiRepository\Dao;


use App\Api\Pagination;
use App\Api\Settings\Settings;
use CIBlockElement;
use CIBlockResult;

class ArticlesBitrixApiDao extends EntitiesBitrixApiDao
{
    /**
     * @return CIBlockResult
     */
    public function getAll(): CIBlockResult
    {
        $navParams = Pagination::getInstance();

        $arOrder = ["ACTIVE_FROM" => "DESC"];
        $arFilter = [
            "IBLOCK_ID" => Settings::I_BLOCK_ID_ARTICLES,
            "ACTIVE" => "Y"
        ];
        $arNavStartParams = [
            "iNumPage" => $navParams->getINumPage(),
            "nPageSize" => $navParams->getNPageSize(),
            'checkOutOfRange' => $navParams->getCheckOutOfRange()
        ];
        $arSelectFields = [
            'ID',
            "ACTIVE_FROM",
            "CREATED_BY",
            'NAME',
            'PREVIEW_TEXT',
            'DETAIL_PAGE_URL',
            'PREVIEW_PICTURE'
        ];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            $arNavStartParams,
            $arSelectFields
        );
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
     * @param int $id
     * @return CIBlockResult
     */
    public function getByCategoryId(int $id): CIBlockResult
    {
        $navParams = Pagination::getInstance();

        $arOrder = ["ACTIVE_FROM" => "DESC"];
        $arFilter = [
            "IBLOCK_ID" => Settings::I_BLOCK_ID_ARTICLES,
            "IBLOCK_SECTION_ID" => $id,
            "ACTIVE" => "Y"
        ];
        $arSelect = [
            'ID',
            "ACTIVE_FROM",
            "CREATED_BY",
            'NAME',
            'PREVIEW_TEXT',
            'DETAIL_PAGE_URL',
            'PREVIEW_PICTURE'
        ];
        $arNavStartParams = [
            "iNumPage" => $navParams->getINumPage(),
            "nPageSize" => $navParams->getNPageSize(),
            'checkOutOfRange' => $navParams->getCheckOutOfRange()
        ];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            $arNavStartParams,
            $arSelect
        );
    }

    /**
     * @param int $nTopCount
     * @return CIBlockResult
     */
    public function getTopArticles(int $nTopCount): CIBlockResult
    {
        $arOrder = ["SHOW_COUNTER" => "DESC"];
        $arFilter = [
            "IBLOCK_ID" => Settings::I_BLOCK_ID_ARTICLES,
            "ACTIVE" => "Y"
        ];
        $arNavParams = [
            "nTopCount" => $nTopCount
        ];
        $arSelectFields = [
            'ID',
            "ACTIVE_FROM",
            "CREATED_BY",
            'NAME',
            'PREVIEW_TEXT',
            'DETAIL_PAGE_URL',
            'PREVIEW_PICTURE'
        ];

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            $arNavParams,
            $arSelectFields
        );
    }

    /**
     * @param array $articleIds
     * @return CIBlockResult|int
     */
    public function getMostCommentedArticles(array $articleIds)
    {
        $arFilter = [
            "IBLOCK_ID" => Settings::I_BLOCK_ID_ARTICLES,
            "ID" => $articleIds
        ];
        $arSelect = [
            'ID',
            "ACTIVE_FROM",
            "CREATED_BY",
            'NAME',
            'PREVIEW_TEXT',
            'PREVIEW_PICTURE'
        ];

        return CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            false,
            $arSelect
        );
    }

}