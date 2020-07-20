<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<h4 class="mb-3"><?= GetMessage("SHARE_THIS_POST") ?></h4>
<div class="share-buttons flex">
    <? if ($arParams['VK'] == 'Y'): ?>
        <div class="share-buttons_icon">
            <a onclick="Share.vkontakte(
                    '<?= $arParams['SOCIAL_BUTTONS']['URL']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['NAME']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['IMG'] ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['DESCRIPTION']; ?>')">
                <img src="/local/components/shumskih/share-buttons/images/vk.svg" alt="Поделиться во Вконтакте">
            </a>
        </div>
    <? endif; ?>
    <? if ($arParams['FACEBOOK'] == 'Y'): ?>
        <div class="share-buttons_icon" data-href="<?= $_SESSION['url']; ?>">
            <a onclick="Share.facebook(
                    '<?= $arParams['SOCIAL_BUTTONS']['URL']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['NAME']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['IMG'] ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['DESCRIPTION']; ?>')">
                <img src="/local/components/shumskih/share-buttons/images/facebook.svg" alt="Поделиться в Фейсбуке">
            </a>
        </div>
    <? endif; ?>
    <? if ($arParams['MAILRU'] == 'Y'): ?>
        <div class="share-buttons_icon">
            <a onclick="Share.mailru(
                    '<?= $arParams['SOCIAL_BUTTONS']['URL']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['NAME']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['IMG'] ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['DESCRIPTION']; ?>')">
                <img src="/local/components/shumskih/share-buttons/images/mailru.svg" alt="Поделиться в Моём Мире">
            </a>
        </div>
    <? endif; ?>
    <? if ($arParams['OK'] == 'Y'): ?>
        <div class="share-buttons_icon">
            <a onclick="Share.odnoklassniki(
                    '<?= $arParams['SOCIAL_BUTTONS']['URL']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['NAME']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['IMG'] ?>',)">
                <img src="/local/components/shumskih/share-buttons/images/odnoklassniki.svg" alt="Поделиться в одноклассниках">
            </a>
        </div>
    <? endif; ?>
    <? if ($arParams['TWITTER'] == 'Y'): ?>
        <div class="share-buttons_icon">
            <a onclick="Share.twitter(
                    '<?= $arParams['SOCIAL_BUTTONS']['URL']; ?>',
                    '<?= $arParams['SOCIAL_BUTTONS']['NAME']; ?>')">
                <img src="/local/components/shumskih/share-buttons/images/twitter.svg" alt="Поделиться в Твиттере">
            </a>
        </div>
    <? endif; ?>
</div>