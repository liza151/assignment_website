<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, phone, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
             background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background like login */
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.8em;
            color: #fff;
        }

        .navbar-nav .nav-link {
            font-size: 1.2em;
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #2980b9;
        }

        main {
            padding: 50px 15px;
        }

        .signup-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            padding: 15px;
            font-size: 1.1em;
            border-radius: 8px;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.4);
            border-color: #3498db;
        }

        .btn-primary {
            font-size: 1.2em;
            padding: 12px 25px;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            font-size: 1.1em;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        footer a:hover {
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
    <div class="signup-container">
        <h2>Create an Account</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <p class="mt-4">Already have an account? <a href="login.php">Login here</a></p>
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
