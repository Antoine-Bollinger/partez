<?php 
namespace Abollinger\PHPStarter\Api;

class Database 
{
    private $connection = null;
    private $dbname = "";

    public function __construct(
        $params = null
    ) {
        $this->createDatabase(DB_DATABASE);
    }

    /**
     * Select request on a table
     * 
     */
    public function executeQuery(
        $query = "",
        $params = []
    ) {
        try {
            $this->setConnection();
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
                $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
                $state = $statement->rowCount();
            $statement->closeCursor();
            $this->unsetConnection();
            
        } catch(\Exception $e) {
            $data = ["code" => $e->getCode(), "message" => $e->getMessage()];
        }
        return array(
            "data" => ($data ?? []),
            "state" => ($states ?? "")
        );
    }

    /**
     * Set a new PDO connection do mysql Database
     */
    private function setConnection(

    ) {
        try {
            $this->connection = new \PDO("mysql:host=" . DB_HOST . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
            if ($this->dbname !== "")
                $this->connection->exec("USE " . $this->dbname);
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }  
    }

    /**
     * Unset the connection
     */
    private function unsetConnection(

    ) {
        $this->connection = null;
    }

    /**
     * Create the database if not exists
     */
    private function createDatabase(
        $dbname = "new_database"
    ) {
        try {
            $this->setConnection();
            $statement = $this->connection->prepare("CREATE DATABASE IF NOT EXISTS " . $dbname . " CHARACTER SET UTF8 COLLATE utf8_bin");
            $statement->execute();
            $statement->closeCursor();
            $this->unsetConnection();
            $this->dbname = $dbname;            
        } catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return $this->dbname ?? $message;
    }
}