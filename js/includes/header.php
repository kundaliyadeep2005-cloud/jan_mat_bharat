<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>जन-मत भारत</title>

    <link rel="stylesheet" href="/jan_mat_bharat/css/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* OVERRIDE BOOTSTRAP TO MATCH ORIGINAL DESIGN */
        .navbar-custom {
            /* Original Linear Gradient */
            background: linear-gradient(to right, #ff9933, #ffffff, #138808) !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 40px; /* Match original padding */
        }

        .navbar-brand-custom {
            font-size: 26px;
            font-weight: bold;
            color: #0A3D62 !important; /* Original Text Color */
        }
        
        /* Links in Desktop View */
        .nav-link-custom {
            color: #000 !important;
            font-size: 15px;
            font-weight: 500;
            margin: 0 10px;
        }

        .nav-link-custom:hover {
            text-decoration: underline;
            color: #000 !important;
        }

        .nav-link-custom.active {
            background-color: #138808;
            color: #fff !important;
            border-radius: 4px;
            font-weight: 600;
        }

        /* Mobile Toggle Icon - Make it dark because background is light */
        .navbar-toggler {
            border-color: rgba(0,0,0,0.5);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

      
    </style>
</head>
<body>

<!-- NAVBAR (Bootstrap 5 Structure + Custom Design) -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand navbar-brand-custom" href="/jan_mat_bharat/php/index.php">जन-मत भारत</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" aria-current="page" href="/jan_mat_bharat/php/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/about.php">About</a>
            </li>
             <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/contact.php">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'vote.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/vote.php">Add Vote</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'results.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/results.php">Results</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link nav-link-custom <?php echo ($current_page == 'edit_profile.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/edit_profile.php">Edit Profile</a>
            </li>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link nav-link-custom text-primary" href="/jan_mat_bharat/admin/index.php">Admin Panel</a>
            </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link nav-link-custom btn-login-custom ms-2" href="/jan_mat_bharat/php/logout.php" style="background-color: #dc3545; color: white !important; border-radius: 4px; padding: 5px 15px;">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/about.php">About</a>
            </li>
             <li class="nav-item">
              <a class="nav-link nav-link-custom <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/contact.php">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom <?php echo ($current_page == 'register.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom btn-login-custom ms-2 <?php echo ($current_page == 'login.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/php/login.php">Login</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
