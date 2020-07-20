<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<ul class="list-unstyled mb-0">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <li class="mb-3 pb-1">
            <a href="<?= $arResult['ARTICLE_URL'][$item['PROPERTY_ARTICLE_ID_VALUE']]; ?>#comments">
                <p class="text-3 text-color-light opacity-8 mb-1">
                    <i class="fas fa-angle-right text-color-primary"></i>
                    <strong class="ml-2"><?= $arResult['AUTHORS'][$item['CREATED_BY']]['NAME'] . ' ' . $arResult['AUTHORS'][$item['CREATED_BY']]['LAST_NAME']; ?></strong> <?= GetMessage('COMMENTED_ON'); ?> <strong class="text-color-primary"><?= $item['NAME']; ?></strong>
                </p>
                <p class="text-2 mb-0"><?= $item['DATE']; ?></p>
            </a>
        </li>
    <? endforeach; ?>
</ul>