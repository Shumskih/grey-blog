<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="container py-2">

    <div class="row">
        <div class="col-lg-3 mt-4 mt-lg-0">
            <? ShowError($arResult["strProfileError"]); ?>

            <? if ($arResult['DATA_SAVED'] == 'Y'): ?>
                <div class="alert alert-success" role="alert">
                    <?= GetMessage('PROFILE_DATA_SAVED'); ?>
                </div>
            <? endif; ?>

            <form role="form"
                  name="form1"
                  method="post"
                  action="<?= $arResult["FORM_TARGET"] ?>"
                  class="needs-validation"
                  enctype="multipart/form-data">

                <div class="d-flex justify-content-center mb-4">
                    <div class="profile-image-outer-container">
                        <div class="profile-image-inner-container bg-color-primary">
                            <? if (strlen($arResult["arUser"]["PERSONAL_PHOTO"]) > 0): ?>
                                <? echo $arResult["arUser"]["PERSONAL_PHOTO_HTML"]; ?>

                            <? else: ?>
                                <img src="https://via.placeholder.com/400/0088cc/FFFFFF/?text=Upload+Avatar" alt="No Avatar">
                            <? endif; ?>
                            <span class="profile-image-button bg-color-dark">
                            <i class="fas fa-camera text-light"></i>
                        </span>
                        </div>
                        <input name="PERSONAL_PHOTO" type="file" id="file" class="profile-image-input">
                    </div>
                </div>

                <? if (strlen($arResult["arUser"]["PERSONAL_PHOTO"]) > 0): ?>
                <aside class="sidebar mt-2" id="sidebar">
                    <ul class="nav nav-list flex-column mb-5">
                        <li class="nav-item">
                            <a class="nav-link text-dark active" href="#">
                                <input type="checkbox" name="PERSONAL_PHOTO_del" value="Y" id="PERSONAL_PHOTO_del">
                                <label for="PERSONAL_PHOTO_del">Удалить файл</label>
                            </a>
                        </li>
                    </ul>
                </aside>
                <? endif ?>

        </div>
        <div class="col-lg-9">

            <div class="overflow-hidden mb-1">
                <h2 class="font-weight-normal text-7 mb-0"><strong
                            class="font-weight-extra-bold"><?= GetMessage('PROFILE_MY'); ?></strong>
                    <?= GetMessage('PROFILE'); ?></h2>
            </div>
            <div class="overflow-hidden mb-4 pb-3">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>


            <?= $arResult["BX_SESSION_CHECK"] ?>
            <input type="hidden" name="lang" value="<?= LANG ?>"/>
            <input type="hidden" name="ID" value=<?= $arResult["ID"] ?>/>

            <div class="form-group row">
                <label for="name" class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 <? if ($arResult["NAME_REQUIRED"]): ?>required<? endif ?>">
                    <?= GetMessage('PROFILE_FIRST_NAME') ?>
                </label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="NAME" id="name" value="<?= $arResult["arUser"]["NAME"] ?>"
                           required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 <? if ($arResult["SECOND_NAME_REQUIRED"]): ?>required<? endif ?>">
                    <?= GetMessage('SECOND_NAME') ?>
                </label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="SECOND_NAME"
                           value="<?= $arResult["arUser"]["SECOND_NAME"] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 <? if ($arResult["LAST_NAME_REQUIRED"]): ?>required<? endif ?>">
                    <?= GetMessage('LAST_NAME') ?>
                </label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="LAST_NAME"
                           value="<?= $arResult["arUser"]["LAST_NAME"] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 <? if ($arResult["EMAIL_REQUIRED"]): ?>required<? endif ?>">
                    <?= GetMessage('EMAIL') ?>
                </label>
                <div class="col-lg-9">
                    <input class="form-control" type="email" name="EMAIL"
                           value="<? echo $arResult["arUser"]["EMAIL"] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required"><?= GetMessage('LOGIN') ?></label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="LOGIN"
                           value="<? echo $arResult["arUser"]["LOGIN"] ?>" required>
                </div>
            </div>
            <? if ($arResult['CAN_EDIT_PASSWORD']): ?>
                <div class="form-group row">
                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">
                        <?= GetMessage('NEW_PASSWORD_REQ'); ?>
                    </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="password" name="NEW_PASSWORD" value="" autocomplete="off">
                    </div>
                </div>
            <? if ($arResult["SECURE_AUTH"]): ?>
                <span class="bx-auth-secure" id="bx_auth_secure"
                      title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>"
                      style="display:none">
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
                <div class="form-group row">
                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">
                        <?= GetMessage('NEW_PASSWORD_CONFIRM'); ?>
                    </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" value=""
                               autocomplete="off">
                    </div>
                </div>
                <p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
            <? endif; ?>

            <? // ********************* User properties ***************************************************?>
            <? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
                <div class="profile-link profile-user-div-link"><a
                            title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)"
                            onclick="SectionClick('user_properties')"><?= strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB") ?></a>
                </div>
                <div id="user_div_user_properties"
                     class="profile-block-<?= strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown" ?>">
                    <table class="data-table profile-table">
                        <thead>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <? $first = true; ?>
                        <? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
                            <tr>
                                <td class="field-name">
                                    <? if ($arUserField["MANDATORY"] == "Y"): ?>
                                        <span class="starrequired">*</span>
                                    <? endif; ?>
                                    <?= $arUserField["EDIT_FORM_LABEL"] ?>:
                                </td>
                                <td class="field-value">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:system.field.edit",
                                        $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                        array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS" => "Y")); ?></td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <? endif; ?>
            <? // ******************** /User properties ***************************************************?>

            <div class="form-group row">
                <div class="form-group col-lg-9">

                </div>
                <div class="form-group col-lg-3">
                    <input type="submit"
                           value="<?= (($arResult["ID"] > 0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD")) ?>"
                           name="save" class="btn btn-primary btn-modern float-right"
                           data-loading-text="Loading...">
                </div>
            </div>
            </form>

        </div>
    </div>

</div>