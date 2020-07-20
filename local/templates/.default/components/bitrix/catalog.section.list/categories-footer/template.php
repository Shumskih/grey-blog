<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
//todo
?>
<? foreach ($arResult['SECTIONS'] as $section): ?>
    <?
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <a href="<?= $section['SECTION_PAGE_URL'] ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
            <span class="badge badge-dark bg-color-black badge-sm py-2 mr-1 mb-2 text-uppercase">
            <?= $section['NAME']; ?>
            </span>
    </a>
<? endforeach; ?>

