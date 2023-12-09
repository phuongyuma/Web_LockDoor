<?php
session_start();
$admin_ses = $_SESSION['sadmin'];
if (!isset($admin_ses)) {
    header('location:login.php');
};
include "include/connect.php";
# câu lệnh truy vấn tất cả các dữ liệu trong bảng tbl_product theo giá trị id tăng dần 
$query = "SELECT * FROM fruits_table ORDER BY id ASC";
$query2 = "SELECT * FROM users ORDER BY id_user ASC";
$result2 = mysqli_query($conn, $query2);
if (isset($_GET['remove_user'])) {
    $remove_id = $_GET['remove_user'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id_user = '$remove_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `users` WHERE id_user = '$remove_id'") or die('query failed');
    header('location:manage_account.php');
}
?>

<head>
    <?php include 'include/header.php'; ?>
</head>

<body>
    <div class="container">
        <div class="left">
            <?php include 'include/navbarnew.php'; ?>
            <link rel="stylesheet" href="css/minireset.css">
        </div>
        <div class="right">
            <h4 class="text-left" style="margin-left: 10; margin-top: 30" >Manager Account</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Password</th>
                        <th>Wallet</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_logs = "SELECT * FROM users ORDER BY id_user ASC";
                    $result2 = mysqli_query($conn, $query_logs);

                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_user"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["Id_card"] . "</td>";
                            echo "<td>" . $row["password_key"] . "</td>";
                            echo "<td><a href='manage_account.php?remove_user=" . $row["id_user"] . "?> class='delete-btn' onclick='return confirm('remove user?');'>Remove</a></td>";
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