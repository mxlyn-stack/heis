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
    // Handle form submission for adding a new project
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projectname = trim($_POST['projectname']);
    $client_id   = intval($_POST['client_id']); // from dropdown
    $deadline    = trim($_POST['deadline']);

    $insert_sql = "INSERT INTO projects (projectname, client_id, deadline) 
                   VALUES ('$projectname', '$client_id', '$deadline')";
    if (mysqli_query($conn, $insert_sql)) {
        echo "Project added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
/*$activity = "New project '{$projectname}' created for client '{$clientname}'";
        mysqli_query($conn, "INSERT INTO activities (user_id, activity, created_at) 
                             VALUES ('$user_id', '$activity', NOW())");
*/
    $projects_sql = "SELECT p.*, c.clientname 
                 FROM projects p 
                 LEFT JOIN clients c ON p.client_id = c.id 
                 ORDER BY p.id DESC";

$projects_result = mysqli_query($conn, $projects_sql);

if (!$projects_result) {
    die("Query failed: " . mysqli_error($conn));
}

$projects = [];
while ($row = mysqli_fetch_assoc($projects_result)) {
    $projects[] = $row;
}
    // Create project cards 
    $projectCards = "";
    foreach ($projects as $project) {
        $projectCards .= "
        <div class='col-md-4'>
          <div class='card shadow-lg'>
            <div class='card-body'>
              <h4 class='text-success'><i class='bi bi-folder-fill'></i> {$project['projectname']}</h4> 
              <p style='font-size: 12px;'> Project created: " . date('M d, Y', strtotime($project['created_at'])) . "</p>
              <p class='cli' style='font-size: 12px;'> For Client: {$project['clientname']} </p>
              <p class='cli' style='font-size: 12px;'> Dead Line: {$project['deadline']} </p>
              <!-- Message area -->
              <div id='messageBox' class='mt-3'></div>
           <button class='btn btn-sm btn-outline-success' onclick=onclick='editProject({$project['id']})'>
    <i class='bi bi-pencil-square'></i>
</button>
<button class='btn btn-sm btn-outline-danger' onclick='deleteProject({$project['id']})'>
    <i class='bi bi-trash'></i>
</button>

            </div>
          </div>
        </div>
        ";
    }
      
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project</title>
  
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
      <h3 >Project List</h3>
     </div>
     <button class="btn btn-success" id="addClientForm" data-bs-toggle="modal" data-bs-target="#addprojectModal">
       <i class="bi bi-plus-lg"></i> New Project
      </button>
     </div>
  <!-- project card-->
   <div class="container mt-4">
    <div class="row">
      <?= $projectCards ?>
    </div>
  </div>
  </main>
   <!-- Add project Modal -->
   <div class="modal fade" id="addprojectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog text-black">
      <div class="modal-content">
        <form id="projectForm" method="post">
  <div class="modal-header">
    <h5 class="modal-title"> Add project</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <div class="mb-3">
      <label for="cname" class="form-label">project Name</label>
      <input type="text" class="form-control" id="prname" name="projectname" required>
    </div>
    <div class="mb-3">
            <label for="forcli" class="form-label">For (Client)</label>
            <select class="form-select" id="forcli" name="client_id" required>
              <option value="" disabled selected>-- Select Client --</option>
              <?php
                $client_sql = "SELECT id, clientname FROM clients ORDER BY clientname ASC";
                $client_result = mysqli_query($conn, $client_sql);

                if ($client_result && mysqli_num_rows($client_result) > 0) {
                    while ($client = mysqli_fetch_assoc($client_result)) {
                        echo "<option value='" . $client['id'] . "' data-name='" . htmlspecialchars($client['clientname']) . "'>" 
                             . htmlspecialchars($client['clientname']) . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No clients available</option>";
                }
              ?>
            </select>
          </div><div class="mb-3">
      <label for="proname" class="form-label">Dead Line</label>
      <input type="date" class="form-control" id="dline" name="deadline" required>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-success">Add Project</button>
  </div>
</form>
</div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Sidebar toggle
    document.getElementById("toggle-btn").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("collapsed");
    });
    // Auto-fill project name when client is selected
document.getElementById("forcli").addEventListener("change", function() {
    let selectedOption = this.options[this.selectedIndex];
    let clientName = selectedOption.getAttribute("data-name");

    // Example: Project name = Client Name + " Project"
    document.getElementById("prname").value = clientName + " Project";
});
   // Edit and delete projects
   function editProject(id) {
    alert("Edit project with ID: " + id);
    // TODO: open modal & load project details
}

    </script>
  </body>
</html>