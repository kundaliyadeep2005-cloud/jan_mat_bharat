<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /jan_mat_bharat/admin/login.php");
    exit;
}

$stmt = $pdo->query("SELECT id, name, email, dob, state, created_at, status FROM users WHERE role = 'user' ORDER BY id DESC");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users | Admin Panel</title>
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
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        </div>

        <div class="admin-card">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>DOB</th>
                            <th>State</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td>#<?php echo $user['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($user['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($user['dob'])); ?></td>
                            <td><?php echo htmlspecialchars($user['state']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <!-- Placeholder Edit button, requires edit page -->
                                <button class="btn btn-sm btn-outline-secondary" onclick="alert('Feature coming soon')">Edit</button>
                                <?php if ($user['status'] === 'active'): ?>
                                    <button onclick="alert('Block feature coming soon')" class="btn btn-sm btn-outline-danger">Block</button>
                                <?php else: ?>
                                    <button onclick="alert('Unblock feature coming soon')" class="btn btn-sm btn-outline-success">Unblock</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($users)): ?>
                        <tr><td colspan="7" class="text-center">No users found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation" class="mt-4">
               
            </nav>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
