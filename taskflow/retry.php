<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing page</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="style.css">
   <style>
   body {
            font-family: 'Inter', sans-serif;
            background-color: #000000; /* Slate-50 */
        }
        .gradient-bg {
            background: linear-gradient(to right, #175f3b, #034b1b); /* Indigo-500 to Violet-500 */
        }
        .feature-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 90%;
            max-width: 500px;
            position: relative;
        }
        .close-button {
            position: absolute;
            top: 12px;
            right: 18px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close-button:hover,
        .close-button:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-header {
            margin-bottom: 20px;
        }
        .modal-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .modal-body {
            font-size: 16px;
            color: #555;
        }
        .modal-footer {
            margin-top: 20px;
            text-align: right;
        }
        div.container {
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .btn{
            background-color: #175f3b; /* Indigo-500 */
            color: white;
            padding: 10px 0px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
  <!-- Header Section -->
    <header class="bg- shadow-sm py-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="main-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">TaskFlow</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
                <button id="loginBtn" class="btn btn-outline-secondary m-0">Login</button>
                <button id="signupBtn" class="btn btn-success m-4">Sign Up</button>
            </div>
    </nav>
              
    </header>
</body>

</html>