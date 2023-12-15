<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruit_shop";
//$GLOBALS['n'] = 1;
#static $n = 1;
$filename = "counter.txt";

// Kiểm tra xem tập tin có tồn tại không
if (file_exists($filename)) {
    $n = (int)file_get_contents($filename); // Đọc và chuyển đổi sang số nguyên
} else {
    $n = 1; // Nếu tập tin không tồn tại, bắt đầu từ 1
}

/*$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);*/
$api_key_value = "tPmAT5Ab3j7F9";
$api_key= $card = $activity_type = "";

// if quẹt thẻ và nhận gói tin và thẻ lạ hoặc password lạ



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
        $get_totalAlerts = "SELECT totalAlerts FROM door_logs WHERE log_id = (SELECT MAX(log_id) FROM door_logs)";
            $result_totalAlerts = $conn->query($get_totalAlerts);
            if ($result_totalAlerts->num_rows > 0) {
                $row = $result_totalAlerts->fetch_assoc();
                $totalAlerts = $row['totalAlerts'];
            }
        //check password if password_key or ID_card is correct with one of them in database
        $sql = "SELECT * FROM users WHERE password_key = '$password_key' OR Id_card = '$ID_card'";
        // $sql2 = "SELECT * FROM users WHERE Id_card = '$password_key'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while( ($row = $result->fetch_assoc()) ) {
                $sql = "INSERT INTO door_logs (activity_type, id_card, password_key, totalAlerts)
                VALUES ('Open', '".$ID_card."','".$password_key."', '".$totalAlerts."')";
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
            if ($result_totalAlerts->num_rows > 0) {
                $row = $result_totalAlerts->fetch_assoc();
                $totalAlerts = $row['totalAlerts'];
                if ($n == 3){
                    echo "3";
                    //echo "n bang 3 ne";
                    $n=0;
                    $newTotalAlerts = $totalAlerts + 1;
                    $insertNewLog = "INSERT INTO door_logs (activity_type, id_card, password_key, totalAlerts) VALUES ('wrong', '".$ID_card."', '".$password_key."', '$newTotalAlerts')";
                    $insertResult = mysqli_query($conn, $insertNewLog);

                    if ($insertResult) {
                       // echo "New log inserted successfully!";
                    } else {
                        echo "Error inserting new log: " . mysqli_error($conn);
                    }
                    include('sentmail.php');
                }
                else {
                   // echo "n chua bang 3";
                   echo "2";
                    $n++;
                    // insert new logs with total alerts not change
                    $insertNewLog = "INSERT INTO door_logs (activity_type, id_card, password_key, totalAlerts) VALUES ('wrong', '".$ID_card."', '".$password_key."', '$totalAlerts')";
                    $insertResult = mysqli_query($conn, $insertNewLog);
                    
                    if ($insertResult) {
                       // echo "New log inserted successfully!";
                    } else {
                        echo "Error inserting new log: " . mysqli_error($conn);
                    }
                }

                
            }

           // echo $n;
        }
    }
    else {
        echo "Wrong API Key provided.";
    }
}
else {
    echo "No data posted with HTTP POST.";
}

file_put_contents($filename, $n);


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}