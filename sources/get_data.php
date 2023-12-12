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
    $password_key = test_input($_POST["password_key"]);
    $ID_card = test_input($_POST["ID_card"]);
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
        //check password if password_key or ID_card is correct with one of them in database
        $sql = "SELECT * FROM users WHERE password_key = '".$password_key."' OR Id_card = '".$ID_card."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // check password or id_card if correct
            //echo "Password is correct";
            while($row = $result->fetch_assoc()) {
                echo "True";
            }
        } else {
            echo "Incorrect";
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