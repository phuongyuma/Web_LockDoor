<?php
session_start();
# biến mở kết nối tới MySQL server
#$conn = mysqli_connect("localhost", "nbp1", "passMySQL", "fruit_shop");
include "include/connect.php";

function test_input($conn, $data)
{
  //$data = trim($data); //loại bỏ ký tự không cần thiết như khoảng trắng, tab, xuống dòng
  $data = stripslashes($data); //bỏ dấu gạch chéo "\" ra khỏi chuỗi
  $data = htmlspecialchars($data); //chuyển các ký tự đặc biệt thành các ký tự HTML entity  (vd: < thành &lt;)
  // https://www.w3schools.com/html/html_entities.asp
  $data = mysqli_real_escape_string($conn, $data);
  return $data;
}
?>

<?php include 'include/header.php'; ?>

<body>
  <?php
  // When form submitted, insert values into the database.
  if (isset($_POST['username'])) {

    $username = test_input($conn, $_POST['username']);
    $password = test_input($conn, $_POST['password']);
    $name = test_input($conn, $_POST['name']);
    $email = test_input($conn, $_POST['email']);
    $contact = test_input($conn, $_POST['contact']);
    $id_card = test_input($conn, $_POST['Id_card']);
    $password_key = test_input($conn, $_POST['key_password']);

    // //regex lấy từ mạng, chưa tìm hiểu kỹ
    // if (!preg_match("/^\\+?[1-9][0-9]{7,14}$/", $contact)) {
    //   echo "Phone number is invalid";
    //   exit();
    // }
    // if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
    //   echo "Email is invalid";
    //   exit();
    // }
    // $id_card to var char
    

    $query = "INSERT into `users` (username, password, name, email, phone_number, role, Id_card, password_key)
              VALUES ('$username', '" . md5($password) . "', '$name', '$email', '$contact', 'user', '$id_card', $password_key)";
    $result = mysqli_query($conn, $query);

    if ($result) {
      // echo "<div class='form'>
      //     <h3>You are registered successfully.</h3><br/>
      //     <p class='link'>Click here to <a href='login.php'>Login</a></p>
      //     </div>";
      // echo "Tính năng này đang tạm ngừng";
      echo "<div class='form'>
          <h3>You are add user successfully.</h3><br/>
          <p class='link'>Click here to come back <a href='manage_account.php'>page Manage User</a></p>
          </div>";
    } else {
      //show the error of result
      echo "Error: " . $query . "<br>" . $conn->error;
      echo "<div class='form'>
                        <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                        </div>";
    }
  } else {
  }
  ?>
 <section class="h-150vh h-custom" style="background-color: #8fc4b7;">
  <div class="container  py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-lg-3 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp" class="w-100"
            style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-2 p-md-3">
            <h3 class="pb-2 pb-md-0 pt-2 mb-md-1 px-md-2" style="height: 20px; display: flex; justify-content: center;">Add User</h3>
            <form class="px-md-2" method="POST" action="" enctype="multipart/form-data">
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">User Name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="User Name"
                  required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                  required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                  required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Contact Info</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder = "Phone number" required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">ID Card</label>
                <input type="text" class="form-control" id="Id_card" name="Id_card" placeholder = "ID Card" required>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Key Password</label>
                <input type="text" class="form-control" id="key_password" name="key_password" placeholder = "Key Password">
              </div>
              <div style = "display: flex; justify-content: center;">
              <button type="submit" class="btn btn-success mb-1" style="font-size: 20px;" value="Register">Add User</button>
              </div>
              <div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>