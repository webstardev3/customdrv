<?php

namespace CustomDrv;

use Exception;
use PDOException;

class MySql {

    protected $connection;
    private $host;
    private $database;
    private $user;
    private $password;

    /**
     *	Constructor creates a new database connection
     */
    function __construct()
    {
        $this->host = getenv('HOST');
        $this->database = getenv('DATABASE');
        $this->user = getenv('USER');
        $this->password = getenv('PASSWORD');

        $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     *	Destructor closes database connection
     */
    function __destruct() {
        try {
            $this->connection = null;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function insertRow(string $table_name, array $columns_values)
    {
        try {
            $str = "INSERT INTO $table_name (";
            $array = [];
            foreach ($columns_values as $column => $value) {
                $str .= "$column, ";
            }
            // remove ', ' after last array item
            $str = \rtrim($str, ', ').") VALUES (";
            foreach ($columns_values as $column => $value) {
                $str .= ":$column, ";
                $array[":$column"] = $value;
            }
            // remove ', ' after last array item
            $str = \rtrim($str, ', ').");";
            $this->connection->prepare($str)->execute($array);
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    public function updateRow(string $table_name, int $id, array $columns_values)
    {
        try {
            $str = "UPDATE $table_name SET ";
            $array = [];
            foreach ($columns_values as $column => $value) {
                $str .= "$column = :$column, ";
                $array[":$column"] = $value;
            }
            $str = \rtrim($str, ', ')." WHERE ID = $id";

            $this->connection->prepare($str)->execute($array);
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    /**
     *
     */
    public function get($table_name)
    {
        try {
            $result = $this->connection->query("SELECT * FROM $table_name")->fetch();
            foreach ($result as $r) {
                echo "{$r}" . PHP_EOL;
            }
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    /**
     *
     */
    public function findById(string $table_name, int $id): string
    {
        try {
            $result = $this->connection->query("SELECT * FROM $table_name WHERE ID = $id")->fetch();
            if($result) {
                echo json_encode($result) . PHP_EOL;
            }
            return 'no results';
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    /**
     *
     */
    public function countRows(string $table_name)
    {
        try {
            $result = $this->connection->query("SELECT * FROM $table_name")->rowCount();
            if($result) {
                echo json_encode($result) . PHP_EOL;
            }
            return 'no results';
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    /**
     *
     */
    public function delete(string $table_name, int $id)
    {
        try {
            $this->connection->query("DELETE FROM $table_name WHERE ID = $id")->execute();
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

}
