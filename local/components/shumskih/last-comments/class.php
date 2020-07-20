<?

use App\Api\User;
use App\Helpers\ArticlesHelper;
use App\Helpers\DateHelper;

class RecentComments extends CBitrixComponent
{
    private function _checkModules()
    {
        if (!CModule::includeModule('iblock')) {
            throw new \Exception('Не загружены необходимые модули');
        }
    }

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        try {
            $this->_checkModules();
        } catch (Exception $e) {
            $e->getMessage();
        }

        $this->arResult['ITEMS'] = $this->getComments();

        $this->includeComponentTemplate();
    }

    private function getComments()
    {
        $arParentComments = [];
        $arUsersIds = [];
        $arArticlesIds = [];

        //todo
        $arFilter = ["IBLOCK_ID" => $this->arParams['IBLOCK_ID']];
        $arParentCommentsResult = CIBlockElement::GetList(
            ["ID" => "DESC"],
            $arFilter,
            false,
            ["nTopCount" => 2],
            [
                'ID',
                "IBLOCK_ID",
                "ACTIVE_FROM",
                "CREATED_BY",
                'NAME',
                'PROPERTY_ARTICLE_ID'
            ]
        );

        while ($arFields = $arParentCommentsResult->GetNext()) {
            $arFields['DATE'] = DateHelper::getCommentsDate($arFields['ACTIVE_FROM']);
            $arParentComments[] = $arFields;
            $arArticlesIds[] = $arFields['PROPERTY_ARTICLE_ID_VALUE'];

            array_unshift($arUsersIds, $arFields["CREATED_BY"]);
        }

        $this->arResult['AUTHORS'] = $this->getUsersList($arUsersIds);
        $this->arResult['ARTICLE_URL'] = $this->getArticleUrl($arArticlesIds);

        return $arParentComments;
    }

    private function getArticleUrl(array $arArticlesIds): array
    {
        $articles = [];

        $arArticlesIds = array_unique($arArticlesIds);
        $arFilter = [
            "IBLOCK_ID" => $this->arParams['ARTICLES_IBLOCK_ID'],
            'ID' => $arArticlesIds
        ];
        $rsArticles = CIBlockElement::GetList(
            ["ID" => "DESC"],
            $arFilter,
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
                'DETAIL_PAGE_URL'
            ]
        );
        while ($article = $rsArticles->GetNext()) {
            $articles[$article['ID']] = $article['DETAIL_PAGE_URL'];
        }
        return $articles;
    }

    public function getUsersList(array $authorsIds)
    {
        $usersList = [];

        $filteredAuthorsIdsString = User::getFilteredUsersIdsString($authorsIds);

        $sort = 'ID';
        $order = 'ASC';
        $arFilter = [
            "ID" => $filteredAuthorsIdsString
        ];
        $arParameters = [
            'FIELDS' => [
                'ID',
                "NAME",
                "LAST_NAME",
                "PERSONAL_PHOTO"
            ]
        ];
        $rsUsers = CUser::GetList(
            $sort,
            $order,
            $arFilter,
            $arParameters
        );

        while ($user = $rsUsers->GetNext(true, false)) {
            $usersList[$user['ID']] = $user;
            $usersList[$user['ID']]["PERSONAL_PHOTO"] = $this->getAvatarPath($user['PERSONAL_PHOTO']);
        }
        return $usersList;
    }

    public function getAvatarPath($photoId)
    {
        return CFile::GetPath($photoId);
    }
}