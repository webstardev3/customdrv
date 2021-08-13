<?php

require 'vendor/autoload.php';

use CustomDrv\Migration;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$migration = new Migration();

$migration->createDb('products');
