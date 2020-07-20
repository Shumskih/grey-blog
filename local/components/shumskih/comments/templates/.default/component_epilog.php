<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(
    'C:\PhpstormProjects\grey-blog\local\components\shumskih\comments\templates\.default\lang\ru\template.php',
    'ru'
);
Loc::loadLanguageFile(
    'C:\PhpstormProjects\grey-blog\local\components\shumskih\comments\templates\.default\lang\en\template.php',
    'en'
);
?>

<div class="post-block mt-5 post-leave-comment">
    <? if ($USER->IsAuthorized()): ?>
        <h4 class="mb-3"><?= Loc::getMessage('LEAVE_A_COMMENT'); ?></h4>

        <form id="contactForm" class="contact-form p-4 rounded bg-color-grey" action="" method="POST">
            <input type="hidden" name="parent-comment-id" id="parentId" value="">
            <div class="p-2">
                <div class="form-row">
                    <div class="form-group col" id="messageDiv">
                        <label class="required font-weight-bold text-dark" id="message"
                               for="message"><?= GetMessage('COMMENT'); ?></label>
                        <textarea maxlength="5000"
                                  data-msg-required="Please enter your message."
                                  rows="8"
                                  class="form-control" name="message" id="message"
                                  placeholder="<?= GetMessage("ENTER_MESSAGE") ?>"
                                  required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <input type="submit" value="<?= GetMessage('POST_COMMENT') ?>"
                               class="btn btn-primary btn-modern"
                               data-loading-text="Loading...">
                    </div>
                </div>
            </div>
        </form>
    <? else: ?>
        <p>Для отправки комментариев необходимо авторизоваться!</p>
    <? endif; ?>
</div>
