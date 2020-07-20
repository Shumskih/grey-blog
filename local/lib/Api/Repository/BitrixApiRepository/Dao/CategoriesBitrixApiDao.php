<?php


namespace App\Api\Repository\BitrixApiRepository\Dao;


use App\Api\Settings\Settings;
use CIBlockElement;
use CIBlockResult;
use CIBlockSection;

class CategoriesBitrixApiDao extends EntitiesBitrixApiDao
{
    /**
     * @return CIBlockResult
     */
    public function getAll(): CIBlockResult
    {
        $arOrder = ["NAME" => "ASC"];
        $arFilter = [
            "IBLOCK_ID" => Settings::I_BLOCK_ID_ARTICLES,
            "ACTIVE"    => "Y"
        ];
        $arSelect = [
            'ID',
            'NAME'
        ];

        return CIBlockSection::GetList(
            $arOrder,
            $arFilter,
            true,
            $arSelect,
            false
        );
    }

    /**
     * @param int $id
     * @return CIBlockResult
     */
    public function getById(int $id): CIBlockResult
    {
        return CIBlockSection::GetByID($id);
    }

    /**
     * @param array $articleIds
     * @return CIBlockResult
     */
    public function getByArticleIds(array $articleIds)
    {
        $arSelect = [
            "NAME",
            "IBLOCK_ELEMENT_ID",
            "SECTION_PAGE_URL"
        ];

        return CIBlockElement::GetElementGroups(
            $articleIds,
            false,
            $arSelect
        );
    }

}