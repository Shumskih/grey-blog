<?php
$arUrlRewrite=array (
  3 => 
  array (
    'CONDITION' => '#^/registration(/?)$#',
    'PATH' => '/auth/registration.php',
    'SORT' => 50,
  ),
  7 => 
  array (
    'CONDITION' => '#^\\/profile(\\/)?#',
    'PATH' => '/personal/user-edit.php',
    'SORT' => 50,
  ),
  5 => 
  array (
    'CONDITION' => '#^/login(/?)?$#',
    'PATH' => '/auth/login.php',
    'SORT' => 50,
  ),
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/stati/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/api/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/api/v1/index.php',
    'SORT' => 100,
  ),
);
