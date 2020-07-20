<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
    "GROUPS" => array(
        "BUTTONS"    =>  array(
            "NAME"  =>  GetMessage('SHARE_BUTTONS_SETTINGS'),
            "SORT"  =>  "200",
        ),
    ),
    "PARAMETERS" => array(
        "VK"    =>  array(
            "PARENT"    =>  "BUTTONS",
            "NAME"      =>  GetMessage('VK'),
            "TYPE"      =>  "CHECKBOX",
        ),
        "FACEBOOK"  =>  array(
            "PARENT"    =>  "BUTTONS",
            "NAME"      =>  GetMessage('FACEBOOK'),
            "TYPE"      =>  "CHECKBOX",
        ),
        "MAILRU"  =>  array(
            "PARENT"    =>  "BUTTONS",
            "NAME"      =>  GetMessage('MAILRU'),
            "TYPE"      =>  "CHECKBOX",
        ),
        "OK"  =>  array(
            "PARENT"    =>  "BUTTONS",
            "NAME"      =>  GetMessage('OK'),
            "TYPE"      =>  "CHECKBOX",
        ),
        "TWITTER"  =>  array(
            "PARENT"    =>  "BUTTONS",
            "NAME"      =>  GetMessage('TWITTER'),
            "TYPE"      =>  "CHECKBOX",
        ),
    ),
);