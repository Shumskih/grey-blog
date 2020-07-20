<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arCurrentValues */
use Bitrix\Main\Loader;

if(!Loader::includeModule("iblock"))
    return;

$arIBlockType = $arIBlockType2 = CIBlockParameters::GetIBlockTypes();

$arIBlock = [];
$arIBlock2 = [];
$rsIBlock = CIBlock::GetList(
    ["sort" => "asc"],
    ["TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"]
);
while($arr=$rsIBlock->Fetch()){
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
    $arIBlock2[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
    "GROUPS" => array(
        "BUTTONS" => array(
            "NAME" => GetMessage('COMMENTS_SETTINGS'),
            "SORT" => "200",
        ),
    ),
    "PARAMETERS" => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('COMMENTS_IBLOCK_TYPE'),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "N",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('COMMENTS_IBLOCK_ID'),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock,
            "REFRESH" => "N",
        ),
        "ARTICLES_IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('COMMENTS_ARTICLES_IBLOCK_TYPE'),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType2,
            "REFRESH" => "N",
        ),
        "ARTICLES_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('COMMENTS_ARTICLES_IBLOCK_ID'),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock2,
            "REFRESH" => "N",
        ),
        "COMMENTS_COUNT" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('COMMENTS_COUNT'),
            "TYPE" => "STRING",
            "DEFAULT"   =>  "3",
        ),
    ),
);