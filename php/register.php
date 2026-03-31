<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $dob     = trim($_POST['dob']);
    $state   = trim($_POST['state']);
    $pass    = $_POST['password'];

    if ($name && $email && $dob && $state && $pass) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $error = "Email is already registered! Please login.";
            } else {
                $hashed = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, dob, state, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, $dob, $state, $hashed]);
                $message = "Registration completed successfully 🇮🇳. You can now login.";
            }
        } catch (PDOException $e) {
            $error = "Registration failed: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all required fields!";
    }
}
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; ?>

<link rel="stylesheet" href="/jan_mat_bharat/css/register.css">


<div class="page-content">
    <div class="register-box">
                    
        <h1 class="mb-2">जन-मत भारत</h1>
        <img src="/jan_mat_bharat/images/ashoka-chakra.png" class="chakra mb-3" alt="Ashoka Chakra">
        <p class="tagline mb-4">आपका वोट • आपकी आवाज़</p>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <!-- REGISTRATION FORM (Bootstrap Validation) -->
        <form method="POST" novalidate id="registerForm">

            <div class="mb-3 text-start">
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                <div class="invalid-feedback" id="nameErr"></div>
            </div>

            <div class="mb-3 text-start">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                <div class="invalid-feedback" id="emailErr"></div>
            </div>

            <div class="mb-3 text-start">
                <label for="dob" class="form-label ms-1" style="font-size: 0.9rem; color: #666;">Date of Birth (18+)</label>
                <input type="date" class="form-control" id="dob" name="dob">
                <div class="invalid-feedback" id="dobErr"></div>
            </div>

            <div class="mb-3 text-start">
                <select class="form-select form-control" id="state" name="state">
                    <option value="" selected disabled>Select State</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Ladakh">Ladakh</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                </select>
                <div class="invalid-feedback" id="stateErr"></div>
            </div>

            <div class="mb-3 text-start">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <div class="invalid-feedback" id="passErr"></div>
            </div>

            <div class="mb-3 text-start">
                <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password">
                <div class="invalid-feedback" id="cpassErr"></div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit">Register</button>
            </div>

            <p class="login-link mt-3">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </form>

    </div>
</div>

<!-- Load Script at the end to ensure elements exist -->
<script src="/jan_mat_bharat/js/register.js?v=3"></script>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
