<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <nav class="collapse">
        <ul class="nav nav-pills" id="mainNav">
            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <li class="dropdown">
                    <a href="<?= $arItem["LINK"]; ?>"
                       class="dropdown-item dropdown-toggle <? if ($APPLICATION->GetCurPage(false) === '/') echo "active" ?>"><?= $arItem["TEXT"] ?></a>
                </li>

            <? endforeach ?>

        </ul>
    </nav>
<? endif ?>