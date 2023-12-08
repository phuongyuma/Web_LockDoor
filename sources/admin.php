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
?>
</style>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Work', 11],
        ['Eat', 2],
        ['Commute', 2],
        ['Watch TV', 2],
        ['Sleep', 7]
      ]);

      var options = {
        title: 'Daily Activities',
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
        <li><a href="#" class="logo">
            <img src="./pic/key.png" style="width: 70;height: 70;">
            <span class="nav-item">LockDoor</span>
          </a></li>
        <li><a href="#">
            <i class="fas fa-menorah"></i>
            <span class="nav-item">Dashboard</span>
          </a></li>
        <li><a href="profile.php">
            <i class="fas fa-comment"></i>
            <span class="nav-item">Account</span>
          </a></li>
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
        <h4 >Welcome back to ManhHung</h4>
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
                <h2 style="color: red">50</h2>
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
                  Total arlets in today
                </h4>
              </tr>
              <h2 style="color: red">
                10
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
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Depart</th>
                <th>Date</th>
                <th>Join Time</th>
                <th>Logout Time</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>01</td>
                <td>Sam David</td>
                <td>Design</td>
                <td>03-24-22</td>
                <td>8:00AM</td>
                <td>3:00PM</td>
                <td><button>View</button></td>
              </tr>
              <tr class="active">
                <td>02</td>
                <td>Balbina Kherr</td>
                <td>Coding</td>
                <td>03-24-22</td>
                <td>9:00AM</td>
                <td>4:00PM</td>
                <td><button>View</button></td>
              </tr>
              <tr>
                <td>03</td>
                <td>Badan John</td>
                <td>testing</td>
                <td>03-24-22</td>
                <td>8:00AM</td>
                <td>3:00PM</td>
                <td><button>View</button></td>
              </tr>
              <tr>
                <td>04</td>
                <td>Sara David</td>
                <td>Design</td>
                <td>03-24-22</td>
                <td>8:00AM</td>
                <td>3:00PM</td>
                <td><button>View</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </section>
  </div>
</body>

</html>