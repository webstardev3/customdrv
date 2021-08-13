<?php

require 'vendor/autoload.php';

use CustomDrv\MySql;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$connection = new MySql();

$connection->updateRow('users', 1, [
    'email' => 'testUPDATED@email.com',
    'password' => 'passwordUPDATED'
]);