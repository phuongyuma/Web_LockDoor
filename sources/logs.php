<?php
	session_start();
	include "include/connect.php";
	//check admin:admin123
    $admin_ses = $_SESSION['sadmin'];
	if(!isset($admin_ses)){
		header('location:login.php');
	 };
    
?>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
<?php include 'include/header.php'; ?>
	<body>
	<?php include 'include/navbar_admin.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center">Door Activity Log</h1>
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
                        echo "<tr>";
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
</body>
</html>
