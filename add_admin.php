<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

// Check if user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /jan_mat_bharat/admin/login.php");
    exit;
}

$msg = '';
$msgType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name && $email && $password) {
        try {
            // Check if email already exists
            $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $checkStmt->execute([$email]);
            
            if ($checkStmt->rowCount() > 0) {
                $msg = 'Email is already registered!';
                $msgType = 'danger';
            } else {
                // Hash password
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                
                // Defaults for a generic admin (dob and state are required by original schema, we use dummy values or we can ask for them)
                // Using 1970-01-01 and 'N/A' as defaults since admins might not need these fields strictly defined.
                $insertStmt = $pdo->prepare("INSERT INTO users (name, email, dob, state, password, role) VALUES (?, ?, ?, ?, ?, ?)");
                $insertStmt->execute([$name, $email, '1970-01-01', 'N/A', $hashedPass, 'admin']);
                
                $msg = 'New administrator successfully added!';
                $msgType = 'success';
            }
        } catch (PDOException $e) {
            $msg = 'Database error: ' . $e->getMessage();
            $msgType = 'danger';
        }
    } else {
        $msg = 'Please complete all required fields.';
        $msgType = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admin | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/jan_mat_bharat/css/admin.css">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/admin_sidebar.php"; ?>

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Administrator</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- ADD ADMIN FORM -->
                <div class="admin-card mb-4">
                    <h5 class="mb-4">Administrator Details</h5>
                    
                    <?php if ($msg): ?>
                        <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. John Doe">
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" required placeholder="e.g. newadmin@janmatbharat.com">
                        </div>
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Strong Password">
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Create Admin Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
