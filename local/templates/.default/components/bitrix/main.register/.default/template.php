<?
/*
 * Файл local/templates/.default/components/bitrix/main.register/.default/template.php
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if ($USER->IsAuthorized()): /* если пользователь уже авторизован */ ?>
    <? LocalRedirect('/profile/'); ?>
<? endif; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="featured-boxes">
                <div class="row">
                    <div class="col-md-12">
                        <div class="featured-box featured-box-primary text-left mt-5">
                            <div class="box-content">
                                <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3"><?= GetMessage('MAIN_REGISTER_FORM_TITLE'); ?></h4>
                                <? if (count($arResult["ERRORS"]) > 0): /* сообщения об ошибках при заполнении формы */ ?>
                                    <? foreach ($arResult["ERRORS"] as $key => $error) {
                                        if (intval($key) == 0 && $key !== 0) {
                                            $arResult["ERRORS"][$key] = str_replace(
                                                "#FIELD_NAME#",
                                                '«' . GetMessage('MAIN_REGISTER_' . $key) . '»',
                                                $error
                                            );
                                        }
                                    }
                                    ShowError(implode("<br />", $arResult["ERRORS"]));
                                    ?>
                                <? elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
                                    <p><?= GetMessage('MAIN_REGISTER_EMAIL_HELP'); /* будет отправлено письмо для подтверждения */ ?></p>
                                <? endif; ?>
                                <form action="<?= POST_FORM_ACTION_URI; ?>" id="frmSignUp" method="post"
                                      class="needs-validation" enctype="multipart/form-data">

                                    <? if ($arResult["BACKURL"] <> ''): ?>
                                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"]; ?>"/>
                                    <? endif; ?>

                                    <? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
                                        <? if ($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"]): /* часовой пояс */ ?>
                                            <!-- код удален -->
                                            <? continue; ?>
                                        <? endif; ?>

                                        <? if ($FIELD == "PASSWORD"): /* пароль */ ?>
                                            <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold text-dark text-2">
                                                    <?= GetMessage('MAIN_REGISTER_' . $FIELD); ?>
                                                </label>
                                                <? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?>
                                                    <i class="required">*</i>
                                                <? endif; ?>
                                                <input type="password" name="REGISTER[<?= $FIELD; ?>]"
                                                       value="<?= $arResult["VALUES"][$FIELD]; ?>"
                                                       class="form-control form-control-lg"
                                                       autocomplete="off"
                                                       required/>
                                            </div>
                                        <? elseif ($FIELD == "CONFIRM_PASSWORD"): /* подтверждение пароля */ ?>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold text-dark text-2">
                                                    <?= GetMessage('MAIN_REGISTER_' . $FIELD); ?>
                                                </label>
                                                <? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?>
                                                    <i class="required">*</i>
                                                <? endif; ?>
                                                <input type="password" name="REGISTER[<?= $FIELD; ?>]"
                                                       value="<?= $arResult["VALUES"][$FIELD]; ?>"
                                                       class="form-control form-control-lg"
                                                       autocomplete="off"
                                                       required/>
                                            </div>
                                            </div>
                                        <? elseif ($FIELD == "NAME"): ?>
                                            <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold text-dark text-2">
                                                    <?= GetMessage('MAIN_REGISTER_' . $FIELD); ?>
                                                </label>
                                                <input type="text"
                                                       name="REGISTER[<?= $FIELD; ?>]"
                                                       value="<?= $arResult["VALUES"][$FIELD]; ?>"
                                                       class="form-control form-control-lg"
                                                />
                                            </div>
                                        <? elseif ($FIELD == "LAST_NAME"): ?>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold text-dark text-2">
                                                    <?= GetMessage('MAIN_REGISTER_' . $FIELD); ?>
                                                </label>
                                                <input type="text"
                                                       name="REGISTER[<?= $FIELD; ?>]"
                                                       value="<?= $arResult["VALUES"][$FIELD]; ?>"
                                                       class="form-control form-control-lg"
                                                />
                                            </div>
                                            </div>
                                        <? else: ?>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label class="font-weight-bold text-dark text-2">
                                                        <?= GetMessage('MAIN_REGISTER_' . $FIELD); ?>
                                                    </label>
                                                    <? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?>
                                                        <i class="required">*</i>
                                                    <? endif; ?>
                                                    <input type="text"
                                                           name="REGISTER[<?= $FIELD; ?>]"
                                                           value="<?= $arResult["VALUES"][$FIELD]; ?>"
                                                           class="form-control form-control-lg"
                                                    />
                                                </div>
                                            </div>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <? if ($arResult["USE_CAPTCHA"] == "Y"): /* использовать CAPTCHA? */ ?>
                                        <div class="form-group col-6 mt-5 mb-5">
                                            <h5><?= GetMessage('SYS_AUTH_REGISTRATION_CAPTCHA_TITLE'); /* Защита от роботов */ ?></h5>
                                            <div class="mb-3">
                                                <input type="hidden" name="captcha_sid"
                                                       value="<?= $arResult["CAPTCHA_CODE"]; ?>"/>
                                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"]; ?>"
                                                     width="180" height="40" alt=""/>
                                            </div>
                                            <div>
                                                <?= GetMessage('SYS_AUTH_REGISTRATION_CAPTCHA_TEXT'); /* введите код с картинки */ ?>
                                                <i class="required">*</i> <!-- поле обязательно для заполнения -->
                                            </div>
                                            <span>
                                                <input type="text" name="captcha_word" maxlength="50" value=""
                                                       class="form-control form-control-lg"/>
                                            </span>
                                        </div>
                                    <? endif; ?>
                                    <p>
                                        <?= $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; /* предупреждение о min длине пароля */ ?>
                                    </p>
                                    <p>
                                        <i class="required">*</i> <?= GetMessage('MAIN_REGISTER_REQUIRED'); /* Эти поля обязательны для заполнения */ ?>
                                    </p>
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <input type="submit"
                                                   name="register_submit_button"
                                                   class="btn btn-primary btn-modern float-right"
                                                   value="<?= GetMessage('MAIN_REGISTER_FORM_SUBMIT'); ?>"
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