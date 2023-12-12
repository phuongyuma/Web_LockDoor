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
    $password_key = test_input($_POST["Passwordkey"]);
    $ID_card = test_input($_POST["Idcard"]);
    if($api_key == $api_key_value) {
        if(isset($_POST["Idcard"]) && isset($_POST["Passwordkey"]))
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //check password if password_key or ID_card is correct with one of them in database
        $sql = "SELECT * FROM users WHERE password_key = '$ID_card'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sql = "INSERT INTO door_logs (activity_type, id_card)
                VALUES ('Open', '".$ID_card."')";
                if ($conn->query($sql) ) {
                    echo "1";
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "0";
            $sql = "INSERT INTO door_logs (activity_type, id_card)
            VALUES ('wrong', '".$ID_card."')";
            if ($conn->query($sql) === TRUE) {
                // echo "\nNOT New record created successfully";
                // echo "\n................................";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
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