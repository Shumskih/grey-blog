<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<ul class="list-unstyled mb-0">
    <? $count = 0; ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="media<?= ($count=0)?? " mb-3 pb-1" ?>">
            <article class="d-flex" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>">
                    <img class="mr-3 rounded-circle"
                         src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>"
                         alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"]; ?>"
                         style="max-width: 70px;">
                </a>
                <div class="media-body">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>">
                        <h6 class="text-3 text-color-light opacity-8 ls-0 mb-1"><?echo $arItem["NAME"]?></h6>
                        <p class="text-2 mb-0"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></p>
                    </a>
                </div>
            </article>
        </li>
    <? endforeach; ?>
</ul>