<?

use App\Api\User;
use App\Helpers\DateHelper;

$arAuthorsIds = [];
$arArticlesIds = [];
$arArticlesIdsWithTimestamp = [];

foreach ($arResult['ITEMS'] as $item) {
    array_unshift($arAuthorsIds, $item['PROPERTIES']['AUTHOR']['ID']);
    array_unshift($arArticlesIds, $item['ID']);
    $arArticlesIdsWithTimestamp[$item['ID']] = $item['ACTIVE_FROM'];
}

$arResult['DATE'] = DateHelper::getArticleDate($arArticlesIdsWithTimestamp);


$categories = [];
$rsCategories = CIBlockElement::GetElementGroups(
    $arArticlesIds,
    false,
    [
        "NAME",
        "CODE",
        "IBLOCK_ELEMENT_ID"
    ]
);
while ($arSect = $rsCategories->Fetch()) {
    $categories[$arSect['IBLOCK_ELEMENT_ID']][] = [
        'NAME' => $arSect['NAME'],
        'CODE' => $arSect['CODE']
    ];
}
$arResult['CATEGORIES'] = $categories;

$arAuthorsIds = array_unique($arAuthorsIds);
$arResult['AUTHORS'] = getUsersList($arAuthorsIds);

// Количество комметариев к статьям
$arFilter = [
    "IBLOCK_ID"           => 2,
    "PROPERTY_ARTICLE_ID" => $arArticlesIds,
    "ACTIVE"              => "Y"
];
$countCommentsResult = CIBlockElement::GetList(
    [],
    $arFilter,
    ["PROPERTY_ARTICLE_ID"],
    false,
    []
);
$arResult['COUNT_COMMENTS'] = [];

while ($c = $countCommentsResult->Fetch()) {
    $arResult['COUNT_COMMENTS'][$c['PROPERTY_ARTICLE_ID_VALUE']] = $c['CNT'];
}

function getUsersList(array $authorsIds)
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
        $usersList[$user['ID']]["PERSONAL_PHOTO"] = getAvatarPath($user['PERSONAL_PHOTO']);
    }
    return $usersList;
}

function getAvatarPath($photoId)
{
    return CFile::GetPath($photoId);
}



