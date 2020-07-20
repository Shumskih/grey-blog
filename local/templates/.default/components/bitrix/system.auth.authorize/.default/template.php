<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="featured-boxes">
                <div class="row">
                    <div class="col-md-12">
                        <div class="featured-box featured-box-primary text-left mt-5">
                            <div class="box-content">
                                <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">
                                    <?= GetMessage("AUTH_PLEASE_AUTH") ?>
                                </h4>
                                <form name="form_auth"
                                      method="post"
                                      action="<?= $arResult["AUTH_URL"] ?>"
                                      id="frmSignIn"
                                      class="needs-validation">

                                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                                    <input type="hidden" name="TYPE" value="AUTH"/>
                                    <? if (strlen($arResult["BACKURL"]) > 0): ?>
                                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                                    <? endif ?>
                                    <? foreach ($arResult["POST"] as $key => $value): ?>
                                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                                    <? endforeach ?>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold text-dark text-2">
                                                <?= GetMessage("AUTH_LOGIN") ?>
                                            </label>
                                            <input type="text" name="USER_LOGIN" value="<?= $arResult["LAST_LOGIN"] ?>"
                                                   class="form-control form-control-lg"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold text-dark text-2">
                                                <?= GetMessage("AUTH_PASSWORD") ?>
                                            </label>
                                            <input type="password" name="USER_PASSWORD" value=""
                                                   class="form-control form-control-lg"
                                                   required autocomplete="off">
                                        </div>
                                    </div>

                                    <? if ($arResult["SECURE_AUTH"]): ?>
                                        <span class="bx-auth-secure" id="bx_auth_secure"
                                              title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                                        <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                                        </noscript>
                                        <script type="text/javascript">
                                            document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                        </script>
                                    <? endif ?>

                                    <? if ($arResult["CAPTCHA_CODE"]): ?>
                                        <tr>
                                            <td></td>
                                            <td><input type="hidden" name="captcha_sid"
                                                       value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                                                <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                                     width="180" height="40" alt="CAPTCHA"/></td>
                                        </tr>
                                        <tr>
                                            <td class="bx-auth-label"><? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:</td>
                                            <td><input class="bx-auth-input form-control" type="text"
                                                       name="captcha_word" maxlength="50"
                                                       value="" size="15"/></td>
                                        </tr>
                                    <? endif; ?>

                                    <div class="form-row">
                                        <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                                            <div class="form-group col-lg-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           name="USER_REMEMBER"
                                                           class="custom-control-input"
                                                           id="USER_REMEMBER"
                                                           value="Y">
                                                    <label class="custom-control-label text-2" for="USER_REMEMBER">
                                                        <?= GetMessage("AUTH_REMEMBER_ME") ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <? endif; ?>
                                        <div class="form-group col-lg-6">
                                            <input type="submit"
                                                   value="<?= GetMessage("AUTH_AUTHORIZE") ?>"
                                                   name="Login"
                                                   class="btn btn-primary btn-modern float-right"
                                                   data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    <?if (strlen($arResult["LAST_LOGIN"]) > 0):?>
    try {
        document.form_auth.USER_PASSWORD.focus();
    } catch (e) {
    }
    <?else:?>
    try {
        document.form_auth.USER_LOGIN.focus();
    } catch (e) {
    }
    <?endif?>
</script>
