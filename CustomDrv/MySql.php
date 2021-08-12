<?php

namespace CustomDrv;

class MySql {

    protected $connection;
    private $host;
    private $database;
    private $user;
    private $password;

    function __construct() 
    {
        $this->host = 'localhost';
        $this->database = 'sqltest';
        $this->user = 'konte';
        $this->password = '!Simatetreb1234';

        $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function insertRow(string $table_name, array $columns_values)
    {
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
    }

    public function updateRow(string $table_name, int $id, array $columns_values)
    {
        $str = "UPDATE $table_name SET ";
        $array = [];
        foreach ($columns_values as $column => $value) {
            $str .= "$column = :$column, ";
            $array[":$column"] = $value;
        }
        $str = \rtrim($str, ', ')." WHERE ID = $id";

        $this->connection->prepare($str)->execute($array);
    }

    public function get($table_name) 
    {
        $result = $this->connection->query("SELECT * FROM $table_name")->fetch();
        foreach($result as $r) {
            echo "{$r}" . PHP_EOL;
        }
    }

    public function findById(string $table_name, int $id): string 
    {
        $result = $this->connection->query("SELECT * FROM $table_name WHERE ID = $id")->fetch();
        if($result) {
            echo json_encode($result) . PHP_EOL;
        }
        return 'no results';
    }

    public function countRows(string $table_name)
    {
        $result = $this->connection->query("SELECT * FROM $table_name")->rowCount();
        if($result) {
            echo json_encode($result) . PHP_EOL;
        }
        return 'no results';
    }

    public function delete(string $table_name, int $id)
    {
        $this->connection->query("DELETE FROM $table_name WHERE ID = $id")->execute();
    }

}
