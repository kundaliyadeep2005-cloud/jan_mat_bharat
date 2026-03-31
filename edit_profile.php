<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /jan_mat_bharat/php/login.php");
    exit;
}

$message = "";
$error = "";
$user_id = $_SESSION['user_id'];

// Initial Fetch
$stmt = $pdo->prepare("SELECT name, email, dob, state FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $dob     = trim($_POST['dob']);
    $state   = trim($_POST['state']);
    
    if ($name && $email && $dob && $state) {
        // Check if email belongs to someone else
        $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $checkEmail->execute([$email, $user_id]);
        if ($checkEmail->rowCount() > 0) {
            $error = "Email address is already taken by another user!";
        } else {
            // Update
            $update = $pdo->prepare("UPDATE users SET name = ?, email = ?, dob = ?, state = ? WHERE id = ?");
            if ($update->execute([$name, $email, $dob, $state, $user_id])) {
                $message = "Profile updated successfully 🇮🇳";
                $_SESSION['name'] = $name;
                // Refresh local variables
                $user['name'] = $name;
                $user['email'] = $email;
                $user['dob'] = $dob;
                $user['state'] = $state;
            } else {
                $error = "Failed to update profile.";
            }
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; ?>

<link rel="stylesheet" href="/jan_mat_bharat/css/edit_profile.css">

<div class="page-content">
    <div class="edit-profile-box">
                    
        <h1 class="mb-2">Edit Profile</h1>
        <img src="/jan_mat_bharat/images/ashoka-chakra.png" class="chakra mb-3" alt="Ashoka Chakra">
        <p class="tagline mb-4">जन-मत भारत</p>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <!-- EDIT PROFILE FORM (Bootstrap Validation) -->
        <form method="POST" novalidate id="editProfileForm">

            <div class="mb-3 text-start">
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?php echo htmlspecialchars($user['name']); ?>">
                <div class="invalid-feedback" id="nameErr"></div>
            </div>

            <div class="mb-3 text-start">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($user['email']); ?>">
                <div class="invalid-feedback" id="emailErr"></div>
            </div>

            <div class="mb-3 text-start">
                <label for="dob" class="form-label ms-1" style="font-size: 0.9rem; color: #666;">Date of Birth (18+)</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>">
                <div class="invalid-feedback" id="dobErr"></div>
            </div>

            <div class="mb-3 text-start">
                <select class="form-select form-control" id="state" name="state">
                    <option value="" disabled>Select State</option>
                    <?php 
                    $states = [
                        "Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", 
                        "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli and Daman and Diu", "Delhi", "Goa", 
                        "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", 
                        "Kerala", "Ladakh", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", 
                        "Mizoram", "Nagaland", "Odisha", "Puducherry", "Punjab", "Rajasthan", "Sikkim", 
                        "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
                    ];
                    foreach($states as $st) {
                        $selected = ($user['state'] === $st) ? "selected" : "";
                        echo "<option value=\"$st\" $selected>$st</option>";
                    }
                    ?>
                </select>
                <div class="invalid-feedback" id="stateErr"></div>
            </div>

            <!-- Optional Change Password field could go here, omitting for simplicity unless requested -->

            <div class="d-grid gap-2 mt-4">
                <button type="submit">Update Profile</button>
            </div>

            <p class="cancel-link mt-3">
                <a href="index.php">Cancel</a>
            </p>
        </form>

    </div>
</div>

<!-- Load Script at the end to ensure elements exist -->
<script src="/jan_mat_bharat/js/edit_profile.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
