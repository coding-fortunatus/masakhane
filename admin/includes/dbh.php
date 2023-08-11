<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "masakhane";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Error encountered: ".mysqli_connect_error($conn));
}