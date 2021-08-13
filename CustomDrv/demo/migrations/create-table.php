<?php

require 'vendor/autoload.php';

use CustomDrv\Migration;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$migration = new Migration();

$migration->createTable('products', [
    "id" => "int",
    "title" => "varchar(191)",
    "price" => "int",
]);
