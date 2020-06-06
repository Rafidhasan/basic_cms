<?php
  $host = 'localhost';
  $user = 'root';
  $password = 'root';
  $dbname = 'cms';

  // Set DSN
  $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

  // Create a Pdo instance
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
?>