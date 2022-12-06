<?php 
namespace Abollinger\PHPStarter\Api;

opcache_reset();

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/config/Helpers.class.php";
require_once __DIR__ . "/config/Bootstrap.class.php";

require_once __DIR__ . "/router/Router.class.php";

$path = parse_url(str_replace(API_SUBDIR, "", $_SERVER['REQUEST_URI']), PHP_URL_PATH) ?? "";
$api = new Router($path);
$api->start();