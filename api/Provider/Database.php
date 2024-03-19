<?php 
namespace Partez\Api\Provider;

use \Partez\Api\View\Response;

/**
 * Class Database
 *
 * The Database class manages database connections and executes queries.
 * It interacts with the database using PDO and provides query execution functionality.
 */
final class Database {
    /**
     * @var \PDO|null $connection An instance of PDO representing the database connection.
     */
    private $connection;

    /**
     * @var Response $view An instance of Response for managing API responses.
     */
    private $view;

    /**
     * Constructor for the Database class.
     *
     * Initializes the object by creating an instance of Response.
     */
    public function __construct(

    ) {
        $this->view = new Response();
    }

    /**
     * Establishes a database connection using PDO.
     *
     * @return void
     * @throws \PDOException if the connection to the database fails.
     */
    private function setConnection(

    ) :void {
        try {
            $this->connection = new \PDO("mysql:host=".$_ENV["D_HOST"].";dbname=".$_ENV["D_NAME"].";charset=utf8mb4",$_ENV["D_USER"],$_ENV["D_PWD"]);
        } catch(\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Closes the database connection.
     *
     * @return void
     * @throws \PDOException if an error occurs while closing the connection.
     */
    private function unsetConnection(

    ) :void {
        try {
            $this->connection = null;
        } catch(\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Executes a database query and returns the result as an array.
     *
     * @param string $query The SQL query to execute (default: "")
     * @param array $params An array of parameters to bind to the query (default: [])
     * @return array An array containing query execution results and related information.
     */
    public function query(
        $query = "",
        $params = []
    ) :array {
        try {
            $this->setConnection();
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
                $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
                $state = $statement->rowCount();
            $statement->closeCursor();
            $this->unsetConnection();
        } catch(\PDOException $e) {
            $error = true;
            $message = $e->getMessage();
        }
        $this->view->set([
            "error" => $error ?? false,
            "message" => $message ?? "The request was successfully completed.",
            "state" => $state ?? "",
            "data" => $data ?? [],
        ]);
        return $this->view->get();
    }
}