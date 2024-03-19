<?php
namespace Partez\Api\Abstract;

use \Partez\Api\Provider\Database;

/**
 * Class Model
 *
 * The abstract Model class serves as a base for API models interacting with the database.
 * It initializes a Database instance for database operations.
 */
abstract class Model 
{
    /**
     * @var Database $db Instance of the Database class for database interactions.
     */
    protected $db;

    /**
     * Constructor for the Model class.
     *
     * Initializes the object by creating an instance of the Database class for database operations.
     */
    public function __construct(

    ) {
        $this->db = new Database();     
    }
}
