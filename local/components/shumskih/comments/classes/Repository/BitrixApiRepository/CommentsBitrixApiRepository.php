<?php

namespace Shumskih\Comments\Classes\Repository\BitrixApiRepository;

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/components/shumskih/comments/classes/Repository/BitrixApiRepository/Dao/CommentsDao.php';

use App\Helpers\DateHelper;
use CBitrixComponent;
use CDBResult;
use Shumskih\Comments\Classes\Repository\BitrixApiRepository\Dao\CommentsDao;

class CommentsBitrixApiRepository extends CBitrixComponent
{
    /**
     * @param int $articleId
     * @param int $user
     * @param int $iBlockId
     * @return bool
     * @throws \Exception
     */
    public static function save(int $articleId, int $user, int $iBlockId)
    {
        return CommentsDao::save($articleId, $user, $iBlockId);
    }

    /**
     * @param int $articleId
     * @param int $iBlockId
     * @param int $commentsCount
     * @return array
     */
    public static function getAll(int $articleId, int $iBlockId, int $commentsCount)
    {
        $parentComments = self::getParentComments($articleId, $iBlockId, $commentsCount);

        if ($parentComments['arParentCommentsIds'] > 0) {
            $parentComments['CHILD_COMMENTS'] = self::getChildComments($parentComments['arParentCommentsIds'], $iBlockId);
        }

        return $parentComments;
    }

    /**
     * @param int $articleId
     * @param int $iBlockId
     * @param int $commentsCount
     * @return array
     */
    public static function getParentComments(int $articleId, int $iBlockId, int $commentsCount)
    {
        $array = [];
        $arUsersIds = [];

        $result = CommentsDao::getParentComments($articleId, $iBlockId, $commentsCount);

        $array['NAV_STRING'] = self::setPagination($result);

        while ($arFields = $result->GetNext(true, false)) {
            $arFields['DATE'] = DateHelper::getCommentsDate($arFields['ACTIVE_FROM']);
            $array['ITEMS'][] = $arFields;
            $array['arParentCommentsIds'][] = $arFields['ID'];
            $arUsersIds[] = $arFields["CREATED_BY"];
        }

        $array['AUTHORS'] = UsersBitrixApiRepository::getByIds($arUsersIds);

        return $array;
    }

    /**
     * @param array $arParentCommentsIds
     * @param int $iBlockId
     * @return array
     */
    public static function getChildComments(array $arParentCommentsIds, int $iBlockId)
    {
        $array = [];
        $arUsersIds = [];

        $result = CommentsDao::getChildComments($arParentCommentsIds, $iBlockId);

        while ($arFields = $result->GetNext(true, false)) {
            $arFields['DATE'] = DateHelper::getCommentsDate($arFields['ACTIVE_FROM']);
            $array[$arFields['PROPERTY_PARENT_COMMENT_ID_VALUE']][] = $arFields;

            $arUsersIds[] = $arFields["CREATED_BY"];
        }

        $array['CHILD_COMMENTS_AUTHORS'] = UsersBitrixApiRepository::getByIds($arUsersIds);

        return $array;
    }

    /**
     * @param CDBResult $result
     * @return false|string
     */
    private static function setPagination(CDBResult $result)
    {
        $result->NavStart(0);
        return $result->GetPageNavStringEx($navComponentObject, "Комментарии:", "pager");
    }
}