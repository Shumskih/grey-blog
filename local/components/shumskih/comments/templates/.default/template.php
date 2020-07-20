<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $count = 0; ?>
    <div id="comments" class="post-block mt-5 post-comments">
        <h4 class="mb-3"><?= GetMessage("COMMENTS"); ?></h4>

        <ul class="comments">
            <? foreach ($arResult['ITEMS'] as $item): ?>
                <li>
                    <div class="comment">
                        <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                            <? if (strlen($arResult['AUTHORS'][$item['CREATED_BY']]['PERSONAL_PHOTO']) > 0): ?>
                                <?= CFile::ShowImage($arResult['AUTHORS'][$item['CREATED_BY']]['PERSONAL_PHOTO'], 40, 40, 'class=avatar', '', false); ?>
                            <? else: ?>
                                <img class="avatar" src="https://via.placeholder.com/40/0088cc/FFFFFF/?text=No+Avatar"
                                     alt="No Avatar">
                            <? endif; ?>
                        </div>
                        <div class="comment-block">
                            <div class="comment-arrow"></div>
                            <span class="comment-by">
                                <strong id="authorName"><?= $arResult['AUTHORS'][$item['CREATED_BY']]['NAME'] . ' ' . $arResult['AUTHORS'][$item['CREATED_BY']]['LAST_NAME']; ?></strong>
                                <? if ($USER->IsAuthorized()): ?>
                                    <span class="float-right">
                                        <span>
                                            <a href="#message" id="reply"
                                               onclick="reply('<?= $arResult['AUTHORS'][$item['CREATED_BY']]['NAME'] . ' ' . $arResult['AUTHORS'][$item['CREATED_BY']]['LAST_NAME']; ?>', '<?= $item['ID']; ?>')">
                                                <i class="fas fa-reply"></i>
                                                <?= GetMessage("COMMENTS_REPLY") ?>
                                            </a>
                                        </span>
                                    </span>
                                <? endif; ?>
                            </span>
                            <p><?= $item['NAME']; ?></p>
                            <span class="date float-right"><?= $item['DATE']; ?></span>
                        </div>
                    </div>
                    <span class="hidden" style="display:none;"><?= $item['ID']; ?></span>
                    <? if (isset($arResult['CHILD_COMMENTS'][$item['ID']])): ?>
                        <div id="showAnswers-<?= $count; ?>" onclick="showAnswers(<?= $count; ?>)" class="showAnswers">
                            <?= GetMessage('SHOW_ANSWERS'); ?> <i class="fas fa-angle-down"></i>
                        </div>
                        <div id="hideAnswers-<?= $count ?>" style="display:none;" onclick="hideAnswers(<?= $count; ?>)"
                             class="hideAnswers">
                            <?= GetMessage('HIDE_ANSWERS'); ?> <i class="fas fa-angle-up"></i>
                        </div>
                        <? // Nested comments ?>
                        <div id="replies-<?= $count; ?>" style="display:none;">
                            <? foreach ($arResult['CHILD_COMMENTS'][$item['ID']] as $childComment): ?>
                                <ul class="comments reply">
                                    <li>
                                        <div class="comment">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                <? if (strlen($arResult['CHILD_COMMENTS']['CHILD_COMMENTS_AUTHORS'][$childComment['CREATED_BY']]['PERSONAL_PHOTO']) > 0): ?>
                                                    <?= CFile::ShowImage($arResult['CHILD_COMMENTS']['CHILD_COMMENTS_AUTHORS'][$childComment['CREATED_BY']]['PERSONAL_PHOTO'], 40, 40, 'class=avatar', '', false); ?>
                                                <? else: ?>
                                                    <img src="https://via.placeholder.com/40/0088cc/FFFFFF/?text=No+Avatar"
                                                         alt="No Avatar">
                                                <? endif; ?>
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
                                                    <strong id="authorName"><?= $arResult['CHILD_COMMENTS']['CHILD_COMMENTS_AUTHORS'][$childComment['CREATED_BY']]['NAME'] . ' ' . $arResult['CHILD_COMMENTS']['CHILD_COMMENTS_AUTHORS'][$childComment['CREATED_BY']]['LAST_NAME']; ?></strong>
                                                    <? if ($USER->IsAuthorized()): ?>
                                                        <span class="float-right">
                                                            <span>
                                                                <a href="#" id="reply"
                                                                   onclick="reply('<?= $arResult['CHILD_COMMENTS_AUTHORS'][$childComment['CREATED_BY']]['NAME'] . ' ' . $arResult['CHILD_COMMENTS_AUTHORS'][$childComment['CREATED_BY']]['LAST_NAME']; ?>', '<?= $item['ID']; ?>')">
                                                                    <i class="fas fa-reply"></i>
                                                                    <?= GetMessage("COMMENTS_REPLY") ?>
                                                                </a>
                                                            </span>
                                                        </span>
                                                    <? endif; ?>
                                                </span>
                                                <p><?= $childComment['NAME']; ?></p>
                                                <span class="date float-right"><?= $childComment['DATE']; ?></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            <? endforeach; ?>
                        </div>
                        <? // End Nested comments ?>
                    <? endif; ?>
                </li>
                <? $count++; ?>
            <? endforeach; ?>
        </ul>
    </div>
<?= $arResult["NAV_STRING"]; ?>