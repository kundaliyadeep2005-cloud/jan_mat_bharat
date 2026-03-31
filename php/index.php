<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /jan_mat_bharat/php/login.php");
    exit;
}
include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; 
?>
<link rel="stylesheet" href="/jan_mat_bharat/css/style.css">

<!--   HERO SECTION -->
<section class="hero"></section>

<!-- HERO TEXT .-->

<section class="section hero-text-section">
    <h1>जन-मत भारत</h1>
    <p class="hero-line">• Your Vote • Your Right • Your Future</p>
    <p class="hero-hindi">“मतदान राष्ट्र सेवा का पहला कदम है”</p>
</section>

<!-- INTRO -->
<section class="section intro-section">
    <p class="intro-text">
        मतदान सरल, सशक्त और महत्वपूर्ण है।<br>
        एक वोट भविष्य को आकार देता है।
    </p>
</section>

<!--POLITICAL PARTIES -->
<section class="section light">
    <h2>Recognized Political Parties</h2>

    <div class="party-card-container">
        <div class="party-card">
            <img src="/jan_mat_bharat/images/bjp.png" alt="Bharatiya Janata Party">
            <h3>Bharatiya Janata Party</h3>
            <p>Focuses on nationalism, development, and governance.</p>
        </div>

        <div class="party-card">
            <img src="/jan_mat_bharat/images/ins.webp" alt="Indian National Congress">
            <h3>Indian National Congress</h3>
            <p>Emphasizes social justice, equality, and democracy.</p>
        </div>

        <div class="party-card">
            <img src="/jan_mat_bharat/images/aap.webp" alt="Aam Aadmi Party">
            <h3>Aam Aadmi Party</h3>
            <p>Works for transparency, education, and public welfare.</p>
        </div>
    </div>
</section>

<!--    WHY VOTE SECTION -->
<section class="section light" id="whyvote">
    <h2>Why Voting Matters</h2>

    <div class="points-container">
        <div class="point">
            <h3>Strong Leadership</h3>
            <p>Elect leaders who serve the people.</p>
        </div>

        <div class="point">
            <h3>Equal Power</h3>
            <p>Every citizen’s vote has equal value.</p>
        </div>

        <div class="point">
            <h3>Nation Building</h3>
            <p>Your vote strengthens Bharat.</p>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>