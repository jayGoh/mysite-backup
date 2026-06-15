<?php
$host = '127.0.0.1';
$user = 'root'; // change if needed
$pass = 'Johnson12$';     // change if needed
$db   = 'gohfamily';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
