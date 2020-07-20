<?php


namespace App\Api\Repository\BitrixApiRepository;


interface BitrixApiRepository
{
    public function getAll(): array;
    public function getById(int $id);
}