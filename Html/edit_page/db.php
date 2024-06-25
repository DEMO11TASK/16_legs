<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "16legs_cart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>