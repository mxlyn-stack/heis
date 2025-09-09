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
            background-color: #000000; 
            color: white;
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
            margin: 0 ;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .btn{
            background-color: #000000; /* Indigo-500 */
            color: white;
            padding: 10px 0px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;   
        }
        .jc{
                background-color: white;
                color: black;
                padding: 10px;
                font-weight: bold;
            }
        .jc:hover{
           transform: scale(1.1);
           transition: 0.5s ease-out;
           background-color: white;
           color: black;
         }
    </style>
</head>
<body class="bg-white text-black">
  <!-- Header Section -->
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="main-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><h3 class="fw-bold ">TaskFlow</h3></a>
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
            <button id="loginBtn" class="btn btn-outline-dark m-2 p-2">Login</button>
            <button id="signupBtn" class="btn btn-outline-dark p-2">Sign Up</button>
        </div>
    </nav>     
    </header>
    <!-- Hero Section -->
    <section class="">
        <div class="container mx-auto p-4 ">
            <h1 class=" mt-2">
                Effortless Task Management <br class="hidden md:block"> for Freelancers & Teams
            </h1>
            <p class="text-center">
                Organize projects, collaborate seamlessly, and boost productivity with TaskFlow.
                <br > Simple, fast, and responsive.
            </p>
            <button id="getStartedBtn" class="btn  jc">
                Get Started Free
            </button>
        </div>
    </section>
    <!-- Features Section -->
    <section id="features" class=" bg-dark text-white">
        <div class="row text-center  ">
            <h2 class=" ">Features Built for Productivity</h2>
                <!-- Feature Card 1 -->
                <div class=" col-md-4 text-center">
                    <div class="card  shadow-sm p-3 text-center bg-white text-black">
                        <h3 class="">Intuitive Task Management</h3>
                        <p class="">Create, track, and manage tasks with ease. Set due dates,
                        assign members, and update status in real-time.</p>
                    </div>
                </div>
                <!-- Feature Card 2 -->
                <div class="col-md-4">
                    <div class="card  shadow-sm p-3 text-center bg-white text-black">
                        <h3 class="">Seamless Collaboration</h3>
                        <p class="">Invite team members, assign roles, and work together
                            on projects effortlessly, no matter where you are.</p>
                    </div>     
                </div>
                <!-- Feature Card 3 -->
                <div class="col-md-4">
                    <div class="card  shadow-sm p-3 text-center bg-white text-black">
                        <h3 class="">Actionable Analytics</h3>
                        <p class="">Gain insights into your team's progress and identify bottlenecks with simple,
                            visual analytics.</p>
                     </div>
                </div>
            
        </div>
    </section>
    <!-- Pricing Section -->
    <section id="pricing" class=" bg-white text-black">
        <div class="row text-center  ">
            <h2 class=" ">Simple, Transparent Pricing</h2>
                <!-- Pricing Card 1 -->
                <div class=" col-md-4 text-center">
                    <div class="card  shadow-sm p-3 text-center bg-dark text-light">
                        <i class="bi bi-person text-8xl mb-4"></i>
                        <h3 class="text-2xl font-semibold mb-4 text-gray-100">Free Plan</h3>
                        <p class="">Perfect for individuals and small teams just getting started.</p>
                        <ul class="list-disc list-inside mb-4">
                            <li>Up to 5 users</li>
                            <li>Basic task management</li>
                            <li>Limited storage</li>
                        </ul>
                        <p class="text-3xl font-bold mb-4">$0<span class="text-base font-normal">/month</span></p>
                        <button class="btn jc">Get Started</button>
                    </div>
                </div>
                <!-- Pricing Card 2 -->
                <div class="col-md-4">
                    <div class="card  shadow-sm p-3 text-center bg-dark text-light">
                        <i class="bi bi-people text-4xl mb-4"></i>
                        <h3 class="">Pro Plan
</h3>                        <p class="">Ideal for growing teams needing advanced features and more storage.</p>
                        <ul class="list-disc list-inside mb-4">
                            <li>Up to 50 users</li>
                            <li>Advanced task management</li>
                            <li>Priority support</li>
                            <li>Increased storage</li>
                        </ul>
                        <p class="text-3xl font-bold mb-4">$15<span class="text-base font-normal">/user/month</span></p>
                        <button class="btn jc">Get Started</button>
                    </div>
                </div>
                <!-- Pricing Card 3 -->
                <div class="col-md-4">
                    <div class="card  shadow-sm p-3 text-center bg-dark text-light">
                        <i class="bi bi-building text-4xl mb-4"></i>
                        <h3 class="">Enterprise Plan</h3>
                        <p class="">Custom solutions for large organizations with specific needs.</p>
                        <ul class="list-disc list-inside mb-4">
                            <li>Unlimited users</li>
                            <li>Custom integrations</li>
                            <li>Dedicated account manager</li>
                            <li>Enhanced security features</li>
                        </ul>
                        <p class="text-3xl font-bold mb-4">Contact Us</p>
                        <button class="btn jc">Contact Sales</button>
                    </div>
                </div>
        </div>
    </section>
    <!-- Call to Action Section -->
    <section class=" text-center">
        <div class="container ">
            <h2 class=" mb-6 ">Ready to streamline your workflow?</h2>
            <p class="text-xl ">Join thousands of happy freelancers and teams using TaskFlow today!</p>
            <button id="ctaSignupBtn" class="btn ">
                Start Your Free Plan
            </button>
        </div>
    </section>

    <!-- Footer Section -->
    <footer id="contact" class="bg-dark text-white">
        <div class="container ">
            <div>
                <h3 class=" text-white mb-4">TaskFlow</h3>
                <p class="">Lightweight task management for modern workflows.</p>
            </div>
            <div>
                <h3 class=" text-white mb-4">Quick Links</h3>
                <ul class="">
                    <li><a href="#features" class="">Features</a></li>
                    <li><a href="#pricing" class="">Pricing</a></li>
                    <li><a href="#" class="">Help & Support</a></li>
                    <li><a href="#" class="">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class=" text-white mb-4">Contact Us</h3>
                <p class="">Email: support@taskflow.com</p>
                <p class="">Phone: +1 (555) 123-4567</p>
                <div class="flex  mt-4">
                    <a href="#" class=""></a>
                    <a href="#" class=""></a>
                </div>
            </div>
        </div>
        <div class="border-t border-black-700 mt-8 pt-6 text-center text-white-900">
            &copy; 2025 TaskFlow. All rights reserved.
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

<!-- Bootstrap JS CDN (optional, for components that need it like dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
</div>
</body>

</html>