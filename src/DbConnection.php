<?php
require_once __DIR__ . '/config.php';

try {
    $connection = new PDO($dsn, $username, $password, $options);
    echo "Connected successfully";
}catch (PDOException $e){
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

