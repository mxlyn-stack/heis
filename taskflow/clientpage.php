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

$user_id = $_SESSION['user_id'];
 
// Handle form submission for adding a new client
if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $clientname  = trim($_POST['clientname']);
    $clientemail = trim($_POST['clientemail']);
    $clientphone = trim($_POST['clientphone']);
    $companyname     = trim($_POST['companyname']);
    $projectname = trim($_POST['projectname']);

    // Basic validation
    if (empty($clientname)) {
        $message = "Client name is required.";
    } else {
        // Insert new client
        $insert_sql = "INSERT INTO clients (user_id, clientname, clientemail, clientphone, company, projectname) 
         VALUES ('$user_id', '$clientname', '$clientemail', '$clientphone', '$companyname', '$projectname')";
        if (mysqli_query($conn, $insert_sql)) {
            $message = "Client added successfully.";
        } else {
            $message = "Error adding client: " . mysqli_error($conn);
        }
    }
}

//fetch clients for display
$clients_sql = "SELECT * FROM clients WHERE user_id = '$user_id' AND status='active' ORDER BY id DESC";
$clients_result = mysqli_query($conn, $clients_sql);
$clients = mysqli_fetch_all($clients_result, MYSQLI_ASSOC);

// create client cards
$clientCards = "";
foreach ($clients as $client) {
    $id = (int)$client['id']; // ensure safe integer
    $clientCards .= "
    <div class='col-md-4'>
      <div class='card shadow-lg'>
        <div class='card-body'>
          <h4 class='text-success'><i class='bi bi-person-circle'></i> " . htmlspecialchars($client['clientname']) . "</h4> 
          <p style='font-size: 12px;'> Client since: " . date('M d, Y', strtotime($client['created_at'])) . "</p>
          <p class='cli' style='font-size: 12px;'> Email: " . htmlspecialchars($client['clientemail']) . " </p>
          <p class='cli' style='font-size: 12px;'> Phone: " . htmlspecialchars($client['clientphone']) . " </p>
          <p class='cli' style='font-size: 12px;'> Company: " . htmlspecialchars($client['company']) . "</p>
          <p class='cli' style='font-size: 12px;'> Project: " . htmlspecialchars($client['projectname']) . "</p>
          <div id='messageBox' class='mt-3'></div>
          <button class='btn btn-sm btn-outline-success' onclick='editClient($id)'>
             <i class='bi bi-pencil-square'></i> 
          </button>
          <button class='btn btn-sm btn-outline-danger' onclick='deleteClient($id)'>
             <i class='bi bi-trash'></i> 
          </button>
        </div>
      </div>
    </div>
    ";
}

if (empty($clientCards)) $clientCards = "<p>No clients found. Add a new client using the button above.</p>";
// delete client and change status in db
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>clientpage</title>
  
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
    <h3>Clients Page</h3>
    <p class="pg">Manage your clients here.</p>
  </div>
  <button class="btn btn-success" id="addClientForm" data-bs-toggle="modal" data-bs-target="#addClientModal">
    <i class="bi bi-plus-lg"></i> Add Client
  </button>
</div>
<div class="container mb-4 ">
    <div class="input-group">
      <span class="input-group-text bg-dark text-white">
        <i class="bi bi-search"></i>
      </span>
      <input type="text" class="form-control search-input bg-dark text-white" placeholder="Search here...">
    </div>
  </div>
  <div> <?php
    if (isset($message)) {
        echo "<div class='alert alert-info'>{$message}</div>";
    }
    ?> </div>
  <div class="container">
    <div class="row g-4">
      <?php echo $clientCards; ?>
    </div>
  </div>

  </main>
  <!-- Add Client Modal -->
   <div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog text-black">
      <div class="modal-content">
        <form id="clientForm" method="post">
  <div class="modal-header">
    <h5 class="modal-title">Client Form</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <div class="mb-3">
      <label for="cname" class="form-label">Client Name</label>
      <input type="text" class="form-control" id="cname" name="clientname" required>
    </div>
    <div class="mb-3">
      <label for="cphone" class="form-label">Phone</label>
      <input type="number" class="form-control" id="cphone" name="clientphone" required>
    </div>
    <div class="mb-3">
      <label for="cmail" class="form-label">Email </label>
      <input type="email" class="form-control" id="cmail" name="clientemail">
    </div>
    <div class="mb-3">
      <label for="proname" class="form-label">Project Name</label>
      <input type="text" class="form-control" id="proname" name="projectname" required>
    </div>
    <div class="mb-3">
      <label for="comp" class="form-label">Company Name</label>
      <input type="text" class="form-control" id="comp" name="companyname">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-success">Add Client</button>
  </div>
</form>
</div>
      </div>
    </div>
    <!-- modal for delete confirmation -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content bg-black text-white">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-black">
          <div id="messageBox1" class=" bg-black text-white"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
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
// loading spiner
    const form = document.getElementById("clientForm");
const addClientBtn = form.querySelector("button[type='submit']");
form.addEventListener("submit", function () {
  addClientBtn.disabled = true;
  addClientBtn.innerHTML = `
    <span class="spinner-border spinner-border-sm me-2"></span>
    Adding...
  `;
});
//delete client
function deleteClient(id) {
    const deleteModalEl = document.getElementById("deleteModal");
    const deleteModal = bootstrap.Modal.getOrCreateInstance(deleteModalEl);
    const messageBox1 = document.getElementById("messageBox1");

    messageBox1.innerHTML = "<p>Are you sure you want to delete this client?</p>";
    deleteModal.show();

    document.getElementById("confirmDeleteBtn").onclick = function() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_client.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (this.status == 200 && this.responseText.trim() === "success") {
                messageBox1.innerHTML = "<div class='alert alert-success'>Client deleted successfully.</div>";
                setTimeout(() => {
                    deleteModal.hide();
                    location.reload();
                }, 1000);
            } else {
                messageBox1.innerHTML = "<div class='alert alert-danger'>Error deleting client: " + this.responseText + "</div>";
            }
        };
        xhr.send("id=" + id);
    };
}

//edit client
function editClient(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "get_client.php?id=" + id, true);
    xhr.onload = function() {
        if (this.status == 200) {
            let client = JSON.parse(this.responseText);
            document.getElementById("cname").value = client.clientname;
            document.getElementById("cphone").value = client.clientphone;
            document.getElementById("cmail").value = client.clientemail;
            document.getElementById("proname").value = client.projectname;
            document.getElementById("comp").value = client.company;

            // Change form action to update
            document.getElementById("clientForm").action = "update_client.php?id=" + id;

            // Show modal
            var myModal = new bootstrap.Modal(document.getElementById("addClientModal"));
            myModal.show();
        }
    };
    xhr.send();
}
    </script>
  </body>
</html>