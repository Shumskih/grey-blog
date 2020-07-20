<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$curPage = $APPLICATION->GetCurPage();
$APPLICATION->SetPageProperty('og:url', 'http://'.$_SERVER["SERVER_NAME"].$curPage);
//$APPLICATION->SetPageProperty('title', $arResult["NAME"]);
//$APPLICATION->SetPageProperty('description', $arResult["PREVIEW_TEXT"]);
$APPLICATION->SetPageProperty("og:image", 'http://' . $_SERVER['SERVER_NAME'] . $arResult['DETAIL_PICTURE']['SOCIAL']);

