<?php

require_once BASE_PATH . '/utils/envSetter.util.php';

$mongoUri = $typeConfig['mgURI'];

try {
    $mongo = new MongoDB\Driver\Manager($mongoUri); 

    $command = new MongoDB\Driver\Command(["ping" => 1]);
    $mongo->executeCommand($typeConfig['mgDB'], $command);

    echo "✅ Connected to MongoDB successfully. <br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . $e->getMessage() . " <br>";
}
