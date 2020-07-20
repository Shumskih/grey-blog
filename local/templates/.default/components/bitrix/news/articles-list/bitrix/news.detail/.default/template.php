<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="row">
    <div class="col">
        <div class="blog-posts single-post">
            <article class="post post-large blog-single-post border-0 m-0 p-0">
                <div class="post-image ml-0">
                    <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"]; ?>"
                         class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt=""/>
                </div>
                <div class="post-date ml-0">
                    <span class="day"><?= $arResult['DATE'][$arResult['ID']][0]; ?></span>
                    <span class="month"><?= $arResult['DATE'][$arResult['ID']][1]; ?></span>
                </div>

                <div class="post-content ml-0">

                    <h2 class="font-weight-bold">
                        <a href=""><?= $arResult["NAME"]; ?></a>
                    </h2>

                    <div class="post-meta">
                        <span><i class="far fa-user"></i>
                            <a href="#">
                                <? if (isset($arResult['AUTHOR'])): ?>
                                    <?= $arResult['AUTHOR']['NAME'] . ' ' . $arResult['AUTHOR']['LAST_NAME']; ?>
                                <? endif; ?>
                            </a>
                        </span>
                        <span><i class="far fa-folder"></i>
                            <? foreach ($arResult['CATEGORIES'] as $category): ?>
                                <a href="/articles/<?= $category['CODE']; ?>/"><?= $category['NAME']; ?></a>
                            <? endforeach; ?>
                        </span>
                        <span><i class="far fa-comments"></i>
                            <a href="#comments">
                                <?= $arResult['COUNT_COMMENTS']; ?>
                            </a>
                        </span>
                    </div>

                    <?= $arResult["DETAIL_TEXT"]; ?>

                    <div class="post-block mt-5 post-share mb-5">
                        <? $APPLICATION->IncludeComponent(
                            "shumskih:share-buttons",
                            ".default",
                            array(
                                "FACEBOOK" => "Y",
                                "MAILRU" => "Y",
                                "OK" => "Y",
                                "TWITTER" => "Y",
                                "VK" => "Y",
                                "COMPONENT_TEMPLATE" => ".default",
                                "SOCIAL_BUTTONS" => $arResult['SOCIAL_BUTTONS']
                            ),
                            $component
                        ); ?>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>