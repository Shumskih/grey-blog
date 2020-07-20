<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
    ShowMessage($arResult['ERROR_MESSAGE']);
?>

<? if ($arResult["FORM_TYPE"] == "login"): ?>
<? elseif ($arResult["FORM_TYPE"] == "otp"): ?>
<? else: ?>

    <form action="<?= $arResult["AUTH_URL"] ?>">
        <div class="header-form">
            <div class="mb-1">
                <?= GetMessage("AUTH_HELLO_USER") . $arResult["USER_NAME"] ?>
            </div>
            <div class="welcome-text">
                <a class="text-4" href="/profile/">Профиль</a>
            </div>

            <? foreach ($arResult["GET"] as $key => $value): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
            <? endforeach ?>
            <input type="hidden" name="logout" value="yes"/>
            <div class="form-group logout-button">
                <input type="submit"
                       name="logout_butt"
                       value="<?= GetMessage("AUTH_LOGOUT_BUTTON"); ?>"
                       class="btn btn-primary btn-modern"
                       data-loading-text="Loading...">
            </div>
        </div>
    </form>
<? endif ?>
