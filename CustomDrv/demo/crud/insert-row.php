<?php

require 'vendor/autoload.php';

use CustomDrv\MySql;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$connection = new MySql();

$connection->insertRow('users', [
    'email' => 'test@email.com',
    'password' => 'password'
]);
