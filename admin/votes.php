<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /jan_mat_bharat/admin/login.php");
    exit;
}

// Get total votes
$stmtTotal = $pdo->query("SELECT COUNT(*) FROM votes");
$totalVotes = $stmtTotal->fetchColumn(); $totalVotes = $totalVotes ? $totalVotes : 1; // avoid div by zero

// Get Party wise votes 
$stmtParties = $pdo->query("SELECT party, COUNT(*) as vote_count FROM votes GROUP BY party ORDER BY vote_count DESC");
$partyVotes = $stmtParties->fetchAll(PDO::FETCH_ASSOC);

// Get recent votes
$stmtRecent = $pdo->query("
    SELECT u.name, v.party, v.created_at 
    FROM votes v
    JOIN users u ON v.user_id = u.id
    ORDER BY v.created_at DESC LIMIT 5
");
$recentVotes = $stmtRecent->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Votes | Admin Panel</title>
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
            <h1 class="h3 mb-0 text-gray-800">Vote Monitoring</h1>
        </div>

        <div class="row">
            <!-- VOTING SUMMARY -->
            <div class="col-lg-8">
                <div class="admin-card mb-4">
                    <h5 class="mb-4">Live Party Voting Status</h5>
                    
                    <?php 
                    $colors = ['bg-success', 'bg-primary', 'bg-warning', 'bg-info', 'bg-danger'];
                    $c = 0;
                    foreach($partyVotes as $pv): 
                        $percentage = round(($pv['vote_count'] / $totalVotes) * 100, 1);
                        $colorClass = $colors[$c % count($colors)];
                        $c++;
                    ?>
                    <div class="proposal-item">
                        <div class="d-flex justify-content-between mb-2">
                            <strong><?php echo htmlspecialchars($pv['party']); ?></strong>
                            <span><?php echo $percentage; ?>% (<?php echo number_format($pv['vote_count']); ?> Votes)</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar <?php echo $colorClass; ?>" role="progressbar" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                        <small class="text-muted">Status: Active</small>
                    </div>
                    <?php endforeach; ?>
                    <?php if(empty($partyVotes)): ?>
                        <p class="text-muted text-center pt-3">No votes cast yet.</p>
                    <?php endif; ?>

                </div>
            </div>

            <!-- RECENT INDIVIDUAL VOTES -->
            <div class="col-lg-4">
                <div class="admin-card">
                    <h5 class="mb-4">Recent Activity Feed</h5>
                    <div class="list-group list-group-flush">
                        <?php foreach($recentVotes as $rv): ?>
                        <div class="list-group-item px-0">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?php echo htmlspecialchars($rv['name']); ?></h6>
                                <small class="text-success">Voted</small>
                            </div>
                            <p class="mb-1 text-muted small">Voted for: <?php echo htmlspecialchars($rv['party']); ?></p>
                            <small class="text-muted"><?php echo date('d M Y, h:i A', strtotime($rv['created_at'])); ?></small>
                        </div>
                        <?php endforeach; ?>
                        <?php if(empty($recentVotes)): ?>
                            <p class="text-muted text-center pt-3">No recent activity.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
