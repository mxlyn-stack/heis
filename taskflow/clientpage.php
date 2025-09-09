<!DOCTYPE>
<html lang="en">
  <head> 
    <title>Client Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styl.css">
  </head>
  <body class="bg-black">
    <div class="container mt-5 text-center">
      <h2 class="text-success">Client Page</h2>
      <p class="text-success">Manage your clients here.</p>
      <button class="btn btn-primary">Add Client</button>
      <button class="btn btn-success">View Clients</button>
    </div>
    <!--client list-->
    <div id="modal" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Client List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="list-group"> >
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Client 1
                <span class="badge bg-primary rounded-pill">Edit</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Client 2
                <span class="badge bg-primary rounded-pill">Edit</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Client 3
                <span class="badge bg-primary rounded-pill">Edit</span>
              </li>
            </ul>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>