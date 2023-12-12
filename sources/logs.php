<?php
session_start();
include "include/connect.php";
//check admin:admin123
$admin_ses = $_SESSION['sadmin'];
if (!isset($admin_ses)) {
    header('location:login.php');
}
;


?>
<link rel="stylesheet" href="logs.css">
<?php include 'include/header.php'; ?>

<body>
    <div class="container">
        <div class="left">
            <?php include 'include/navbarnew.php'; ?>
            <link rel="stylesheet" href="css/minireset.css">
        </div>
        <div class="right">
            <h4 class="text-left" style="margin-left: 10; margin-top: 30">Door Activity Log</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Activity Type</th>
                        <th>Activity Time</th>
                        <!-- <th>User ID</th>
                        <th>Username</th> -->
                        <th>Card id</th>
                    </tr>
                </thead>
                <tbody>
                <form method="POST" action="">
                    <label for="date">Select Date:</label> <br>
                    <input type="date" id="date" name="date">
                    <input type="submit" value="View Logs" name="pick-date" >
                </form>

                <br>
                    <?php
                    if (isset($_POST["pick-date"])) {
                        $date = $_POST["date"];
                        $query_logs = "SELECT * FROM door_logs WHERE DATE(activity_time) = '$date'";
                        $result = mysqli_query($conn, $query_logs);
                        if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<td>" . $row["log_id"] . "</td>";
                            echo "<td>" . $row["activity_type"] . "</td>";
                            echo "<td>" . $row["activity_time"] . "</td>";
                            echo "<td>" . $row["id_card"] . "</td>";
                            echo "</tr>";
                        }
                        } else {
                        echo "<tr><td colspan='5'>No activity logs found.</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <script>
            document.getElementById("date-form").addEventListener("pick-date", function(event) {
            event.preventDefault();
            var date = document.getElementById("date").value;
            var logTable = document.getElementById("log-table");
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    logTable.innerHTML = xhr.responseText;
                }
            };
            xhr.send("date=" + date);
        });
    </script>
        </div>
    </div>
</body>

</html>