<?php

require 'vendor/autoload.php';

use CustomDrv\MySql;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$connection = new MySql();

$connection->get('users');
