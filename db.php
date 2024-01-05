<?php

$conn = new mysqli("localhost", "root", "", "logIn");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
