<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/components/shumskih/comments/classes/Repository/BitrixApiRepository/CommentsBitrixApiRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/components/shumskih/comments/classes/Repository/BitrixApiRepository/UsersBitrixApiRepository.php';

use Shumskih\Comments\Classes\Repository\BitrixApiRepository\CommentsBitrixApiRepository;

class Comments extends CBitrixComponent
{
    private function _checkModules()
    {
        if (!CModule::includeModule('iblock')) {
            throw new Exception('Не загружены необходиые модули');
        }
    }

    private function _app()
    {
        global $APPLICATION;
        return $APPLICATION;
    }

    private function _user()
    {
        global $USER;
        return $USER;
    }

    public function onPrepareComponentParams($arParams)
    {
        if (intval($arParams['COMMENTS_COUNT'] == 0)) {
            $arParams['COMMENTS_COUNT'] = 3;
        }
        return $arParams;
    }

    public function executeComponent()
    {
        try {
            $this->_checkModules();
        } catch (Exception $e) {
            $e->getMessage();
        }

        if ($this->StartResultCache(3600, $_GET['PAGEN_2'], false)) {
            if (isset($_POST['message'])) {
                try {
                    CommentsBitrixApiRepository::save($this->arParams['ARTICLE_ID'], $this->_user()->GetID(), $this->arParams['IBLOCK_ID']);
                } catch (Exception $e) {
                    $e->getMessage();
                }
                LocalRedirect($this->_app()->GetCurPage(false));
            }

            $this->arResult = CommentsBitrixApiRepository::getAll($this->arParams['ARTICLE_ID'], $this->arParams['IBLOCK_ID'], $this->arParams['COMMENTS_COUNT']);
            unset($this->arResult['arParentCommentsIds']);

            $this->includeComponentTemplate();

            $this->EndResultCache();
        } else {
            if (isset($_POST['message'])) {
                $this->AbortResultCache();
                try {
                    CommentsBitrixApiRepository::save($this->arParams['ARTICLE_ID'], $this->_user()->GetID(), $this->arParams['IBLOCK_ID']);
                } catch (Exception $e) {
                    $e->getMessage();
                }
                LocalRedirect($this->_app()->GetCurPage(false));
            }
        }
    }
}
