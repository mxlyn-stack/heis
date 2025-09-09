<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Lightweight Task Management for Freelancers & Teams</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        .logo{
            width: 100px;

        }
    </style>
</head>
<body class="antialiased text-gray-800">

    <!-- Header Section -->
    <header class="bg-white shadow-sm py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <img src=" 20250902_122552.png" class="logo">
            <a href="#" class="text-3xl font-bold text-green-800">TaskFlow</a>
            <nav class="hidden md:flex space-x-6">
                <a href="#features" class="text-gray-600 hover:text-green-800 font-medium transition duration-300">Features</a>
                <a href="#pricing" class="text-gray-600 hover:text-green-800 font-medium transition duration-300">Pricing</a>
                <a href="#contact" class="text-gray-600 hover:text-green-800 font-medium transition duration-300">Contact</a>
            </nav>
            <div class="flex items-center space-x-4">
                <button id="loginBtn" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-green-300 transition duration-300">Login</button>
                <button id="signupBtn" class="px-5 py-2 bg-green-800 text-white rounded-lg hover:bg-green-600 transition duration-300">Sign Up</button>
            </div>
        </div>
    </header>
 
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20 md:py-32 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Effortless Task Management <br class="hidden md:block"> for Freelancers & Teams
            </h1>
            <p class="text-lg md:text-xl mb-10 max-w-2xl mx-auto opacity-90">
                Organize projects, collaborate seamlessly, and boost productivity with TaskFlow. Simple, fast, and responsive.
            </p>
            <button id="getStartedBtn" class="bg-white text-green-800 font-bold py-3 px-8 rounded-lg text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                Get Started Free
            </button>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-black">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-12 text-green-100">Features Built for Productivity</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="feature-card bg-green-800 p-8 rounded-xl shadow-lg flex flex-col items-center text-center transition duration-300 hover:scale-105 hover:bg-green-800">
                    <svg class="w-16 h-16 text-green-100 mb-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m5.66 0A9.957 9.957 0 0012 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10-4.477-10-10-10zM12 20a8 8 0 110-16 8 8 0 010 16z" />
                    </svg>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-100">Intuitive Task Management</h3>
                    <p class="text-gray-100 leading-relaxed">Create, track, and manage tasks with ease. Set due dates, assign members, and update status in real-time.</p>
                </div>
                <!-- Feature Card 2 -->
                <div class="feature-card bg-green-800 p-8 rounded-xl shadow-lg flex flex-col items-center text-center transition duration-300 hover:scale-105 hover:bg-green-800">
                    <svg class="w-16 h-16 text-green-100 mb-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 6a2 2 0 10-4 0 2 2 0 004 0zM12 8a4 4 0 100-8 4 4 0 000 8zM19 18a7 7 0 00-14 0h14zM12 10a7 7 0 00-7 7v3h14v-3a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-100">Seamless Collaboration</h3>
                    <p class="text-gray-100 leading-relaxed">Invite team members, assign roles, and work together on projects effortlessly, no matter where you are.</p>
                </div>
                <!-- Feature Card 3 -->
                <div class="feature-card bg-green-800 p-8 rounded-xl shadow-lg flex flex-col items-center text-center transition duration-300 hover:scale-105 hover:bg-green-800">
                    <svg class="w-16 h-16 text-green-100 mb-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.5a.5.5 0 00-1 0v7a.5.5 0 001 0V6.5zM12 18a.5.5 0 00-1 0v1a.5.5 0 001 0v-1zM18 12.5a.5.5 0 000-1h-1a.5.5 0 000 1h1zM6 12.5a.5.5 0 000-1H5a.5.5 0 000 1h1zM12 21a9 9 0 100-18 9 9 0 000 18zM12 22a10 10 0 100-20 10 10 0 000 20z" />
                    </svg>
                    <h3 class="text-2xl font-semibold mb-4 text-green-100">Actionable Analytics</h3>
                    <p class="text-gray-100 leading-relaxed">Gain insights into your team's progress and identify bottlenecks with simple, visual analytics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-16 bg-black-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-12 text-gray-100">Simple & Transparent Pricing</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <!-- Free Plan Card -->
                <div class="bg-green-700 p-8 rounded-xl shadow-lg border border-gray-200 transition duration-300 hover:scale-105 hover:shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-100 mb-4">Free Plan</h3>
                    <p class="text-5xl font-extrabold text-gray-100 mb-6">$0<span class="text-lg font-normal text-gray-100">/forever</span></p>
                    <ul class="text-gray-100 text-left space-y-3 mb-8">
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>1 Project</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gra-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>3 Team Members</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>50 Tasks</li>
                        <li class="flex items-center text-gray-100"><svg class="w-5 h-5 mr-2 text-gray-00" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>No File Uploads</li>
                    </ul>
                    <button id="freeSignupBtn" class="w-full bg-gray-100 text-green py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">
                        Sign Up for Free
                    </button>
                </div>

                <!-- Pro Plan Card -->
                <div class="bg-white p-8 rounded-xl shadow-lg border-2 border-green-500 transition duration-300  hover:scale-105">
                    <h3 class="text-2xl font-bold text-green-600 mb-4">Pro Plan</h3>
                    <p class="text-5xl font-extrabold text-green-800 mb-6">$9<span class="text-lg font-normal text-green-800">/month</span></p>
                    <ul class="text-gray-700 text-left space-y-3 mb-8">
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>10 Projects</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>10 Team Members</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Unlimited Tasks</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>File Uploads (5MB/file)</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Email Support</li>
                    </ul>
                    <button id="proSignupBtn" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                        Choose Pro Plan
                    </button>
                </div>

                <!-- Team Plan Card -->
                <div class="bg-green-700 p-8 rounded-xl shadow-lg border border-gray-200 transition duration-300 hover:scale-105 hover:shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-100 mb-4">Team Plan</h3>
                    <p class="text-5xl font-extrabold text-gray-100 mb-6">$29<span class="text-lg font-normal text-gray-100">/month</span></p>
                    <ul class="text-gray-100 text-left space-y-3 mb-8">
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Unlimited Projects</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>25 Team Members</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Unlimited Tasks</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>File Uploads (20MB/file)</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Priority Support</li>
                        <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Team Roles & Permissions</li>
                    </ul>
                    <button id="teamSignupBtn" class="w-full bg-gray-100 text-green py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">
                        Choose Team Plan
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-green-700 text-white py-16 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold mb-6">Ready to streamline your workflow?</h2>
            <p class="text-xl mb-8 opacity-90">Join thousands of happy freelancers and teams using TaskFlow today!</p>
            <button id="ctaSignupBtn" class="bg-white text-green-800 font-bold py-3 px-8 rounded-lg text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                Start Your Free Plan
            </button>
        </div>
    </section>

    <!-- Footer Section -->
    <footer id="contact" class="bg-black-800 text-gray-300 py-10">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-2xl font-bold text-white mb-4">TaskFlow</h3>
                <p class="text-gray-100">Lightweight task management for modern workflows.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#features" class="hover:text-white transition duration-300">Features</a></li>
                    <li><a href="#pricing" class="hover:text-white transition duration-300">Pricing</a></li>
                    <li><a href="#" class="hover:text-white transition duration-300">Help & Support</a></li>
                    <li><a href="#" class="hover:text-white transition duration-300">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Contact Us</h3>
                <p class="text-gray-100">Email: support@taskflow.com</p>
                <p class="text-gray-100">Phone: +234(0)8080093146</p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-green-100 hover:text-white transition duration-300"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.606 7.423a.5.5 0 01.12.339.5.5 0 01-.12.339l-4.453 4.453a.5.5 0 01-.707 0l-2.453-2.453a.5.5 0 010-.707.5.5 0 01.707 0l2.1 2.1 4.1-4.1a.5.5 0 01.707 0z"/></svg></a>
                    <a href="#" class="text-green-1400 hover:text-white transition duration-300"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm4.321 7.214a.75.75 0 00-.735.617l-.8 4.298a.75.75 0 01-1.07.514l-2.316-1.545a.75.75 0 00-.814.07l-1.396 1.157a.75.75 0 01-.84.07l-2.316-1.545a.75.75 0 00-1.07.514l-.8 4.298a.75.75 0 00-.735.617.75.75 0 00-.617.735v.001A.75.75 0 005.12 19a.75.75 0 00.735-.617l.8-4.298a.75.75 0 011.07-.514l2.316 1.545a.75.75 0 00.814-.07l1.396-1.157a.75.75 0 01.84-.07l2.316 1.545a.75.75 0 001.07-.514l.8-4.298a.75.75 0 00.735-.617V9.95a.75.75 0 00-.735-.617z"/></svg></a>
                </div>
            </div>
        </div>
        <div class="border-t border-black-700 mt-8 pt-6 text-center text-white-900">
            &copy; 2025 TaskFlow. All rights reserved.
        </div>
    </footer>
    <script>
        // Modal functionality
        const loginBtn = document.getElementById('loginBtn');
        const signupBtn = document.getElementById('signupBtn');
        const getStartedBtn = document.getElementById('getStartedBtn');
        const ctaSignupBtn = document.getElementById('ctaSignupBtn');
        const freeSignupBtn = document.getElementById('freeSignupBtn');
        const proSignupBtn = document.getElementById('proSignupBtn');
        const teamSignupBtn = document.getElementById('teamSignupBtn');

        function openSignup() {
            window.location.href = 'register.php';
        }  
        document.getElementById('signupBtn').onclick = openSignup;
        document.getElementById('getStartedBtn').onclick = openSignup;
        document.getElementById('ctaSignupBtn').onclick = openSignup;
        document.getElementById('freeSignupBtn').onclick = openSignup;
        document.getElementById('proSignupBtn').onclick = openSignup;
        document.getElementById('teamSignupBtn').onclick = openSignup;
        document.getElementById('loginBtn').onclick = function() {
            window.location.href = 'login.php';
        };
    </script>
</body>
</html>