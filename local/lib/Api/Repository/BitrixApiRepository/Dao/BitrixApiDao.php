<?php


namespace App\Api\Repository\BitrixApiRepository\Dao;


use CIBlockResult;

interface BitrixApiDao
{
    public function getAll(): CIBlockResult;
    public function getById(int $id): CIBlockResult;
}