<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /jan_mat_bharat/php/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$hasVoted = false;
$message = "";

// Check if already voted
$stmt = $pdo->prepare("SELECT party FROM votes WHERE user_id = ?");
$stmt->execute([$user_id]);
if ($stmt->rowCount() > 0) {
    $hasVoted = true;
    $votedFor = $stmt->fetchColumn();
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['party']) && !$hasVoted) {
    $party = $_POST['party'];
    try {
        $stmt = $pdo->prepare("INSERT INTO votes (user_id, party) VALUES (?, ?)");
        $stmt->execute([$user_id, $party]);
        $hasVoted = true;
        $votedFor = $party;
        $message = "Your vote has been successfully cast!";
    } catch (PDOException $e) {
        $message = "Error casting vote: " . $e->getMessage();
    }
}

include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; 
?>

<link rel="stylesheet" href="/jan_mat_bharat/css/vote.css">

<?php if ($message): ?>
    <div class="alert alert-success text-center mt-3" style="max-width: 600px; margin: 0 auto;"><?= $message ?></div>
<?php endif; ?>

<?php if ($hasVoted): ?>
    <section class="vote-hero">
        <h1>Thank You!</h1>
        <p>You have completed your civic duty.</p>
    </section>
    <section class="vote-section text-center" style="min-height: 40vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h3 class="mb-4">You have already cast your vote.</h3>
        <p class="mb-4" style="font-size: 1.2rem;">You voted for: <strong style="color: #138808; background: #fff; padding: 5px 10px; border-radius: 5px;"><?= htmlspecialchars($votedFor) ?></strong></p>
        <a href="/jan_mat_bharat/php/results.php" class="btn btn-primary btn-lg mt-3" style="background-color: var(--primary-color); border: none;">View Live Results</a>
    </section>
<?php else: ?>

<!-- HERO STRIP -->
<section class="vote-hero">
    <h1>Cast Your Vote</h1>
    <p>Your Voice • Your Power • Your Bharat</p>
</section>

<!-- PARTY SELECTION -->
<section class="vote-section" id="vote-area">
    <h2>Select Your Preferred Party</h2>

    <div class="party-grid">

        <div class="vote-card" onclick="selectParty('Bharatiya Janata Party')">
            <img src="/jan_mat_bharat/images/bjp.png" alt="Bharatiya Janata Party Symbol">
            <h3>Bharatiya Janata Party</h3>
            <p class="tag">Development • Nationalism</p>
        </div>

        <div class="vote-card" onclick="selectParty('Indian National Congress')">
            <img src="/jan_mat_bharat/images/ins.webp" alt="Indian National Congress Symbol">
            <h3>Indian National Congress</h3>
            <p class="tag">Equality • Democracy</p>
        </div>

        <div class="vote-card" onclick="selectParty('Aam Aadmi Party')">
            <img src="/jan_mat_bharat/images/aap.webp" alt="Aam Aadmi Party Symbol">
            <h3>Aam Aadmi Party</h3>
            <p class="tag">Education • Transparency</p>
        </div>

        <div class="vote-card" onclick="selectParty('Communist Party of India')">
            <img src="/jan_mat_bharat/images/comunist.png" alt="Communist Party of India Symbol">
            <h3>Communist Party of India</h3>
            <p class="tag">Workers • Welfare</p>
        </div>

        <div class="vote-card" onclick="selectParty('Trinamool Congress')">
            <img src="/jan_mat_bharat/images/trinamool.jpg" alt="Trinamool Congress Symbol">
            <h3>Trinamool Congress</h3>
            <p class="tag">Grassroots • Secularism</p>
        </div>

        <div class="vote-card" onclick="selectParty('Bahujan Samaj Party')">
            <img src="/jan_mat_bharat/images/bsp.webp" alt="Bahujan Samaj Party Symbol">
            <h3>Bahujan Samaj Party</h3>
            <p class="tag">Social Justice • Equality</p>
        </div>

        <div class="vote-card nota" onclick="selectParty('NOTA')">
            <h3>None of the Above</h3>
            <p class="tag">NOTA</p>
        </div>

    </div>
</section>

<!-- CONFIRMATION BOX -->
<section class="vote-section confirm-box">
    <h3>Your Selection:</h3>
    <p id="selectedParty">No party selected</p>

    <p class="warning">
         Once submitted, your vote cannot be changed.
    </p>

        <form id="voteForm" method="POST" style="display: none;">
            <input type="hidden" name="party" id="hiddenPartyInput">
        </form>

    <button onclick="submitVote()">✅ Submit My Vote</button>
</section>

<p class="thankyou">🇮🇳 Thank you for strengthening Indian democracy.</p>

<!-- Load Script -->
<script src="/jan_mat_bharat/js/vote.js?v=2"></script>

<?php endif; // End check for $hasVoted ?>


<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
