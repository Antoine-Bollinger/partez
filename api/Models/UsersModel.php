<?php 
namespace Partez\Api\Models;

use \Partez\Api\Abstract;

final class UsersModel extends Abstract\Model 
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
        return $this->db->query("SELECT `userId` FROM `users` WHERE `userId` LIKE :userId", $params);
    }

    /**
     * Retrieves all users.
     *
     * @return array            Returns the query result based on a Response view pattern.
     */
    public function getUsers(
    ) :array {
        return $this->db->query("SELECT `userId` FROM `users`");
    }
}