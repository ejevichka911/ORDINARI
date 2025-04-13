<?php
header('Content-Type: application/json');

$host = '************'; // хост
$username = '************'; // имя пользователя
$password = '************'; // пароль
$database = '************'; // имя базы данных

try {
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Ошибка подключения к базе данных");
}
?>