<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ .'../../');
$dotenv->load();

require 'web.php';
require 'database.php';

//instantiate app
$app = AppFactory::create();

require __DIR__ . '/../routes/api.php';