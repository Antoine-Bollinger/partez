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
     * @var Response $view An instance of Response for managing API responses.
     */
    private Response $view;

    /**
     * Constructor for the Database class.
     *
     * Initializes the object by creating an instance of Response.
     */
    public function __construct(
        public string $host,
        public string $name,
        private string $user,
        private string $password
    ) {
        $this->view = new Response();
    }

    /**
     * Establishes a database connection using PDO.
     *
     * @return \PDO a connection to the database.
     * @throws \PDOException if the connection to the database fails.
     */
    private function setConnection(

    ) :\PDO {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";
            return new \PDO($dsn, $this->user, $this->password);
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
        string $query = "",
        array $params = []
    ) :array {
        try {
            $connection = $this->setConnection();
            $statement = $connection->prepare($query);
            $statement->execute($params);
                $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
                $state = $statement->rowCount();
            $statement->closeCursor();
            $connection = null;
        } catch(\PDOException $e) {
            $error = true;
            $message = $e->getMessage();
        }
        return $this->view->set([
            "error" => $error ?? false,
            "message" => $message ?? "The request was successfully completed.",
            "state" => $state ?? "",
            "data" => $data ?? [],
        ]);
        // return $this->view->get();
    }

    /**
     * Reads an SQL file and executes its contents on the database.
     *
     * @param string $path The path to the SQL file.
     *
     * @return array An array containing information about the operation:
     *               - 'error' (bool): Indicates if an error occurred during execution.
     *               - 'message' (string): A message describing the result of the operation.
     *               - 'state' (string): The state of the operation, if applicable.
     *               - 'data' (array): Additional data related to the operation.
     */
    public function readSqlFile(
        string $path = ""
    ) :array {
        try {
            if (!$path || $path === "")
                throw new \PDOException("Please provide a valid path to a sql file.");
            $connection = $this->setConnection();
            $sql = file_get_contents($path);
            $connection->exec("USE {$this->name}");
            $connection->exec($sql);
            $connection = null;
        } catch(\PDOException $e) {
            $error = true;
            $message = $e->getMessage();
        }
        return $this->view->set([
            "error" => $error ?? false,
            "message" => $message ?? "The request was successfully completed.",
            "state" => $state ?? "",
            "data" => $data ?? [],
        ]);
    }
}