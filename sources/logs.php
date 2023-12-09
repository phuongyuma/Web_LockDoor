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
                        <th>User ID</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_logs = "SELECT * FROM door_activity_log ORDER BY activity_time DESC LIMIT 20";
                    $result = mysqli_query($conn, $query_logs);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<td>" . $row["log_id"] . "</td>";
                            echo "<td>" . $row["activity_type"] . "</td>";
                            echo "<td>" . $row["activity_time"] . "</td>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No activity logs found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>