<?php
session_start();
include "include/connect.php";

$admin_ses = $_SESSION['sadmin'];
if (!isset($admin_ses)) {
    header('location:login.php');
}
?>

<link rel="stylesheet" href="logs.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<?php include 'include/header.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php include 'include/navbarnew.php'; ?>
            </div>
            <div class="col-md-9">
                <h4 class="text-left mt-3 mb-4">Notification</h4>
                
                <!-- Hiển thị thông báo mới nhất -->
                <div class="list-group">
                    <?php
                    $query_logs = "SELECT * FROM door_logs WHERE activity_type='wrong' ORDER BY activity_time DESC LIMIT 20";
                    $result = mysqli_query($conn, $query_logs);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='list-group-item list-group-item-action flex-column align-items-start'>";
                            echo "<div class='d-flex w-100 justify-content-between'>";
                            echo "<h5 class='mb-1'>Log ID: {$row['log_id']}</h5>";
                            echo "</div>";
                            if ($row['id_card']!=0){
                                echo "<p class='mb-1'>Phát hiện thẻ lạ {$row['id_card']} được dùng để mở khóa, bạn có muốn dùng nó để tạo tài khoản mới không?</p>";
                                echo "<button onclick='addUserWithCard(\"{$row['id_card']}\")' class='btn btn-primary btn-sm'>Add user</button>";
                                echo "</div>";
                            }
                            else {
                                echo "<p class='mb-1'>Phát hiện mật khẩu lạ {$row['password_key']} được dùng để mở khóa, bạn có muốn dùng nó để tạo tài khoản mới không?</p>";
                                echo "<button onclick='addUserWithPass(\"{$row['password_key']}\")' class='btn btn-primary btn-sm'>Add user</button>";
                                echo "</div>";
                            }
                            
                        }
                    } else {
                        echo "<p class='list-group-item'>No activity logs found.</p>";
                    }
                    ?>
                </div>

                <script>
                function addUserWithCard(cardId) {
                    alert("Add user with card ID: " + cardId);
                    window.location.href = 'addUser_2.php?cardId='+cardId;
                }
                function addUserWithPass(pass) {
                    alert("Add user with card ID: " + pass);
                    window.location.href = 'addUser_2.php?passwordKey='+pass;
                }
                </script>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
