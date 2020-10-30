<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$db = "sprint2";

$conn = mysqli_connect($servername, $username, $password, $db); // Create connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<h4>Connected successfully </h4><br>";

?>