# User Management System

A comprehensive PHP-based web application for user management with secure authentication, profile handling, and media uploads.

## Features

### User Authentication
- Secure login/registration system
- Password hashing using PHP's native password_hash()
- Session-based authentication
- Remember me functionality
- Password reset capability

### Profile Management
- Personal information updates
- Profile picture upload/update
- Account deletion
- Phone number verification
- Email management

### Security Features
- CSRF protection
- XSS prevention
- SQL injection protection
- Input sanitization
- Secure file upload handling
- Rate limiting
- Session security


### UI/UX Features
- Responsive Bootstrap design
- Modern gradient backgrounds
- Interactive navigation
- Form validation
- Image preview
- Toast notifications
- Loading indicators

## Technical Requirements

### Server Requirements
- PHP 7.4+ (8.0+ recommended)
- MySQL 5.7+ or MariaDB 10.2+
- Apache 2.4+ or Nginx 1.18+
- mod_rewrite enabled
- PHP Extensions:
  - PDO
  - GD Library
  - FileInfo
  - Session
  - JSON
  - MySQL
  - mbstring

### Client Requirements
- Modern web browser with JavaScript enabled
- Minimum screen resolution: 320px width
- Cookie support enabled

## Installation

1. **Database Setup**
```sql
CREATE DATABASE user_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255),
    reset_token VARCHAR(255),
    reset_token_expiry DATETIME,
    last_login DATETIME,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_reset_token (reset_token)
);
```

2. **File Structure Setup**
```plaintext
project_root/
├── config/
│   ├── config.php
│   └── database.php
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── uploads/
├── includes/
│   ├── functions.php
│   └── auth.php
├── templates/
│   ├── header.php
│   └── footer.php
├── index.php
├── login.php
├── register.php
├── profile.php
├── update_image.php
├── logout.php
└── README.md
```

3. **Configuration**
```php
// config/config.php
define('DB_HOST', 'localhost:3307');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'user_management');
define('SITE_URL', 'http://your-domain.com');
define('UPLOAD_DIR', __DIR__ . '/public/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
```

4. **Directory Permissions**
```bash
chmod 755 public/uploads
chmod 644 config/config.php
```

## Usage Examples

### User Registration
```php
// register.php
$user = new User();
$result = $user->register([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'liza@example.com',
    'password' => '1234525!'
]);
```

### Profile Update
```php
// profile.php
$profile = new Profile();
$result = $profile->update([
    'user_id' => $_SESSION['user_id'],
    'first_name' => 'liza',
    'last_name' => 'basnet',
    'phone' => '83747634'
]);
```

### Image Upload
```php
// update_image.php
$uploader = new ImageUploader();
$result = $uploader->upload($_FILES['profile_image'], [
    'max_size' => 5 * 1024 * 1024,
    'allowed_types' => ['image/jpeg', 'image/png', 'image/gif']
]);
```

## API Endpoints

### Authentication
- POST `/api/register` - User registration
- POST `/api/login` - User login
- POST `/api/logout` - User logout
- POST `/api/reset-password` - Password reset

### Profile
- GET `/api/profile` - Get user profile
- PUT `/api/profile` - Update profile
- POST `/api/profile/image` - Upload profile image
- DELETE `/api/profile` - Delete account

## Security Recommendations

1. **Server Configuration**
```apache
# .htaccess
<IfModule mod_headers.c>
    Header set X-XSS-Protection "1; mode=block"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-Content-Type-Options "nosniff"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>
```

2. **PHP Configuration**
```ini
; php.ini
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_strict_mode = 1
```

## Error Handling

```php
try {
    // Database operations
} catch (PDOException $e) {
    error_log($e->getMessage());
    return ['error' => 'Database error occurred'];
}
```

## Testing

1. **PHPUnit Tests**
```bash
composer require phpunit/phpunit
./vendor/bin/phpunit tests/
```

2. **Test Cases**
- User registration validation
- Login authentication
- Profile updates
- Image upload restrictions
- Security measures

## Deployment



1. **Performance Optimization**
- Enable PHP OPcache
- Configure MySQL query cache
- Implement browser caching
- Compress static assets



## Contributing Guidelines

1. **Code Style**
- Follow PSR-12 coding standards
- Use meaningful variable names
- Comment complex logic
- Write unit tests

2. **Pull Request Process**
- Fork the repository
- Create feature branch
- Commit changes
- Push to branch
- Submit PR

## License

MIT License

Copyright (c) 2025 Assignment Website

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files.

## Changelog

### Version 1.0.0
- Initial release
- Basic authentication
- Profile management
- Image upload

### Version 1.1.0
- Improved security
- UI/UX enhancements
