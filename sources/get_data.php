<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "fruit_shop";

$conn = mysqli_connect($hostname, $username, $password, $database);
if(!$conn) {
    die("connection faild: ". mysqli_connect_error());
}

echo "Database connection is ok";
$t = 20;
$h = 50;

$sql = "INSERT INTO Userrrr (temperature,humidity)  VALUES (".$t.",".$h." )";
if(mysqli_query($conn, $sql)) {
    echo "\n New data created  sucssecfully";
} else {
    echo "Error: " . $sql . "br" . mysqli_error($conn);
}
?>