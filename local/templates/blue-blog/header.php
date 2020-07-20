<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

?>

<!DOCTYPE html>
<html class="side-header">
<head>
    <title><? $APPLICATION->ShowTitle(); ?></title>

    <? $APPLICATION->ShowHead(); ?>

    <?
    Asset::getInstance()->addString('<meta name="author" content="shumskih.ru">');
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">');
    ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= DEFAULT_TEMPLATE_PATH; ?>/img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="<?= DEFAULT_TEMPLATE_PATH; ?>/img/apple-touch-icon.png">

    <!-- Web Fonts  -->
    <?
    Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">');
    ?>


    <!-- Vendor CSS -->
    <?
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/vendor/bootstrap/css/bootstrap.min.css');
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/vendor/fontawesome-free/css/all.min.css');
    ?>
    <!-- Theme CSS -->
    <?
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/theme.css');
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/theme-elements.css');
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/theme-blog.css');
    ?>
    <!-- Skin CSS -->
    <?
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/skins/default.css');
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/custom.css');
    ?>
    <!-- Vendor -->
    <?
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/vendor/jquery/jquery.min.js');
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/vendor/bootstrap/js/bootstrap.min.js');
    ?>

    <!-- Theme Base, Components and Settings -->
    <?
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/theme.js');
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/vendor/jquery/theme.init.js');
    ?>

    <!-- Theme Custom -->
    <?
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/custom.js');
    ?>
    <!-- Head Libs -->
    <?
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/vendor/modernizr/modernizr.min.js');
    ?>

    <meta property="og:url" content="<? $APPLICATION->ShowProperty("og:url") ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<? $APPLICATION->ShowProperty("title") ?>">
    <meta property="og:description" content="<? $APPLICATION->ShowProperty("description"); ?>">
    <meta property="og:image" content="<? $APPLICATION->ShowProperty("og:image"); ?>">

    <script type="text/javascript" src="https://vk.com/js/api/share.js?93" charset="windows-1251"></script>
</head>
<body>
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>

<div class="body">
    <div class="sticky-wrapper sticky-wrapper-transparent sticky-wrapper-effect-1 sticky-wrapper-border-bottom d-none d-lg-block d-xl-none"
         data-plugin-sticky data-plugin-options="{'minWidth': 0, 'stickyStartEffectAt': 100, 'padding': {'top': 0}}">
        <div class="sticky-body">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-9">
                        <div class="py-4">
                            <a href="/">
                                <img class="ml-2" alt="Porto" width="82" height="40"
                                     data-change-src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/logo.png"
                                     src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/logo-default.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-3 text-right">
                        <button class="hamburguer-btn" data-set-active="false">
									<span class="hamburguer">
										<span></span>
										<span></span>
										<span></span>
									</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header id="header" class="side-header d-flex">
        <div class="header-body">
            <div class="header-container container d-flex h-100">
                <div class="header-column flex-row flex-lg-column justify-content-center h-100">
                    <div class="header-row flex-row justify-content-start justify-content-lg-center py-lg-5">
                        <h1 class="header-logo">
                            <a href="/">
                                <img alt="Porto" width="100" height="48"
                                     src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/logo-default.png">
                                <span class="hide-text">Porto - Demo Blog 4</span>
                            </a>
                        </h1>
                    </div>
                    <div class="header-row header-row-side-header flex-row h-100 pb-lg-5">
                        <div class="header-nav header-nav-links header-nav-links-side-header header-nav-links-vertical header-nav-links-vertical-columns align-self-center">
                            <div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <? $APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "menu",
                                            Array(
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CHILD_MENU_TYPE" => "main",
                                                "DELAY" => "N",
                                                "MAX_LEVEL" => "1",
                                                "MENU_CACHE_GET_VARS" => array(""),
                                                "MENU_CACHE_TIME" => "3600",
                                                "MENU_CACHE_TYPE" => "N",
                                                "MENU_CACHE_USE_GROUPS" => "Y",
                                                "ROOT_MENU_TYPE" => "main",
                                                "USE_EXT" => "N"
                                            )
                                        ); ?>
                                        <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"categories", 
	array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "articles",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "TEXT",
		"COMPONENT_TEMPLATE" => "categories"
	),
	false
); ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header-row justify-content-end pb-lg-3">
                        <? if (!$USER->IsAuthorized()): ?>
                            <a href="/login/">Войти</a>
                            <a href="/registration/">Зарегистрироваться</a>
                        <? else: ?>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:system.auth.form",
                                "header",
                                Array(
                                    "FORGOT_PASSWORD_URL" => "",
                                    "PROFILE_URL" => "",
                                    "REGISTER_URL" => "/auth/registration.php",
                                    "SHOW_ERRORS" => "Y"
                                )
                            );?>
                        <? endif; ?>
                        <p class="d-none d-lg-block text-1 pt-3">© 2018 PORTO. All rights reserved</p>
                        <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                data-target=".header-nav-main nav">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div role="main" class="main">

        <section class="section border-0 m-0 py-3 py-lg-5">

            <div class="container py-md-4">