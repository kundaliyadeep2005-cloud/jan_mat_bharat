<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /jan_mat_bharat/php/login.php");
    exit;
}

$resultsPublished = true;

// Get total votes
$stmtTotal = $pdo->query("SELECT COUNT(*) FROM votes");
$totalVotes = $stmtTotal->fetchColumn();

// Get Party wise votes
$stmtParties = $pdo->query("SELECT party, COUNT(*) as vote_count FROM votes GROUP BY party ORDER BY vote_count DESC");
$partyVotes = $stmtParties->fetchAll(PDO::FETCH_ASSOC);

$allParties = [
    'Bharatiya Janata Party' => ['tag' => 'BJP', 'img' => 'voting1.jpg'],
    'Indian National Congress' => ['tag' => 'INC', 'img' => 'voting1.jpg'],
    'Aam Aadmi Party' => ['tag' => 'AAP', 'img' => 'voting1.jpg'],
    'Communist Party of India' => ['tag' => 'CPI', 'img' => 'voting1.jpg'],
    'Trinamool Congress' => ['tag' => 'TMC', 'img' => 'voting1.jpg'],
    'Bahujan Samaj Party' => ['tag' => 'BSP', 'img' => 'voting1.jpg'],
    'NOTA' => ['tag' => 'NOTA', 'img' => '']
];

$partyResults = [];
foreach ($allParties as $p => $meta) {
    $partyResults[$p] = [
        'count' => 0,
        'tag' => $meta['tag'],
        'img' => $meta['img']
    ];
}

foreach ($partyVotes as $pv) {
    // some legacy or unknown party check just in case
    if (isset($partyResults[$pv['party']])) {
        $partyResults[$pv['party']]['count'] = $pv['vote_count'];
    } else {
        $partyResults[$pv['party']] = [
            'count' => $pv['vote_count'],
            'tag' => 'OTHER',
            'img' => ''
        ];
    }
}

// Sort by count
uasort($partyResults, function($a, $b) {
    return $b['count'] <=> $a['count'];
});

include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; 
?>

<link rel="stylesheet" href="/jan_mat_bharat/css/results.css">

<!-- HERO STRIP -->
<section class="results-hero">
    <h1>Election Results</h1>
    <p>Live Voting Statistics • जन-मत भारत 🇮🇳</p>
</section>

<?php 
// CHECK: If results have NOT been published yet ($resultsPublished is false)
if (!$resultsPublished): 
?>
    <!-- 1. SHOW "COMING SOON" MESSAGE -->
    <section class="results-section">
        <div class="coming-soon-card">
            <h2> Results Coming Soon</h2>
            <p>Voting is currently in progress. Results will be declared after the voting period ends.</p>
            <p class="date-info">Expected Declaration: <strong>To Be Announced</strong></p>
            <a href="/jan_mat_bharat/php/vote.php" class="vote-now-btn">Cast Your Vote Now</a>
        </div>
    </section>

<?php 
// ELSE: If results ARE published
else: 
?>

<!-- 2. SHOW ACTUAL RESULTS -->

<!-- TOTAL VOTES CARD -->
<section class="results-section">
    <div class="total-votes-card">
        <h2>Total Votes Cast</h2>
        <p class="total-count"><?php echo number_format($totalVotes); ?></p>
        <?php 
            $userStmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role='user'");
            $totalUsers = $userStmt->fetchColumn();
            $turnout = ($totalUsers > 0) ? round(($totalVotes / $totalUsers) * 100, 1) : 0;
        ?>
        <p class="subtitle">Voter Turnout: <?php echo $turnout; ?>%</p>
    </div>
</section>

<!-- RESULTS TABLE -->
<section class="results-section">
    <h2>Party-wise Results</h2>

    <div class="results-container">

        <?php foreach ($partyResults as $partyName => $data): 
            $percentage = ($totalVotes > 0) ? round(($data['count'] / $totalVotes) * 100, 1) : 0;
            $isNota = ($partyName === 'NOTA');
        ?>
        <div class="result-card <?php echo $isNota ? 'nota-card' : ''; ?>">
            <div class="party-info">
                <?php if (!$isNota && $data['img']): ?>
                    <img src="/jan_mat_bharat/images/<?php echo htmlspecialchars($data['img']); ?>" alt="<?php echo htmlspecialchars($data['tag']); ?>">
                <?php endif; ?>
                <div>
                    <h3><?php echo htmlspecialchars($partyName); ?></h3>
                    <p class="tag"><?php echo htmlspecialchars($data['tag']); ?></p>
                </div>
            </div>
            <div class="vote-stats">
                <div class="vote-count"><?php echo number_format($data['count']); ?> votes</div>
                <div class="progress-bar">
                    <div class="progress-fill <?php echo $isNota ? 'nota-fill' : ''; ?>" style="width: <?php echo $percentage; ?>%"></div>
                </div>
                <div class="percentage"><?php echo $percentage; ?>%</div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<p class="disclaimer">
    📌 Results are updated in real-time. Last updated: <?php echo date('d M Y, h:i A'); ?>
</p>

<?php endif; ?>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
