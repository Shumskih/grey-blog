<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);


// ссылка на первую страницу
$firstPageUrl = $arResult['sUrlPath'];
if (!empty($arResult['NavQueryString'])) {
    $firstPageUrl = $firstPageUrl . '?' . $arResult['NavQueryString'];
}
// ссылка на последнюю страницу
$lastPageUrl = $arResult['sUrlPath'];
if (!empty($arResult['NavQueryString'])) {
    $lastPageUrl = $lastPageUrl . '?' . $arResult['NavQueryString']
        . '&amp;PAGEN_' . $arResult['NavNum'] . '=' . $arResult['NavPageCount'];
} else {
    $lastPageUrl = $lastPageUrl . '?PAGEN_' . $arResult['NavNum'] . '=' . $arResult['NavPageCount'];
}
?>

<? if ($arResult['NavPageCount'] > 1): ?>
<ul class="pagination float-left">
    <?php if ($arResult['NavPageNomer'] > 1): /* ссылка на первую страницу */ ?>
        <li class="page-item">
            <a class="page-link" href="<?= $firstPageUrl ?>?#comments" title="Первая страница">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php for ($i = $arResult['nStartPage']; $i <= $arResult['nEndPage']; $i++): ?>
        <?php
        // ссылка на очередную страницу
        $pageUrl = $arResult['sUrlPath'];
        if (!empty($arResult['NavQueryString'])) {
            $pageUrl = $pageUrl . '?' . $arResult['NavQueryString'] . '&amp;PAGEN_' . $arResult['NavNum'] . '=' . $i;
        } else {
            $pageUrl = $pageUrl . '?PAGEN_' . $arResult['NavNum'] . '=' . $i;
        }
        ?>
        <?php if ($arResult['NavPageNomer'] == $i): /* если это текущая страница */ ?>
            <li class="page-item active">
                <a class="page-link"><?= $i; ?></a>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pageUrl; ?>?#comments"><?= $i; ?></a>
            </li>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount']): /* ссылка на последнюю страницу */ ?>
        <a class="page-link" href="<?= $lastPageUrl; ?>?#comments" title="Последняя"><i class="fas fa-angle-right"></i></a>
    <?php endif; ?>
</ul>
<? endif; ?>