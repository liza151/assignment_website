<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Create uploads directory if it doesn't exist
$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Fetch current user data
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_image'])) {
    if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file_extension = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $new_filename = "profile_" . $user_id . "_" . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        $uploadOk = 1;

        // Check if image file is actual image
        $check = @getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check === false) {
            $message = "<div class='alert alert-danger'>File is not an image.</div>";
            $uploadOk = 0;
        }

        // Check file size (limit to 2MB)
        if ($_FILES["profile_image"]["size"] > 6000000) {
            $message = "<div class='alert alert-danger'>Sorry, your file is too large. Maximum size is 5MB.</div>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "gif") {
            $message = "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Delete old profile image if it exists
            if (!empty($user['profile_image']) && file_exists($user['profile_image']) && $user['profile_image'] != 'uploads/default-avatar.png') {
                @unlink($user['profile_image']);
            }

            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                // Update database with new image path
                $update_sql = "UPDATE users SET profile_image = ? WHERE id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $target_file, $user_id);
                
                if ($stmt->execute()) {
                    $message = "<div class='alert alert-success'>Profile image updated successfully!</div>";
                    // Refresh user data
                    $result = $conn->query("SELECT * FROM users WHERE id='$user_id'");
                    $user = $result->fetch_assoc();
                } else {
                    $message = "<div class='alert alert-danger'>Error updating database: " . $conn->error . "</div>";
                }
                $stmt->close();
            } else {
                $message = "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
            }
        }
    } else {
        $message = "<div class='alert alert-danger'>Error uploading file. Error code: " . $_FILES['profile_image']['error'] . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile Picture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-image-nav {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 15px;
        }
        .profile-preview {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin: 20px 0;
        }
        #imagePreview {
            max-width: 200px;
            max-height: 200px;
            display: none;
            margin: 20px 0;
            border-radius: 50%;
        }
    </style>
</head>

<body>

<header class='bg-dark text-white p-3'>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Assignment Website</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Back to Profile</a></li>
            </ul>
            <img src="<?php echo getProfileImage($user); ?>" 
                 alt="Profile" 
                 class="profile-image-nav">
        </div>
    </nav>
</header>

<main class='container mt-5'>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="card-title">Update Profile Picture</h2>
                    
                    <?php echo $message; ?>

                    <img src="<?php echo getProfileImage($user); ?>" 
                         alt="Current Profile Picture" 
                         class="profile-preview">
                    
                    <img id="imagePreview" alt="Image Preview">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profile_image">Choose New Profile Picture:</label>
                            <input type="file" class="form-control-file" id="profile_image" 
                                   name="profile_image" accept="image/*" onchange="previewImage(this)">
                            <small class="form-text text-muted">
                                Maximum file size: 2MB<br>
                                Allowed formats: JPG, JPEG, PNG, GIF
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile Picture</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class='text-center mt-5 p-3 bg-dark text-white'>
    <p>&copy; 2025 Assignment Website</p>
</footer>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>
</html>