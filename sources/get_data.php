<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruit_shop";

/*$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);*/
$api_key_value = "tPmAT5Ab3j7F9";
$api_key= $card = $activity_type = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        if(isset($_POST["Idcard"]) && isset($_POST["Signal"]))
        $card = test_input($_POST["Idcard"]);
        $activity_type = test_input($_POST["Signal"]);
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO door_logs (activity_type, id_card)
        VALUES ('".$activity_type."', '".$card."')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "\n................................";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}