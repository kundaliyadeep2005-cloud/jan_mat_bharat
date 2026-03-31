<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /jan_mat_bharat/admin/login.php");
    exit;
}

// Stats
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
$totalVotes = $pdo->query("SELECT COUNT(*) FROM votes")->fetchColumn();
$totalParties = $pdo->query("SELECT COUNT(DISTINCT party) FROM votes")->fetchColumn(); 

// Recent
$recentRegistrations = $pdo->query("SELECT name, email, state, created_at FROM users WHERE role = 'user' ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="/jan_mat_bharat/css/admin.css">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/admin_sidebar.php"; ?>

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
        </div>

        <!-- STATS CARDS -->
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="admin-card">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalUsers); ?></div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="admin-card">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Votes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalVotes); ?></div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="admin-card">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Parties</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalParties; ?></div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- RECENT ACTIVITY TABLE -->
            <div class="col-12">
                <div class="admin-card">
                    <h5 class="mb-4">Recent Registration Activity</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>State</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recentRegistrations as $reg): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($reg['name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($reg['email']); ?></td>
                                    <td><?php echo htmlspecialchars($reg['state']); ?></td>
                                    <td><?php echo date('d M Y, h:i A', strtotime($reg['created_at'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if(empty($recentRegistrations)): ?>
                                <tr><td colspan="4" class="text-center">No recent registrations</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="users.php" class="btn btn-sm btn-outline-primary">View All Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
