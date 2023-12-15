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
        $sql = "SELECT * FROM users WHERE password_key = '$password_key' OR Id_card = '$ID_card'";
        // $sql2 = "SELECT * FROM users WHERE Id_card = '$password_key'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while( ($row = $result->fetch_assoc()) ) {
                $sql = "INSERT INTO door_logs (activity_type, id_card, password_key)
                VALUES ('Open', '".$ID_card."','".$password_key."')";
                if ($conn->query($sql) ) {
                    echo "1";
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            // get totalAlert from database
            $get_totalAlerts = "SELECT totalAlerts FROM door_logs WHERE log_id = (SELECT MAX(log_id) FROM door_logs)";
            $result_totalAlerts = $conn->query($get_totalAlerts);
            $sql = "INSERT INTO door_logs (activity_type, id_card, password_key)
                VALUES ('wrong', '".$ID_card."','".$password_key."')";
                if ($conn->query($sql) ) {
                    echo "0";
                }
            if (!isset($n)) {
                $n=0;
            }
            if($n == 3){
                $totalAlerts++;
                $sql = "INSERT INTO door_logs (activity_type, id_card, password_key, totalAlerts)
                VALUES ('wrong', '".$ID_card."','".$password_key."', '".$totalAlerts."')";
                if ($conn->query($sql) ) {};
                    $n = 0;
            }
            else {
                $sql = "INSERT INTO door_logs (activity_type, id_card, password_key)
                VALUES ('wrong', '".$ID_card."','".$password_key."')";
                if ($conn->query($sql) ) {};
                $n ++;
            }
            echo "<script>window.location.href='sentmail.php'</script>";
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