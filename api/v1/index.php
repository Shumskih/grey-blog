<?
define('NOT_CHECK_PERMISSIONS', true);

use App\Api\Settings\SlimSettings;


require __DIR__ . '/../../local/vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/bootstrap.php';

$app = SlimSettings::setSettings();

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/v1/router.php';

$app->run();