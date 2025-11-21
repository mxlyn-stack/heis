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
    // Handle form submission for adding a new task
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskName   = mysqli_real_escape_string($conn, trim($_POST['taskName']));
    $dueDate    = mysqli_real_escape_string($conn, trim($_POST['dueDate']));
    $assignedto = mysqli_real_escape_string($conn, trim($_POST['assignedto']));

    if (!empty($taskName)) {
        $insert_sql = "INSERT INTO tasks (title, due_date, assigned_to, user_id, created_at) 
               VALUES ('$taskName', '$dueDate', '$assignedto', '$user_id', NOW())"; 
        if (mysqli_query($conn, $insert_sql)) {
            $message = "Task added successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Task name cannot be empty.";
    }
}

// Fetch tasks for the user
$task_sql = "SELECT * FROM tasks WHERE user_id = '$user_id' ORDER BY id DESC";
$task_result = mysqli_query($conn, $task_sql);
if (!$task_result) {
    die("Query failed: " . mysqli_error($conn));
}
$tasks = [];
while ($row = mysqli_fetch_assoc($task_result)) {
    $tasks[] = $row;
}
// Create task list items
$taskItems = "";
foreach ($tasks as $task) {
    $taskItems .= '
<li class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white border-secondary mb-2">
  <div>
    <i class="bi bi-check-circle text-white me-2"></i> ' . htmlspecialchars($task['title']) . '<br>
    <small class="text-white">Assigned to: ' . htmlspecialchars($task['assigned_to']) . '</small>
  </div>
  <span class="text-white">' . htmlspecialchars($task['created_at']) . '</span>
</li>';

}

   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Task</title>
  
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
      <h3 >My Task</h3>
     </div>
     <button class="btn btn-success" id="addClientForm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
       <i class="bi bi-plus-lg"></i> New Task
      </button>
      </div>
      <!-- Add Task Modal -->
      <div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="taskForm" method="post">
                <div class="mb-3">
                  <label for="taskName" class="form-label text-black">Task Name</label>
                  <input type="text" class="form-control" id="taskName" name="taskName" required>
                </div>
                 <div class="mb-3">
                  <label for="dueDate" class="form-label text-black">Due Date</label>
                  <input type="date" class="form-control" id="dueDate" name="dueDate">
                </div>
          
                  <div class ="">
                  <label for="description" class="form-label text-black">Assigned to</label>
                  <option>--Select--</option>
                  <select class="form-select" id="assignedto" name="assignedto" required>
                    <?php
                    // Fetch team members for the dropdown
                    $team_sql = "SELECT * FROM team_members WHERE status = 'active' ORDER BY name ASC";
                    $team_result = mysqli_query($conn, $team_sql);
                    while ($member = mysqli_fetch_assoc($team_result)) {
                        echo '<option value="' . htmlspecialchars($member['name']) . '">' . htmlspecialchars($member['name']) . '</option>';
                    }
                    ?>
                  </select>
              </div>
                <button type="submit" class="btn btn-success">Add Task</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div>
      <?php 
    if (isset($message)) {
        echo "<div class='alert alert-info'>{$message}</div>";
    }
    ?>
      </div>
      <!-- Task List -->
      <div class="container mt-4">
        <ul class="list-group">
          <?= $taskItems ?>
        </ul>
      </div>
      </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Sidebar toggle
    document.getElementById("toggle-btn").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("collapsed");
    });
    // Modal functionality
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('show');
      document.getElementById('overlay').classList.toggle('active');
    }
    </script>
  </body>
</html>