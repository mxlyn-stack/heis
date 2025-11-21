<?php
   if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
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
    // Handle form submission for adding a new team member
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $role     = trim($_POST['role']);
    $insert_sql = "INSERT INTO team_members (name, role, created_at, status) 
                   VALUES ('$name', '$role', NOW(), 'active')";
    if (mysqli_query($conn, $insert_sql)) {
        $message = "Team member added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
} 
// stop resubmission on refresh
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
// Fetch team members
$team_sql = "SELECT * FROM team_members  WHERE status = 'active' ORDER BY id DESC";
$team_result = mysqli_query($conn, $team_sql);
if (!$team_result) {
    die("Query failed: " . mysqli_error($conn));
}
$team_members = [];
while ($row = mysqli_fetch_assoc($team_result)) {
    $team_members[] = $row;
}
// Create team member cards
$teamCards = "";
foreach ($team_members as $member) {
    $teamCards .= "
    <div class='col-md-4'>
      <div class='card shadow-lg'>
        <div class='card-body'>
          <h4 class='text-success'><i class='bi bi-person-fill'></i> {$member['name']}</h4>
          <p class='text-white'>Role: {$member['role']}</p>
          <p class='text-white'>Joined: {$member['created_at']}</p>
        </div>
        <button class='btn btn-sm btn-outline-danger m-2' onclick='removeButton({$member['id']})'>
          <i class='bi bi-trash'></i> Remove  
        </button>
      </div>
    </div>";
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team</title>
  
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
    <main class="content p-4" id="main-content">
    <div class="container d-flex justify-content-between align-items-center mb-1">
  <div class="text-start">
    <h3>Team members</h3>
    <p class="pg">Manage your team member here.</p>
  </div>
  <button class="btn btn-success" id="addClientForm" data-bs-toggle="modal" data-bs-target="#addTeamModal">
    <i class="bi bi-plus-lg"></i> Add Team Member
  </button>
</div>
    <div>
      <?php
    if (isset($message)) {
        echo "<div class='alert alert-info'>{$message}</div>";
    }
    ?> 
    </div>
    <div class="container mt-4">
        <div class="row">
          <?php echo $teamCards; ?>
        </div>
  </main>
  <!-- add team modal-->
   <div class="modal fade" id="addTeamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="taskForm" method="post" action="">
                <div class="mb-3">
                  <label for="teamName" class="form-label text-light">Name</label>
                  <input type="text" class="form-control" id="teamName" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="roleName" class="form-label text-white">Role</label>
                  <select class="form-select" id="roleName" name="role" required>
                    <option value="" disabled selected>-- Select Role --</option>
                    <?php
                    // Predefined roles
                    $role = "";
                    $roles = ["Project Manager", "Developer", "Designer", "QA Engineer", "Other"];
                    foreach ($roles as $role) {
                        echo "<option value='$role'>$role</option>";
                    } ?>       
                 </select>
                </div>

                <button type="submit" class="btn btn-success">Add Team Member</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Sidebar toggle
    document.getElementById("toggle-btn").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("collapsed");
    });
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('show');
      document.getElementById('overlay').classList.toggle('active');
    }
// Soft delete team member
    function removeButton(id) {
    if (confirm("Are you sure you want to set this member inactive?")) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_member.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            alert(this.responseText);
            location.reload(); // refresh page after soft delete
        };
        xhr.send("id=" + id);
    }
}


    </script>
  </body>
</html>