<?php
//set thoi gian session het han trong vong 1 tieng
session_set_cookie_params(3600);
session_start();
$user_ses = $_SESSION['user_ses'];
if(!isset($_SESSION['user_ses'])){
	header('location:login.php');
};
include "include/connect.php";

$users_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id_user = '$user_ses'");
//check vip
$fetch_users = mysqli_fetch_assoc($users_query);


?>
<?php include 'include/header.php'; ?>
	<body>
	<?php include 'include/navbar.php'; ?>
	</body>
</html>

