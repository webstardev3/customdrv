<?php

namespace CustomDrv;

class Migration extends MySql {

    public function createDb(string $db_name)
    {
        $str = "CREATE DATABASE $db_name; ";
        $this->connection->query($str);
    }

    public function createTable(string $tableName, array $columns_definitions)
    {
        $str = "CREATE TABLE $tableName (";
        foreach ($columns_definitions as $column => $definition) {
            $str .= "$column $definition, ";
        }
        $str = \rtrim($str, ', ').");";

        $this->connection->query($str);
    }

    public function createColumn(string $tableName, string $column_name, string $column_definition)
    {
        $str = "ALTER TABLE $tableName ADD $column_name $column_definition;";
        $this->connection->query($str);
    }

    public function dropColumn(string $tableName, string $column_name)
    {
        $str = "ALTER TABLE $tableName DROP COLUMN $column_name;";
        $this->connection->query($str);
    }
}