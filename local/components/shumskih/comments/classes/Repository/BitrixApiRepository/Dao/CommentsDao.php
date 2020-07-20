<?php

namespace Shumskih\Comments\Classes\Repository\BitrixApiRepository\Dao;

use CIBlockElement;
use Exception;

class CommentsDao
{
    public static function save(int $articleId, int $user, int $iBlockId)
    {
        $el = new CIBlockElement;

        if ($articleId) {
            if ($_POST['parent-comment-id'] && $_POST['parent-comment-id'] != '') {
                $props = [
                    "ARTICLE_ID"        => $articleId,
                    "PARENT_COMMENT_ID" => $_POST['parent-comment-id']
                ];
            } else {
                $props = [
                    "ARTICLE_ID" => $articleId
                ];
            }

            $arLoadProductArray = [
                "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                "CREATED_BY"        => $user,
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID"         => $iBlockId,
                "NAME"              => mb_strimwidth($_POST['message'], 0, 100),
                "ACTIVE"            => "Y",
                "DETAIL_TEXT"       => $_POST['message'],
                "PROPERTY_VALUES"   => $props
            ];


            // метод Add() возвращает либо id либо false
            $result = $el->Add($arLoadProductArray);
            if (!$result) throw new Exception($el->LAST_ERROR);
            return true;
        }
    }

    public static function getParentComments(int $articleId, int $iBlockId, int $commentsCount)
    {
        $arOrder = [
            "ID" => "DESC"
        ];
        $arFilter = [
            "IBLOCK_ID"                  => $iBlockId,
            "PROPERTY_ARTICLE_ID"        => $articleId,
            "PROPERTY_PARENT_COMMENT_ID" => false
        ];
        $arNavParams = [
            "nPageSize"       => $commentsCount,
            'checkOutOfRange' => true
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

    public static function getChildComments(array $arParentCommentsIds, int $iBlockId)
    {
        if (count($arParentCommentsIds) > 0) {
            $arOrder = [
                "ID" => "ASC"
            ];
            $arFilter = [
                "IBLOCK_ID"                  => $iBlockId,
                "PROPERTY_PARENT_COMMENT_ID" => $arParentCommentsIds
            ];
            $arSelect = [
                'ID',
                "ACTIVE_FROM",
                "CREATED_BY",
                'NAME',
                'DETAIL_TEXT',
                'PROPERTY_PARENT_COMMENT_ID',
            ];

            return CIBlockElement::GetList(
                $arOrder,
                $arFilter,
                false,
                false,
                $arSelect
            );
        }
    }
}