<?php 
namespace Partez\Api\Model;

use \Partez\Api\Abstract;

final class AuthModel extends Abstract\Model 
{
    /**
     * Retrieves a user by ID.
     *
     * @param array $params     An array containing parameters (e.g., ['userId' => 999]).
     * @return array            Returns the query result based on a Response view pattern.
     */
    public function getUser(
        $params
    ) :array {
        return $this->db->query("SELECT * FROM `users` WHERE `userId` LIKE :userId", $params);
    }
}