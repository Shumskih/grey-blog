<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вход");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	".default", 
	array(
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "/profile/",
		"REGISTER_URL" => "/registration/",
		"SHOW_ERRORS" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>