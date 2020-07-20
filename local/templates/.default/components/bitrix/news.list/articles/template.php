<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<div class="row">
    <div class="col">
        <div class="blog-posts recent-posts">

            <div id="portfolioLoadMoreWrapper" class="row masonry" data-plugin-masonry
                 data-plugin-options="{'itemSelector': '.masonry-item'}" data-total-pages="3"
                 data-ajax-url="ajax/index-blog-4-ajax-load-more-">

                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                    <div class="masonry-item no-default-style col-md-6"
                         id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <article class="post post-medium border-0 pb-0 mb-5">
                            <div class="post-image">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                         class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0 w-100"
                                         alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                         title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                                    <div class="date p-absolute z-index-2 top-10 right-10 mr-0 mr-3 pl-1 pt-1">
                                        <span class="day bg-color-light font-weight-extra-bold py-2 text-color-dark"><?= $arResult['DATE'][$arItem['ID']][0]; ?></span>
                                        <span class="month text-1 bg-color-light line-height-9 text-default w-100 top-2 d-block py-0">
                                            <span class="text-1"><?= $arResult['DATE'][$arItem['ID']][1]; ?></span></span>
                                    </div>
                                </a>
                            </div>

                            <div class="post-content bg-color-light p-4">

                                <h2 class="font-weight-bold text-5 line-height-6 mt-0 mb-2">
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                        <? echo $arItem["NAME"] ?></a>
                                </h2>
                                <p>
                                    <?= $arItem["PREVIEW_TEXT"]; ?>
                                </p>

                                <div class="post-meta m-0 p-0">
                                    <span><i class="far fa-user"></i> By <a href="#">
                                            <? if ($id = $arItem['PROPERTIES']['AUTHOR']['ID']): ?>
                                                <?= $arResult["AUTHORS"][$id]["NAME"] . ' ' . $arResult["AUTHORS"][$id]["LAST_NAME"]; ?>
                                            <? else: ?>
                                                Unknown
                                            <? endif; ?>
                                        </a> </span>
                                    <span><i class="far fa-folder"></i>
                                        <? $id = $arItem['ID'] ?>
                                        <? foreach ($arResult['CATEGORIES'][$id] as $category): ?>
                                            <a href="/articles/<?= $category['CODE']; ?>/"><?= $category['NAME']; ?></a>
                                        <? endforeach; ?>
                                    </span>
                                    <span><i class="far fa-comments"></i>
                                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>#comments">
                                                <? if ($arResult['COUNT_COMMENTS'][$arItem['ID']]): ?>
                                                    <?= $arResult['COUNT_COMMENTS'][$arItem['ID']] ?>
                                                <? else: ?>
                                                    0
                                                <? endif; ?>
                                        </a>
                                    </span>
                                    <span class="d-block mt-2"><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                                                                  class="btn btn-xs btn-light text-1 text-uppercase"><?= GetMessage('READ_MORE') ?></a></span>
                                </div>

                            </div>
                        </article>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
