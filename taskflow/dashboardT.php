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
     if (isset($_POST['update_status'])) {
    $project_id = (int) $_POST['project_id'];
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);

    $update_sql = "UPDATE projects SET status='$new_status' WHERE id='$project_id'";
    if (mysqli_query($conn, $update_sql)) {
        // Log activity
        $activity = "Project ID {$project_id} status updated to '{$new_status}'";
        mysqli_query($conn, "INSERT INTO activities (user_id, activity, created_at) 
                             VALUES ('$user_id', '$activity', NOW())");
    }
}

     // Fetch recent projects (limit to 5 latest)
      $projects_sql = "SELECT p.*, c.clientname 
                        FROM projects p 
                        LEFT JOIN clients c ON p.client_id = c.id 
                        ORDER BY p.created_at DESC 
                        LIMIT 5";
      $projects_result = mysqli_query($conn, $projects_sql);
      $recent_projects = mysqli_fetch_all($projects_result, MYSQLI_ASSOC);
      // Fetch recent tasks (limit to 5 latest)
      $tasks_sql = "SELECT * FROM tasks ORDER BY created_at DESC LIMIT 5";
      $tasks_result = mysqli_query($conn, $tasks_sql);
      $recent_tasks = mysqli_fetch_all($tasks_result, MYSQLI_ASSOC);
      // Fetch recent activities (limit to 5 latest)
      $activities_sql = "SELECT * FROM activities ORDER BY created_at DESC LIMIT 5";
      $activities_result = mysqli_query($conn, $activities_sql);
      $recent_activities = mysqli_fetch_all($activities_result, MYSQLI_ASSOC);
      // Count total projects
      $total_projects_sql = "SELECT COUNT(*) AS total FROM projects";
      $total_projects_result = mysqli_query($conn, $total_projects_sql);
      $total_projects = mysqli_fetch_assoc($total_projects_result)['total'];
      // Count total tasks
      $total_tasks_sql = "SELECT COUNT(*) AS total FROM tasks";
      $total_tasks_result = mysqli_query($conn, $total_tasks_sql);
      $total_tasks = mysqli_fetch_assoc($total_tasks_result)['total'];
      // Count completed tasks
      $completed_tasks_sql = "SELECT COUNT(*) AS total FROM tasks WHERE status = 'completed'";
      $completed_tasks_result = mysqli_query($conn, $completed_tasks_sql);
      $completed_tasks = mysqli_fetch_assoc($completed_tasks_result)['total'];
      // Count team members
      $team_members_sql = "SELECT COUNT(*) AS total FROM users";
      $team_members_result = mysqli_query($conn, $team_members_sql);
      $team_members = mysqli_fetch_assoc($team_members_result)['total'];

      
    
?> 
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>dashboard</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="styles.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
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
            <li> <a href="#"> <i class="bi bi-house"></i> <span class="link-text">Dashboard</span></a></li>
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
    <h3>Welcome !🖐 </h3>
    <p class="pg">See how you are doing today.</p>
    
    <div class="row g-4 mb-3">
      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-files fs-2 "></i>
          <h5>Projects</h5>
          <p class="fs-2 fw-bold mb-1"><?php echo $total_projects; ?></p>
          <p class="earn mt-0">
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-journal-check fs-2 "></i>
          <h5>Task</h5>
          <p class="fs-2 fw-bold mb-1"><?php echo $total_tasks; ?></p>
          <p class="earn mt-0"> </p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-file-earmark-check-fill fs-2 "></i>
          <h5>Completed</h5>
          <p class="fs-2 fw-bold mb-1">  <?php echo $completed_tasks; ?></p>
          <p class="earn mt-0"> </p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-people-fill fs-2 "></i>
          <h5>Team Members</h5>
          <p class="fs-2 fw-bold mb-1"> <?php echo $team_members; ?></p> 
          <p class="earn mt-0"></p>
        </div>
      </div>
      
    </div>

      <!--Overview-->
      <div class="row g-4">
        <div class="col-md-8">
          <div class="card shadow-sm p-3 mt-4">
            <h5>Recent Projects</h5>
            <?php if (empty($recent_projects)) : ?>
  <span class="text-muted">No recent projects</span>
