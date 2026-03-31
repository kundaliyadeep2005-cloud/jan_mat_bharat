<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if ($email && $pass) {
        try {
            $stmt = $pdo->prepare("SELECT id, name, password, role FROM users WHERE email = ? AND status = 'active'");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($pass, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name']    = $user['name'];
                $_SESSION['role']    = $user['role'];
                
                if ($user['role'] === 'admin') {
                    header("Location: /jan_mat_bharat/admin/index.php");
                } else {
                    header("Location: /jan_mat_bharat/php/index.php");
                }
                exit;
            } else {
                $error = "Invalid email or password, or account is blocked.";
            }
        } catch (PDOException $e) {
            $error = "Login failed: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all required fields!";
    }
}
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; ?>

<!-- LOGIN SPECIFIC CSS/JS -->
<link rel="stylesheet" href="/jan_mat_bharat/css/login.css">
<script src="/jan_mat_bharat/js/login.js" defer></script>

<!-- 
    Using 'page-wrapper' and 'login-box' from login.css to keep original design 
    But using Bootstrap classes inside the form for validation
-->
<main class="page-wrapper">
    <div class="login-box">
                    
        <h1 class="mb-2">जन-मत भारत</h1>
        <img src="/jan_mat_bharat/images/ashoka-chakra.png" class="chakra mb-3" alt="Ashoka Chakra">
        <p class="tagline mb-4">लोकतंत्र की शक्ति</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- LOGIN FORM (Bootstrap Validation) -->
        <form method="POST" novalidate id="loginForm">

            <div class="mb-3 text-start">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                <div class="invalid-feedback" id="emailErr"></div>
            </div>

            <div class="mb-3 text-start">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <div class="invalid-feedback" id="passErr"></div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit">Login</button>
            </div>

            <p class="link mt-3">
                New voter? <a href="register.php">Register here</a>
            </p>

            <p class="link mt-2 pt-3 border-top text-center" style="font-size: 13px;">
                <a href="/jan_mat_bharat/admin/login.php" class="text-muted text-decoration-none">Admin Login &rarr;</a>
            </p>
        </form>

    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
