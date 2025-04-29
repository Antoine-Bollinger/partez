<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Partez\Models;

use \Partez\Api\Starter as Api;

/**
 * Class ApiModel
 * 
 * This class is used to define a model for interacting with the Api.
 */
final class ApiModel
{
    /**
     * Fetch data from the API with GET method
     *
     * @param string $url The URL to query.
     * @param array $get get data
     * 
     * @return array The response data.
     */
    public static function get(
        $url = "",
        $get = []
    ) :array {
        $tmp = $_GET;
        $_GET = array_merge($_GET, $get);
        try {
            $api = new Api([
                "url" => "/api$url",
                "verb" => "GET",
                "isSameServer" => true
            ]);
            $response = $api->get();
            if (!$response["success"])
                throw new \Exception($response["message"] ?? "", $response["code"] ?? 500);
            $data = $response["data"];
        } catch(\Exception $e) {
            $data = [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        }
        unset($_GET);
        $_GET = $tmp;
        return $data;
    }

    /**
     * Fetch data from the API with POST method
     *
     * @param string $url The URL to query.
     * @param array $post post data
     * 
     * @return array The response data.
     */
    public static function post(
        $url = "",
        $post = []
    ) {
        $tmp = $_POST;
        $_POST = array_merge($_POST, $post);
        try {
            $api = new Api([
                "url" => "/api$url",
                "verb" => "POST",
                "isSameServer" => true
            ]);
            $response = $api->get();
            if (!$response["success"])
                throw new \Exception($response["message"] ?? "", $response["code"] ?? 500);
            $data = $response["data"];
        } catch(\Exception $e) {
            $data = [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        }
        unset($_POST);
        $_POST = $tmp;
        return $data;
    }
}