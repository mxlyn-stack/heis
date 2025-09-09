<?php
   session_start();
   require_once "db.php";
    
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
  <script src="script.js"></script>
</head>
<body>
  <aside>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center px-3">
          <h4 class="nu ">Menu </h4>
          <button class="btn btn-sm btn-outline-success" id="toggle-btn">
            <i class="bi bi-list text-light"></i>
          </button>
        </div>
        <nav class="navbar">
          <ul class="navbar-nav drop-down-menu">
            <li> <a href="#"> <i class="bi bi-house"></i> <span class="link-text">Dashboard</span></a></li>
            <li> <a href="#"> <i class="bi bi-files"></i> <span class="link-text">Projects</span></a></li>
            <li> <a href="#"> <i class="bi bi-people-fill"></i> <span class="link-text">Clients</span></a></li>
            <li> <a href="#"> <i class="bi bi-receipt"></i> <span class="link-text">Invoices</span></a></li>
            <li> <a href="#"> <i class="bi bi-bar-chart"></i> <span class="link-text">Analytics</span></a></li>
            <li> <a href="#"> <i class="bi bi-gear-wide"></i> <span class="link-text">Settings</span></a></li>
            <li> <a href="#"> <i class="bi bi-box-arrow-left"></i> <span class="link-text">Logout</span></a></li>
          </ul>
        </nav>
    </div>
  </aside>
  <main class="content p-4" id="main-content">
    <h3>Welcome ! <?php echo $_SESSION['username']; ?></h3>
    <p class="pg">See how you are doing today.</p>
    
    <div class="row g-4 mb-3">
      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-wallet2 fs-2 "></i>
          <h5>Balance</h5>
          <p class="fs-2 fw-bold mb-1">$0.00</p>
          <p class="earn mt-0"> Available Revenue</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-graph-up-arrow fs-2 "></i>
          <h5>Total Earnings</h5>
          <p class="fs-2 fw-bold mb-1">$0.00</p>
          <p class="earn mt-0"> Earnings of all time</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-people-fill fs-2 "></i>
          <h5>Clients</h5>
          <p class="fs-2 fw-bold mb-1">0</p>
          <p class="earn mt-0">No active relationship</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
          <i class="bi bi-files fs-2 "></i>
          <h5>Active Projects</h5>
          <p class="fs-2 fw-bold mb-1">0</p>
          <p class="earn mt-0"> 0 Completed</p>
        </div>
      </div>
      
    </div>
    <!-- table data -->
      <div class="card  mark shadow-sm p-3 mt-4">
        <h4 class="text-white">Projects</h4>
        <div class="table-responsive-sm">
          <table class="table table-striped ">
            <thead>
              <tr class="">
                <th>#</th>
                <th>Client</th>
                <th>Project</th>
                <th>Status</th>
                <th>Deadline</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!--Overview-->
      <div class="row g-4">
        <div class="col-md-8">
          <div class="card shadow-sm p-3 mt-4">
            <h5>Recent Activity</h5>
            <span class=" text-center text-muted">No recent activity</span>
          </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow-sm p-3 mt-4">
            <h5>Insights</h5>
            <span class=" text-center text-muted">No recent activity</span>

            </ul>
          </div>
        </div>
      </div>
      <!--quick actions-->
      <div class="row g-4 mt-2">
        <h4 class="">Quick Actions</h4>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
            <button class="btn btt" data-bs-toggle="modal" data-bs-target="#addClientModal">
              <i class="bi bi-people-fill fs-2" ></i> Add Client
            </button>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
            <button class="btn btt">
              <i class="bi bi-files fs-2 "></i> New Project
            </button>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm  mt-">
            <button class="btn btt">
              <i class="bi bi-bar-chart fs-2 "></i> view Analytics
            </button>
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
            <button type="button" class="btn-close bg-black text-black" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="clientName" class="form-label">Client Name</label>
              <input type="text" class="form-control" id="clientName" required>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Amount</label>
              <input type="number" class="form-control" id="amount" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Create Invoice</button>
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
            <button type="button" class=" btn-danger btn-close " data-bs-dismiss="modal"><i class="bi bi-currency-exchange fs-2 bg-succcess "></i></button>
            
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
              <label for="desc" class="form-label">Project Description</label>
              <textarea class="form-control" id="desc"></textarea>
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Add Client</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>