<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "All fields are required.";
    } else {
        // Prepare SQL (procedural style)
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Store session safely
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['email']     = $user['email'];
                $_SESSION['username']  = $user['username'];

                header("Location: dashboardT.php");
                exit;
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "User not found.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LoginT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow-lg">
            <div class="card-body">
              <div>
                   <?php
                      if($message !== ""){
                        echo "error ". $message;
                      }
                   ?>
              </div>
              <h3 class="text-center mb-4"><i class="bi bi-"></i> TaskFlow</h3>
              <form id="loginForm" method="post">
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" id="loginBtn" class="btn btn-success w-100">Login</button>
              </form>
              <p class="text-center mt-3">Don't have an account? <a href="register.php">Sign up</a></p>
              <p class="text-center"><a href="resetpassword.php">Forgot password?</a></p>
            </div>
          </div>
        </div>

      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script>
      // loading spiner
      const form = document.getElementById("loginForm");
      const loginBtn = document.getElementById("loginBtn");
      form.addEventListener("submit", function(e) {
        loginBtn.disabled = true;
        loginBtn.innerHTML = `
          <span class="spinner-border spinner-border-sm me-2"></span>
          Logging in...
        `;
      });
     </script>
  </body>
</html>