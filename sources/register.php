<?php 
    session_start();
    # biến mở kết nối tới MySQL server
    #$conn = mysqli_connect("localhost", "nbp1", "passMySQL", "fruit_shop");
    include "include/connect.php";

    function test_input($conn, $data) {
        $data = trim($data); //loại bỏ ký tự không cần thiết như khoảng trắng, tab, xuống dòng
        $data = stripslashes($data); //bỏ dấu gạch chéo "\" ra khỏi chuỗi
        $data = htmlspecialchars($data); //chuyển các ký tự đặc biệt thành các ký tự HTML entity  (vd: < thành &lt;)
        // https://www.w3schools.com/html/html_entities.asp
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }
  
?>

<?php include 'include/header.php'; ?>
<body>
    <div class="container">
        <?php
            // When form submitted, insert values into the database.
            if (isset($_POST['username'])) {

                $username = test_input($conn, $_POST['username']);
                $password = test_input($conn, $_POST['password']);
                $name = test_input($conn, $_POST['name']);
                $email = test_input($conn, $_POST['email']);
                $contact = test_input($conn, $_POST['contact']);

                //regex lấy từ mạng, chưa tìm hiểu kỹ
                if (!preg_match("/^\\+?[1-9][0-9]{7,14}$/", $contact)) {
                    echo "Phone number is invalid";
                    exit();
                }
                if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
                    echo "Email is invalid";
                    exit();
                }
                // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //     $emailErr = "Invalid email format";
                //   }


                $query    = "INSERT into `users` (username, password, name, email, phone_number, role)
                            VALUES ('$username', '" . md5($password) . "', '$name', '$email', '$contact', 'user')";
                $result   = mysqli_query($conn, $query);
                if ($result) {
                    // echo "<div class='form'>
                    //     <h3>You are registered successfully.</h3><br/>
                    //     <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    //     </div>";
                    echo "Tính năng này đang tạm ngừng";
                } else {
                    echo "<div class='form'>
                        <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                        </div>";
                }
            } else {
        ?>
    
    <?php
        }
    ?>
    
    </div>
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

            <form class="px-md-2" method="POST" action="" enctype="multipart/form-data">

              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">User Name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder = "User Name" required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder = "Name" required>              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder = "Email" required>
                
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder = "Password" required>
                
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Contact Info</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder = "Phone number" required>
                
              </div>

              <button type="submit" class="btn btn-success btn-lg mb-1" value="Register">Register</button>
              <!-- <input type="submit" name="submit" value="Register" class="login-button"> -->
              <p class="link"><a href="login.php">Click to Login</a></p>  

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
