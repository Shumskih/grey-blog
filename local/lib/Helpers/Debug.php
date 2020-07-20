<?php
namespace App\Helpers;

class Debug
{
    public static function run($data)
    {
        echo '<pre>' . print_r($data, 1) . '</pre>';
    }
}