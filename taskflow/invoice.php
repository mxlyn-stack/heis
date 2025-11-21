<?php
   session_start();
   require_once "db.php";
   // Check if user is logged in
   if (!isset($_SESSION['user_id'])) {
       header("Location: loginT.php");
       exit;
   }
   // Fetch user data
   $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo "User not found.";
        exit; 
    }
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>invoice</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center px-3">
          <h4 class="nu ">Menu </h4>
          <button class="btn btn-sm toggle-btn btn-outline-success" id="toggle-btn" onclick="toggleSidebar()">
            <i class="bi bi-list text-light"></i>
          </button>
          <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
        </div>
        <nav class="navbar">
          <ul class="navbar-nav drop-down-menu">
           <li> <a href="dashboardT.php"> <i class="bi bi-house"></i> <span class="link-text">Dashboard</span></a></li>
            <li> <a href="projectpage.php"> <i class="bi bi-files"></i> <span class="link-text">Projects</span></a></li>
            <li> <a href="clientpage.php"> <i class="bi bi-people-fill"></i> <span class="link-text">Clients</span></a></li>
            <li> <a href="invoice.php"> <i class="bi bi-receipt"></i> <span class="link-text">Invoices</span></a></li>
            <li> <a href="Team.php"> <i class="bi bi-graph-up-arrow"></i> <span class="link-text">Team</span></a></li>
            <li ><a href="mytask.php"> <i class="bi bi-journal-text"></i> <span class="link-text">My Task</span></a></li>
            <li> <a href="analytics.php"> <i class="bi bi-bar-chart"></i> <span class="link-text">Analytics</span></a></li>
            <li> <a href="#"> <i class="bi bi-gear-wide"></i> <span class="link-text">Settings</span></a></li>
            <li> <a href="#"> <i class="bi bi-box-arrow-left"></i> <span class="link-text">Logout</span></a></li>
          </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Sidebar toggle
    document.getElementById("toggle-btn").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("collapsed");
    });
    // Modal functionality
    var authModal = document.getElementById("invoiceModal");
    var openModalBtn = document.getElementById("openModalBtn"); 
    var closeModalBtn = document.querySelector(".btn-close");
    openModalBtn.onclick = function() {
      authModal.classList.remove("");
    }
    closeModalBtn.onclick = function() {
      authModal.classList.add("");
    }
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('show');
      document.getElementById('overlay').classList.toggle('active');
    }
    </script>
  </body>
</html>