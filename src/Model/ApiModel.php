<?php
namespace Partez\Model;

use \Partez\Api\Starter as Api;

/**
 * Class ApiModel
 * 
 * This class is used to define a model for interacting with the Api.
 */
final class ApiModel
{
    /**
     * Fetch data from the API.
     *
     * @param string $url The URL to query.
     * @return array The response data.
     */
    public static function get(
        $url = ""
    ) {
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
        return $data;
    }

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