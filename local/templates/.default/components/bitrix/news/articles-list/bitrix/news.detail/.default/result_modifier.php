<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use App\Helpers\DateHelper;

// Выводит юзера, который опубликовал статью
$author = getById($arResult['PROPERTIES']['AUTHOR']['ID']);
$arResult['AUTHOR'] = $author;

// Получает категории, в которых находится статья
$categories = [];
$rsSect = CIBlockElement::GetElementGroups(
    [$arResult['ID']],
    false,
    [
        "NAME",
        "CODE",
        "IBLOCK_ELEMENT_ID"
    ]
);
while ($arSect = $rsSect->Fetch()) {
    $categories[] = [
        'NAME' => $arSect['NAME'],
        'CODE' => $arSect['CODE']
    ];
}
$arResult['CATEGORIES'] = $categories;

// Парсит дату в формат по шаблону
$arResult['DATE'] = DateHelper::getArticleDate(
    [
        $arResult['ID'] => $arResult['TIMESTAMP_X']
    ]
);

// Количество комметариев к статьям
$arFilter = Array(
    "IBLOCK_ID" => 2,
    "PROPERTY_ARTICLE_ID" => $arResult['ID'],
    "ACTIVE" => "Y"
);
$arResult['COUNT_COMMENTS'] = CIBlockElement::GetList(
    Array(),
    $arFilter,
    Array(),
    false,
    Array()
);

// Изображение для превью соц.сетей
$image_social = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width' => '1200', 'height' => '630'), BX_RESIZE_IMAGE_EXACT, true);
$arResult["DETAIL_PICTURE"]["SOCIAL"] = $image_social["src"];

$arResult['SOCIAL_BUTTONS'] = [
    'NAME' => $arResult['NAME'],
    'URL' => "http://" . $_SERVER['SERVER_NAME'] . $arResult['DETAIL_PAGE_URL'],
    'DESCRIPTION' => $arResult['PREVIEW_TEXT'],
    'IMG' => 'http://' . $_SERVER['SERVER_NAME'] . $arResult['DETAIL_PICTURE']['SOCIAL']
];

// Передает данные в результат после кеширования
$this->__component->SetResultCacheKeys(array(
    "NAME",
    "PREVIEW_TEXT",
    "DETAIL_PAGE_URL",
    "DETAIL_PICTURE",
    "SOCIAL_BUTTONS"
));

function getById($id)
{
    $rsUser = CUser::GetByID($id);

    return $rsUser->Fetch();
}