<?php

$config = new \Doctrine\DBAL\Configuration();

$connectionParams = array(
  'dbname' => 'todolist',
  'user' => 'root',
  'password' => '123',
  'host' => 'localhost',
  'driver' => 'pdo_mysql',
  'charset' => 'utf8mb4',
);

try {
  $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
  $conn->connect();
} catch (Exception $e) {
  //echo $e->getMessage();
  // @todo logger l'erreur
  header('Location: error500.html', true, 302);
  exit();
}
