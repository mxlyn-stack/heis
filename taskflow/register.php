<?php
session_start();
require_once "db.php";
// If already logged in, redirect

 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fulname'];
    $email    = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pword'];

    // Check if user already exists
    $check_sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);
    $numrows = mysqli_num_rows($check_result);
    if ($numrows > 0) {
        $message = "User with this email or username already exists.";
        return;
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $insert_sql = "INSERT INTO users (fullname, username, email, password) 
                       VALUES ('$fullname', '$username', '$email', '$hashedPassword')";
        if (mysqli_query($conn, $insert_sql)) {
            header("Location: loginT.php");
            exit;
        } else {
            $message = "Error creating account: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign-up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-black">
  <div>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow-lg  bg-white">
            <div class="card-body">
              <img src=" ChatGPT Image Sep 15, 2025, 08_55_18 PM.png" class="logo w-25">
              <?php if (!empty($message)): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
              <?php endif; ?>
              <form id="registerForm" method="post">
                <div class="mb-3">
                  <label for="fullname" class="form-label">Full Name</label>
                  <input type="text" class="form-control" name="fulname" id="fullname" required>
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control bg-black" name="pword" id="password" required>
                  <input type="checkbox" onclick="togglePassword()"> Show Password
                </div>
                <button type="submit" id="registerBtn" class=" btn btn-success w-100">Sign Up</button>
                <p class="text-center mt-3">Already have an account? <a href="loginT.php">Login here</a></p>
                
              </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      if (passwordField.type === "password") {
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
      }
    }
    // loading spiner
    const form = document.getElementById("registerForm");
    const registerBtn = document.getElementById("registerBtn");
    form.addEventListener("submit", function(e) {
      //e.preventDefault(); // prevent page reload

      // show loading spinner inside button
      registerBtn.disabled = true;
      registerBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm me-2"></span>
        Creating...
      `;

      // simulate account creation
      setTimeout(() => {
        registerBtn.disabled = false;
        registerBtn.innerHTML = "Sign Up";
        // Here you would normally handle the actual form submission
      }, 2000); // 2 second delay for effect
    });
  </script>
  
</body>
</html>