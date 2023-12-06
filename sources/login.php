<?php 
session_start();
#Kiểm tra nếu đã đăng nhập thì chuyển vào trang index.php
if(isset($user_ses)){
    header('location:index.php');
};
include "include/check.php";
include "include/connect.php";
?>
<?php include 'include/header.php'; ?>
	<body>
    <?php
        // When form submitted, check and create user session.
        if (isset($_POST['submit'])  ) {
                $username = stripslashes($_REQUEST['username']);    
                $username = mysqli_real_escape_string($conn, $username);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($conn, $password);
                // Check user is exist in the database
                $query    = "SELECT * FROM `users` WHERE username='$username'
                            AND password='" . md5($password) . "'";
                $result = mysqli_query($conn, $query) or die(mysql_error());
                $result2 = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username' AND role = 'admin'
                AND password='" . md5($password) . "'") or die(mysql_error());
                
                // nếu tất cả tham số đều đã được check và không có lỗi xảy ra
                // nếu role là admin thì tới trang admin (quản lý user và product)
                if (mysqli_num_rows($result2) == 1) {
                    $row = mysqli_fetch_assoc($result2);
                    $_SESSION['sadmin'] = $row['id_user'];
                    #header("Location: admin.php");
                    echo "<script>window.location.href='admin.php'</script>";
                } else if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['user_ses'] = $row['id_user'];   
                    //với tính năng remember me, nếu ta không logout, thì ta sẽ không phải đăng nhập lại khi trong 1 tháng
                    if (isset($_POST['remember'])) {
                        // $params = session_get_cookie_params();
                        // setcookie(session_name(), $_COOKIE[session_name()], time() + 60*60*24*30, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                        setcookie('user_ses', $row['username'], time() + 60*60*24*30);
                    }             
                    #header("Location: index.php");
                    echo "<script>window.location.href='index.php'</script>";
                } else {
                    echo "<div class='form'>
                        <h3>Incorrect Username/password.</h3><br/>
                        <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                        </div>";
                }
            }
        
    ?>
        <!-- <div class="container">
                <form class="form" method="post" name="login">
                    <h1 class="login-title">Login</h1>
                    <hr>
                    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
                    <input type="password" class="login-input" name="password" placeholder="Password"/>
                 
                    <input type="submit" value="Login" name="submit" class="login-button"/>
                    <input type="checkbox" name="remember" id="remember">Remember me</label>
                    <hr>
                    <p class="link"><a href="register.php">New Registration</a></p>

                </form>
        
        </div> -->
        <section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Login</h3>

            <form class="px-md-2" method="POST" action="" enctype="multipart/form-data" name="login">

              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">User Name</label>
                <input type="text" class="form-control" name="username" placeholder="Username" autofocus="true" required/>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required/>           
              </div>
              <input type="checkbox" name="remember" id="remember">Remember me</label>
              <br>
              <br>
            

              <button type="submit" class="btn btn-success btn-lg mb-1 from-control" value="Login" name="submit">Login</button>
              <p class="link"><a href="register.php">New Registration</a></p>  

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>