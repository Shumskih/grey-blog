<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset; ?>

</div>

</section>

</div>
<footer id="footer" class="m-0">
    <div class="container py-5">
        <div class="row py-5 my-4">
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <? $APPLICATION->IncludeFile(
                    "footer_inc.php",
                    Array(),
                    Array(
                        "MODE" => "html",
                        "NAME" => GetMessage("SECT_INC"),
                        "TEMPLATE" => "sect_inc.php")); ?>
            </div>
            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0"><h5 class="text-3 mb-3"><?= GetMessage('RECENT_POSTS') ?></h5>
                <? $APPLICATION->IncludeComponent("bitrix:news.line", "news-lite", Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                    "CACHE_TIME" => "300",    // Время кеширования (сек.)
                    "CACHE_TYPE" => "A",    // Тип кеширования
                    "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
                    "FIELD_CODE" => array(    // Поля
                        0 => "NAME",
                        1 => "PREVIEW_PICTURE",
                        2 => "DATE_ACTIVE_FROM",
                        3 => "TIMESTAMP_X",
                        4 => "",
                    ),
                    "IBLOCKS" => array(    // Код информационного блока
                        0 => "1",
                    ),
                    "IBLOCK_TYPE" => "articles",    // Тип информационного блока
                    "NEWS_COUNT" => "2",    // Количество новостей на странице
                    "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
                    "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
                    "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
                    "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                    "COMPONENT_TEMPLATE" => ".default"
                ),
                    false
                ); ?>
            </div>
            <div class="col-md-6 col-lg-3 mb-5 mb-md-0"><h5
                        class="text-3 mb-3"><?= GetMessage('RECENT_COMMENTS') ?></h5>
                <? $APPLICATION->IncludeComponent(
                    "shumskih:last-comments",
                    "",
                    Array(
                        "ARTICLES_IBLOCK_ID" => "1",
                        "ARTICLES_IBLOCK_TYPE" => "articles",
                        "IBLOCK_ID" => "2",
                        "IBLOCK_TYPE" => "comments"
                    )
                ); ?>
            </div>
            <div class="col-md-6 col-lg-2">
                <h5 class="text-3 mb-3"><?= GetMessage('CATEGORIES') ?></h5>
                <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "categories-footer", Array(
                    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                    "CACHE_TYPE" => "A",    // Тип кеширования
                    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
                    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",    // Показывать количество
                    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
                    "IBLOCK_ID" => "1",    // Инфоблок
                    "IBLOCK_TYPE" => "articles",    // Тип инфоблока
                    "SECTION_CODE" => "",    // Код раздела
                    "SECTION_FIELDS" => array(    // Поля разделов
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],    // ID раздела
                    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                    "SECTION_USER_FIELDS" => array(    // Свойства разделов
                        0 => "",
                        1 => "",
                    ),
                    "SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
                    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
                    "VIEW_MODE" => "TEXT",    // Вид списка подразделов
                ),
                    false
                ); ?>
            </div>
        </div>
    </div>
</footer>

<div class="bg-color-dark-scale-2 pt-3">
    <div class="container py-2">
        <div class="row py-4">
            <div class="col text-center">
                <ul class="footer-social-icons social-icons social-icons-clean social-icons-icon-light mb-3 mt-2">
                    <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank"
                                                         title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank"
                                                        title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank"
                                                         title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                </ul>
                <p class="text-1"><strong>PORTO TEMPLATE</strong> - © Copyright 2019. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>
