<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? foreach ($arResult['SECTIONS'] as $section): ?>
    <?
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <li class="dropdown" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
        <a class="dropdown-item dropdown-toggle <? if ($APPLICATION->GetCurPage(false) === $section['SECTION_PAGE_URL']) echo 'active'; ?>"
           href="<?= $section['SECTION_PAGE_URL'] ?>">
            <?= $section['NAME']; ?>
        </a>
    </li>
<? endforeach; ?>


