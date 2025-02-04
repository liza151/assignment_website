<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: profile.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>No user found with that email.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color:rgb(9, 104, 199);
            padding: 20px;
        }

        header .navbar-brand {
            font-size: 1.8em;
            font-weight: bold;
            color: #fff;
        }

        .navbar-nav .nav-link {
            font-size: 1.2em;
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #3498db !important;
        }

        main {
            padding: 80px 15px;
            display: flex;
            justify-content: center;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            font-size: 2.5em;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            font-size: 1.1em;
            padding: 15px;
            border-radius: 10px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.4);
            border-color: #3498db;
        }

        button.btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button.btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-3px);
        }

        footer {
            background-color: #2c3e50;
            padding: 30px;
            color: white;
            font-size: 1.1em;
            text-align: center;
        }

        footer a {
            color: #3498db;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
        }

        .login-container a {
            font-weight: 500;
            color: #3498db;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
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
            </ul>
        </div>
    </nav>
</header>

<main>
    <div class="login-container">
        <h2>Login to Your Account</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label><br/>
                <input type="email" id="email" name="email" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="password">Password:</label><br/>
                <input type="password" id="password" name="password" class="form-control" required/>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form> 

        <p class="mt-4">Don't have an account? <a href="register.php">Sign up here</a></p>
    </div>
</main>

<footer class="text-center mt-5 p-3 bg-dark text-white">
    <p>&copy; 2025 Assignment Website</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
