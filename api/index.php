<?php 
namespace Abollinger\Partez\Api;

use Symfony\Component\Dotenv\Dotenv;
use \Abollinger\Partez\Router\ApiRouter;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$dotenv = new Dotenv();
if (file_exists(dirname(__DIR__).'/.env'))
    $dotenv->load(dirname(__DIR__).'/.env');

if (isset($_ENV["APP_ENV"]) && $_ENV["APP_ENV"] === "dev")
    opcache_reset();

require_once dirname(__DIR__) . "/config/bootstrap.php";
require_once dirname(__DIR__) . "/config/helpers.php";
require_once dirname(__DIR__) . "/config/router.php";
require_once __DIR__ . "/config/bootstrap.php";

require_once API_ROUTER_PATH . "/Api.router.php";

$path = parse_url(str_replace(API_SUBDIR, "", $_SERVER['REQUEST_URI']), PHP_URL_PATH) ?? "";
$api = new ApiRouter(
    $path, 
    [
        API_ROOT . "/router/products.yaml",
        API_ROOT . "/router/users.yaml",
    ]
);
$api->start();