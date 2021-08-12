<?php

require 'vendor/autoload.php';

use CustomDrv\MySql;
use CustomDrv\Migration;

//$connection = new MySql();

//$connection->insertRow('users', [
//    'email' => 'test@email.com',
//    'password' => 'testpassword123'
//    ]);

//$connection->updateRow('users', 4, [
//    'email' => 'test11111111@email.com',
//    'password' => 'test1111111111'
//]);


//$connection->get('users');


//$connection->findById('users', 1);

//$connection->countRows('users');

//$connection->delete('users', 3);

$migration = new Migration();

//$migration->createDb('proba');

//$migration->createTable('products', [
//    "id" => "int",
//    "title" => "varchar(191)",
//    "price" => "int",
//]);

//$migration->createColumn('products', 'size', 'varchar(191)');
$migration->dropColumn('products', 'size');