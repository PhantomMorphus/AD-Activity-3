<?php

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Distribute the data using array key
$typeConfig = [
    'pgHost' => $_ENV['PG_HOST'],
    'pgPort' => $_ENV['PG_PORT'],
    'pgDB'   => $_ENV['PG_DB'],
    'pgUser' => $_ENV['PG_USER'],
    'pgPass' => $_ENV['PG_PASS'],

    'mgURI'  => $_ENV['MONGO_URI'],
    'mgPort' => $_ENV['MONGO_PORT'],
    'mgDB'   => $_ENV['MONGO_DB'],
    'mgUser' => $_ENV['MONGO_USER'],
    'mgPass' => $_ENV['MONGO_PASS']
];