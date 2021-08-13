<?php

namespace CustomDrv;

use Exception;

class Migration extends MySql {

    public function createDb(string $db_name)
    {
        $str = "CREATE DATABASE $db_name; ";
        $this->connection->query($str);
    }

    public function createTable(string $tableName, array $columns_definitions)
    {
        try {
            $str = "CREATE TABLE $tableName (";
            foreach ($columns_definitions as $column => $definition) {
                $str .= "$column $definition, ";
            }
            $str = \rtrim($str, ', ').");";

            $this->connection->query($str);
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    public function createColumn(string $tableName, string $column_name, string $column_definition)
    {
        try {
            $str = "ALTER TABLE $tableName ADD $column_name $column_definition;";
            $this->connection->query($str);
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }

    public function dropColumn(string $tableName, string $column_name)
    {
        try {
            $str = "ALTER TABLE $tableName DROP COLUMN $column_name;";
            $this->connection->query($str);
        } catch (Exception $e) {
            die("There's an error in the query! Message:" . $e->getMessage());
        }
    }
}