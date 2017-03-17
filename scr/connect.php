<?php

//------------------------------------------------------------------------------
// Connection
//------------------------------------------------------------------------------
// Credentials
$dsn = 'mysql:dbname=social_app;host=127.0.0.1;charset=utf8';
$user = 'root';
$pass = '';
// Connect to MySql
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
