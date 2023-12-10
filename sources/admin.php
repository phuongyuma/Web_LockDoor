<?php
session_start();
include "include/connect.php";
//check admin:admin123
$admin_ses = $_SESSION['sadmin'];
if (!isset($admin_ses)) {
  header('location:login.php');
}

;
$status = 1;

# count total alerts in 1 week
$query_logs = "SELECT * FROM door_logs ORDER BY activity_time DESC LIMIT 20";
$query_logs_2 = "SELECT COUNT(*) AS total_alerts FROM door_logs WHERE activity_type = 'Alerts' AND activity_time >= NOW() - INTERVAL 1 WEEK";
$result = mysqli_query($conn, $query_logs_2);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_alerts = $row["total_alerts"]; 
  }
} else {
  $total_alerts = 0;
}
# count total alerts in 1 days
$query_logs_3 = "SELECT COUNT(*) AS total_alerts FROM door_logs WHERE activity_type = 'Alerts' AND activity_time >= NOW() - INTERVAL 1 DAY";
$result = mysqli_query($conn, $query_logs_3);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_alerts_2 = $row["total_alerts"]; 
  }
} else {
  $total_alerts_2 = 0;
}
# count total open in 1 week
$query_logs_4 = "SELECT COUNT(*) AS total_alerts FROM door_logs WHERE activity_type = 'Open' AND activity_time >= NOW() - INTERVAL 1 WEEK";
$result = mysqli_query($conn, $query_logs_4);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_open = $row["total_alerts"]; 
  }
} else {
  $total_open = 0;
}
# count total close in 1 week
$query_logs_5 = "SELECT COUNT(*) AS total_alerts FROM door_logs WHERE activity_type = 'Close' AND activity_time >= NOW() - INTERVAL 1 WEEK";
$result = mysqli_query($conn, $query_logs_5);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_close = $row["total_alerts"]; 
  }
} else {
  $total_close = 0;
}
# total user 
$query_logs_6 = "SELECT COUNT(*) AS total_users FROM users";
$result = mysqli_query($conn, $query_logs_6);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_user = $row["total_users"]; 
  }
} else {
  $total_user = 0;
}



?>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Alert per Week'],
        ['Alert', <?php echo $total_alerts; ?>],
        ['Close', <?php echo $total_close; ?>],
        ['Open', <?php echo $total_open; ?>]
        ]);

      var options = {
        title: 'Alert per Week',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>
  
</head>

<body>
  <link rel="stylesheet" href="css/admin.css" />
  <div class="container">
    <nav>
      <ul>
        <li><a href="admin.php" class="logo">
            <img src="./pic/key.png" style="width: 70;height: 70;">
            <span class="nav-item">LockDoor</span>
          </a></li>
        <li><a href="admin.php">
            <i class="fas fa-menorah"></i>
            <span class="nav-item">Dashboard</span>
          </a></li>
        <!-- <li><a href="profile.php">
            <i class="fas fa-comment"></i>
            <span class="nav-item">Account</span>
          </a></li> -->
        <li><a href="logs.php">
            <i class="fas fa-database"></i>
            <span class="nav-item">log</span>
          </a></li>
        <li><a href="manage_account.php">
            <i class="fas fa-chart-bar"></i>
            <span class="nav-item">User</span>
          </a></li>
        <li><a href="#">
            <i class="fas fa-cog"></i>
            <span class="nav-item">Setting</span>
          </a></li>
        <li><a href="logout.php" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Log out</span>
          </a></li>
      </ul>
    </nav>
    <section class="main">
      <div class="main-top">
        <h1 >Dashboard</h1>
        <h4 >Welcome back to admin</h4>
        <i class="fas fa-user-cog"></i>
      </div>
      <div class="users">
        <div class="card" style="display: flex;justify-content: center; align-items: center;">
          <div class="per">
            <table>
              <img src="./pic/user1.png" alt="">
              <tr>
                <h4>Total user</h4>
              </tr>
              <tr>
                <h2 style="color: red"><?php echo $total_user; ?> </h2>
              </tr>
            </table>
          </div>
        </div>
        <div class="card" style="display: flex;justify-content: center; align-items: center;">
          <div class="per">
            <table>
              <tr>
                <img src="./pic/alert.png" alt="">
                <h4>
                  Total alerts in today
                </h4>
              </tr>
              <h2 style="color: red">
                <?php echo $total_alerts_2; ?>
              </h2>
              <tr>
              </tr>
            </table>
          </div>
        </div>
        <div class="card" style="display: flex;justify-content: center; align-items: center;">
          <div class="per">
            <table>
              <?php
              $img_id = $status == "active" ? 1 : 2;
              ?>
              <tr>
                <img src="./pic/<?php echo $img_id; ?>.png" alt="">
              </tr>
              <tr style="top: 20;">
                <h4>
                Device operation
                </h4>
              </tr>
              <tr>
                <h2 style="color: red">status</h2>
              </tr>
            </table>
          </div>
        </div>
        <div class="card">
          <div class="per">
            <table>
              <div id="piechart_3d" style="width: 100%; height: 100%; display: flex; justify-content: center;"></div>
            </table>
          </div>
        </div>
      </div>
      
      <section class="attendance">
        <div class="attendance-list">
          <h1>Attendance List</h1>
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
                          

                    <?php
                    $today = date("Y-m-d");
                    $query_logs = "SELECT * FROM door_logs WHERE DATE(activity_time) = '$today'";
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

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
      </section>
    </section>
  </div>
</body>

</html>