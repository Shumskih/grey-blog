<?php


namespace App\Api\Repository\BitrixApiRepository\Dao;


use CModule;

abstract class EntitiesBitrixApiDao implements BitrixApiDao
{
    public function __construct()
    {
        if (!CModule::IncludeModule('iblock')) {
            CModule::IncludeModule('iblock');
        }
    }
}