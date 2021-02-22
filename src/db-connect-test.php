<?php

declare(strict_types=1);

require_once 'Config/DbConfig.php';

use App\Config\DbConfig;

$servername = DbConfig::DB_HOST;
$dbname = DbConfig::DB_NAME;
$username = DbConfig::DB_USER;
$password = DbConfig::DB_PASSWORD;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
