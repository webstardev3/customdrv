<?php

require 'vendor/autoload.php';

use CustomDrv\MySql;

$connection = new MySql();

$connection->insertRow('users', [
    'email' => 'test@email.com',
    'password' => 'testpassword123'
    ]);