<?php else: ?>
  <div class="list-group list-group-flush">
    <?php foreach ($recent_projects as $proj): ?>
      <div class="list-group-item bg-dark text-light mb-3">
        <strong><?php echo htmlspecialchars($proj['projectname']); ?></strong>
        (for <?php echo htmlspecialchars($proj['clientname'] ?? 'Unknown Client'); ?>)
        <br>
        <span class="badge 
  <?php 
    if ($proj['status'] == 'pending') {
      echo 'bg-primary';
    } elseif ($proj['status'] == 'in-progress') {
      echo 'bg-warning text-dark';
    } else {
      echo 'bg-success';
    }
  ?>">
  <?php echo ucfirst($proj['status']); ?>
</span>
<br><small class="text-white"><?php echo $proj['created_at']; ?></small>
    </div>
    <?php endforeach; ?>
    </div>

<?php endif; ?>
          </div>
          </div>

          <div class="col-md-4">
            <div class="card shadow-sm p-3 mt-4">
            <h5>My Task</h5>
            <span class=" text-center text-muted"><?php if (empty($recent_tasks)) {
              echo "No recent tasks";
            } else {
              echo "recent tasks"; 
            } ?></span>

            </ul>
          </div>
        </div>
      </div>

      <!--recent activity-->
      <div>
        <div class="col">
          <div class="card shadow-sm p-3 mt-4">
            <h5>Activity  Feed</h5>

          </div>
          </div>
      </div>
      <!--quick actions-->
      <div class="row g-4 mt-2">
        <h4 class="">Quick Actions</h4>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
            <button class="btn btt" data-bs-toggle="modal" data-bs-target="#addClientModal]">
              <i class="bi bi-people-fill fs-2" ></i> Add Client
            </button>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
            <button class="btn btt" data-bs-toggle="modal" data-bs-target="#addprojectModal">
              <i class="bi bi-files fs-2 "></i> New Project
            </button>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
           <a href="analytics.php"> <button class="btn btt">
              <i class="bi bi-bar-chart fs-2 "></i> view Analytics
            </button></a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
            <button class="btn btt" id="openModalBtn" data-bs-toggle="modal" data-bs-target="#invoiceModal">
              <i class="bi bi-currency-exchange fs-2 "></i> Record Payments
            </button>
          </div>
        </div>
      </div>
    </main>
   <!-- Invoice Modal -->
  <div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content text-black">
        <form id="invoiceForm">
          <div class="modal-header">
            <h5 class="modal-title">Create Invoice</h5>
            <button type="button" class="btn-close " data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="clientName" class="form-label">Client Name</label>
              <input type="text" class="form-control" id="CName" name="clientname"required>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Amount Paid</label>
              <input type="number" class="form-control" id="amt"name="amount" required>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Balance</label>
              <input type="number" class="form-control" id="bal" name="balance" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Create Invoice</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Add Client Modal -->
   <div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog text-black">
      <div class="modal-content">
        <form id="addClientForm">
          <div class="modal-header">
            <h5 class="modal-title">Client Form</h5>
            <button type="button" class=" btn-danger btn-close " data-bs-dismiss="modal"><i class=" fs-2 bg-succcess "></i></button>
            
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="clientname" class="form-label">Client Name</label>
              <input type="text" class="form-control" id="clientname">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="number" class="form-control" id="phone">
            </div>
            <div class="mb-3">
              <label for="mail" class="form-label">Email (optional)</label>
              <input type="email" class="form-control" id="mail">
            </div>
            <div class="mb-3">
              <label for="projectname" class="form-label">Project Name</label>
              <input type="text" class="form-control" id="projectname">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Company Name</label>
              <input class="form-control" id="desc"></input>
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Add Client</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
      <label for="cphone" class="form-label">For(clientname)</label>
      <input type="number" class="form-control" id="forcli" name="cliname" required>
    </div>
    <div class="mb-3">
      <label for="proname" class="form-label">Dead Line</label>
      <input type="text" class="form-control" id="dline" name="deadline" required>
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