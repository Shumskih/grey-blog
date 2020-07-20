<?php

namespace App\Helpers;

class DateHelper
{
    public static function getArticleDate(array $articlesIdsWithTimestamps): array
    {
        $array = [];
        foreach ($articlesIdsWithTimestamps as $id => $timestamp) {
            $date = FormatDate(
                "d M",
                MakeTimeStamp($timestamp)
            );
            $array[$id] = explode(' ', $date);
        }
        return $array;
    }

    public static function getArticleDateForApi(string $timestamp): string
    {
        return $date = FormatDate(
            "d M",
            MakeTimeStamp($timestamp)
        );
    }

    public static function getCommentsDate(string $timestamp): string
    {
        return FormatDate(
            "x",
            MakeTimeStamp($timestamp),
            time()
        );
    }
}