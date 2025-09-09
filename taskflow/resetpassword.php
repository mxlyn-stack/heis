<!DOCTYPE html>
<html>
<head> 
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">                     
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-body">
        <form id="resetForm" method="post">
          <h3 class="text-center"> Password Reset</h3>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <button type="submit" id="sendBtn" class="btn btn-success w-100">
            Send Code
          </button>
        </form>

        <!-- Message area -->
        <div id="messageBox" class="mt-3"></div>
      </div>
    </div>
  </div>

  <script>
    const form = document.getElementById("resetForm");
    const sendBtn = document.getElementById("sendBtn");
    const messageBox = document.getElementById("messageBox");

    form.addEventListener("submit", function(e) {
      e.preventDefault(); // prevent page reload

      // show loading spinner inside button
      sendBtn.disabled = true;
      sendBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm me-2"></span>
        Sending...
      `;

      // simulate sending code
      setTimeout(() => {
        sendBtn.disabled = false;
        sendBtn.innerHTML = "Send Code";
        messageBox.innerHTML = `
          <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> A reset code has been sent to your email. Please check your inbox.
          </div>
        `;
      }, 2000); // 2 second delay for effect
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
