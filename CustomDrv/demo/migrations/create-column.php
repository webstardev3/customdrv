<?php

require 'vendor/autoload.php';

use CustomDrv\Migration;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$migration = new Migration();

$migration->createColumn('products', 'size', 'varchar(191)');
