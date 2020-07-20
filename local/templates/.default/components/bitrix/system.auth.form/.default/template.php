<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>

<div class="bx-system-auth-form">

    <?
    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
        ShowMessage($arResult['ERROR_MESSAGE']);
    ?>

    <? if ($arResult["FORM_TYPE"] == "login"): ?>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="featured-box featured-box-primary text-left mt-5">
                                    <div class="box-content">
                                        <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">
                                            <?= GetMessage('auth_form_comp_auth'); ?>
                                        </h4>
                                        <form name="system_auth_form<?= $arResult["RND"] ?>"
                                              action="<?= $arResult["AUTH_URL"] ?>" id="frmSignIn" method="post"
                                              class="needs-validation" target="_top">
                                            <? if ($arResult["BACKURL"] <> ''): ?>
                                                <input type="hidden" name="backurl"
                                                       value="<?= $arResult["BACKURL"] ?>"/>
                                            <? endif ?>
                                            <? foreach ($arResult["POST"] as $key => $value): ?>
                                                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                                            <? endforeach ?>
                                            <input type="hidden" name="AUTH_FORM" value="Y"/>
                                            <input type="hidden" name="TYPE" value="AUTH"/>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label class="font-weight-bold text-dark text-2"><?= GetMessage("AUTH_LOGIN") ?></label>
                                                    <input type="text" name="USER_LOGIN" value=""
                                                           class="form-control form-control-lg"
                                                           required>
                                                    <script>
                                                        BX.ready(function () {
                                                            var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                                            if (loginCookie) {
                                                                var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                                                var loginInput = form.elements["USER_LOGIN"];
                                                                loginInput.value = loginCookie;
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label class="font-weight-bold text-dark text-2"><?= GetMessage("AUTH_PASSWORD") ?></label>
                                                    <input type="password" name="USER_PASSWORD" value=""
                                                           class="form-control form-control-lg" autocomplete="off"
                                                           required>
                                                </div>
                                            </div>
                                            <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="USER_REMEMBER_frm"
                                                                   name="USER_REMEMBER" value="Y">
                                                            <label class="custom-control-label text-2"
                                                                   for="USER_REMEMBER_frm"
                                                                   title="<?= GetMessage("AUTH_REMEMBER_ME") ?>"><?= GetMessage("AUTH_REMEMBER_SHORT") ?></label>
                                                        </div>
                                                    </div>
                                                    <? if ($arResult["CAPTCHA_CODE"]): ?>
                                                        <tr>
                                                            <td colspan="2">
                                                                <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                                                                <input type="hidden" name="captcha_sid"
                                                                       value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                                                                <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                                                     width="180" height="40" alt="CAPTCHA"/><br/><br/>
                                                                <input type="text" name="captcha_word" maxlength="50"
                                                                       value=""/></td>
                                                        </tr>
                                                    <? endif ?>
                                                    <div class="form-group col-lg-6">
                                                        <input type="submit"
                                                               name="Login"
                                                               value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"
                                                               class="btn btn-primary btn-modern float-right"
                                                               data-loading-text="Loading...">
                                                    </div>
                                                </div>
                                            <? endif ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    <?
    elseif ($arResult["FORM_TYPE"] == "otp"):
        ?>

        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
              action="<?= $arResult["AUTH_URL"] ?>">
            <? if ($arResult["BACKURL"] <> ''): ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <? endif ?>
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="OTP"/>
            <table width="95%">
                <tr>
                    <td colspan="2">
                        <? echo GetMessage("auth_form_comp_otp") ?><br/>
                        <input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off"/></td>
                </tr>
                <? if ($arResult["CAPTCHA_CODE"]): ?>
                    <tr>
                        <td colspan="2">
                            <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                            <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                 width="180" height="40" alt="CAPTCHA"/><br/><br/>
                            <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                    </tr>
                <? endif ?>
                <? if ($arResult["REMEMBER_OTP"] == "Y"): ?>
                    <tr>
                        <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y"/>
                        </td>
                        <td width="100%"><label for="OTP_REMEMBER_frm"
                                                title="<? echo GetMessage("auth_form_comp_otp_remember_title") ?>"><? echo GetMessage("auth_form_comp_otp_remember") ?></label>
                        </td>
                    </tr>
                <? endif ?>
                <tr>
                    <td colspan="2"><input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <noindex><a href="<?= $arResult["AUTH_LOGIN_URL"] ?>"
                                    rel="nofollow"><? echo GetMessage("auth_form_comp_auth") ?></a></noindex>
                        <br/></td>
                </tr>
            </table>
        </form>

    <?
    else:
        ?>

    <? LocalRedirect('/profile/'); ?>

    <? endif ?>
</div>
