<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data from database
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Function to get default image if none exists
function getProfileImage($user) {
    if (isset($user['profile_image']) && !empty($user['profile_image']) && file_exists($user['profile_image'])) {
        return htmlspecialchars($user['profile_image']);
    }
    return 'uploads/default-avatar.png';
}
?>

<!DOCTYPE html>
<html lang='en'>
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            color: #495057;
            padding-top: 80px;
        }

        header {
            background: rgba(52, 152, 219, 0.9);
            padding: 20px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            color: #3498db !important;
            text-decoration: underline;
        }

        .profile-image-nav {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 15px;
        }

        .profile-image-dropdown {
            cursor: pointer;
        }

        main {
            padding: 50px 15px;
        }

        h2 {
            font-size: 2.5em;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            font-size: 1.1em;
            padding: 12px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.6);
            border-color: #3498db;
        }

        .btn-primary, .btn-danger {
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1.1em;
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-danger {
            background: linear-gradient(90deg, #e74c3c, #c0392b);
        }

        .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 25px;
            text-align: center;
        }

        .image-preview {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid #3498db;
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            font-size: 1.1em;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #3498db;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<header>
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
            <div class="dropdown">
                <img src="<?php echo getProfileImage($user); ?>" 
                     alt="Profile" 
                     class="profile-image-nav profile-image-dropdown"
                     data-toggle="dropdown">
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="update_image.php">Update Profile Picture</a>
                    <a class="dropdown-item" href="profile.php">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="" method="POST">
                <h2>Your Profile</h2>

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" 
                           value="<?php echo htmlspecialchars($user['first_name']); ?>" 
                           class="form-control" required/>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" 
                           value="<?php echo htmlspecialchars($user['last_name']); ?>" 
                           class="form-control" required/>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo htmlspecialchars($user['email']); ?>" 
                           class="form-control" required/>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" 
                           value="<?php echo htmlspecialchars($user['phone']); ?>" 
                           class="form-control"/>
                </div>

                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                <button type="submit" name="delete" 
                        onclick="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');" 
                        class="btn btn-danger">Delete Profile</button>
            </form>
        </div>

        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile Picture</h5>
                    <img src="<?php echo getProfileImage($user); ?>" 
                         alt="Profile Picture" 
                         class="image-preview mb-3">
                    <a href="update_image.php" class="btn btn-primary">Update Profile Picture</a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2025 Assignment Website</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
