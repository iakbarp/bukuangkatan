<?php
$host = "localhost"; // server
$user = "root"; // username
$pass = ""; // password
$database = "angkatan"; // nama database

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>