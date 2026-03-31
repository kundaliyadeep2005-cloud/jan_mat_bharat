<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if ($email && $pass) {
        try {
            // Only fetching users where role is 'admin'
            $stmt = $pdo->prepare("SELECT id, name, password, role FROM users WHERE email = ? AND role = 'admin' AND status = 'active'");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($pass, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name']    = $user['name'];
                $_SESSION['role']    = $user['role'];
                
                header("Location: /jan_mat_bharat/admin/index.php");
                exit;
            } else {
                $error = "Invalid admin credentials or account is blocked.";
            }
        } catch (PDOException $e) {
            $error = "Login failed: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all required fields!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Jan Mat Bharat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Using admin specific login styling -->
    <link rel="stylesheet" href="/jan_mat_bharat/css/admin_login.css">
</head>
<body>

<main class="page-wrapper">
    <div class="login-box">
                    
        <h1 class="mb-2">Admin Portal</h1>
        <img src="/jan_mat_bharat/images/ashoka-chakra.png" class="chakra mb-3" alt="Ashoka Chakra">
        <p class="tagline mb-4">Secure Administration</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- LOGIN FORM (Bootstrap Validation) -->
        <form method="POST" novalidate id="adminLoginForm" class="needs-validation">

            <div class="mb-3 text-start">
                <input type="email" class="form-control" id="email" name="email" placeholder="Admin Email" required>
                <div class="invalid-feedback">Please enter valid admin email.</div>
            </div>

            <div class="mb-3 text-start">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <div class="invalid-feedback">Please enter password.</div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-admin">Login to Admin</button>
            </div>

            <p class="link mt-3 pt-2 text-center border-top">
                <a href="/jan_mat_bharat/php/index.php">&larr; Back to Main Site</a>
            </p>
        </form>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Simple Validation
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
</body>
</html>
