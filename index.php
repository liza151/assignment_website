<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f5f7fa, #c3cfe2);
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background:rgb(22, 195, 201);
            border-bottom: 3px solid #3498db;
        }

        header .navbar-brand {
            font-size: 1.8em;
            font-weight: bold;
            color: #fff;
        }

        .navbar-nav .nav-link {
            font-size: 1.2em;
            color:  #3498db;
            margin-left: 20px;
        }

        .navbar-nav .nav-link:hover {
            color: #3498db !important;
        }

        h1, h2 {
            font-size: 2.8em;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            color: #3498db;
        }

        h2 {
            color: #3498db;
        }

        p {
            font-size: 1.1em;
            line-height: 1.7;
            color: #555;
            text-align: center;
        }

        .container {
            padding: 50px 15px;
        }

        /* Features Section */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            margin-bottom: 30px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }

        .card-body {
            background-color: #fff;
            padding: 25px;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .card-title {
            font-size: 1.7em;
            color: #2c3e50;
            font-weight: 600;
        }

        .card-text {
            font-size: 1.1em;
            color: #777;
            line-height: 1.5;
        }

        .carousel-item p {
            font-size: 1.2em;
            color: #555;
            text-align: center;
            padding: 20px;
            font-weight: 600;
        }

        .carousel-item {
            background: rgba(52, 152, 219, 0.1);
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 12px 25px;
            font-size: 1.1em;
            font-weight: 600;
            border-radius: 50px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        footer {
            background: #2c3e50;
            padding: 30px;
            color: white;
            font-size: 1.1em;
            text-align: center;
        }

        footer a {
            color:rgb(84, 93, 101);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Contact Form */
        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            font-size: 1.1em;
        }

        .form-group label {
            font-size: 1.2em;
            font-weight: 600;
        }

        .form-group textarea {
            height: 150px;
        }

        .form-group input, .form-group textarea {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.4);
            border-color: #3498db;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white p-3">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">Assignment Website</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Signup</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <h1>Welcome to Our Website</h1>
        <p>This is the homepage. Feel free to explore our features and get to know more about us.</p>

        <section id="about" class="mt-5">
            <h2>About Us</h2>
            <p>Our website provides resources and tools for students to manage their assignments efficiently. Whether you're looking for tips, support, or want to stay on top of your tasks, we are here to help!</p>
        </section>

        <section id="features" class="mt-5">
            <h2>Our Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://t4.ftcdn.net/jpg/10/27/86/99/360_F_1027869964_YnsC0GtAWS8b4Cb3HZq6wSvcKOZSFm75.jpg" class="card-img-top" alt="Task Management">
                        <div class="card-body">
                            <h5 class="card-title">Task Management</h5>
                            <p class="card-text">Keep track of all your assignments, deadlines, and tasks in one place.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://academicresourcecenter.harvard.edu/files/2023/12/ARC_Website_Content_Accountability_Hours_2-1024x683.jpg" class="card-img-top" alt="Study Resources">
                        <div class="card-body">
                            <h5 class="card-title">Study Resources</h5>
                            <p class="card-text">Access study materials and helpful resources to improve your learning experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://img.freepik.com/premium-photo/hands-holding-each-other-support_23-2150446011.jpg?semt=ais_hybrid" class="card-img-top" alt="Community Support">
                        <div class="card-body">
                            <h5 class="card-title">Community Support</h5>
                            <p class="card-text">Connect with fellow students and get support from a vibrant community.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="mt-5">
            <h2>What Our Users Say</h2>
            <div class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="d-block w-100">"This website helped me stay organized and on top of my assignments. Highly recommend!" - Student A</p>
                    </div>
                    <div class="carousel-item">
                        <p class="d-block w-100">"I love the community support! I always feel like I'm not alone." - Student B</p>
                    </div>
                    <div class="carousel-item">
                        <p class="d-block w-100">"The study resources section is amazing! It really helped me prepare for my exams." - Student C</p>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#testimonials" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#testimonials" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>

        <section id="contact" class="mt-5">
            <h2>Contact Us</h2>
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Assignment Website</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
