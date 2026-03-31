<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; 
?>

<link rel="stylesheet" href="/jan_mat_bharat/css/about.css">
<link rel="stylesheet" href="/jan_mat_bharat/css/contact.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- HERO SECTION (Same as About Page) -->
<section class="info-hero">
    <h1>Contact Jan-Mat Bharat</h1>
    <p>Your Voice • Your Power • Your Democracy 🇮🇳</p>
</section>

<!-- CONTACT CONTENT -->
<section class="info-section">
    <div class="info-container contact-details">
        
        <!-- Welcome Note -->
        <div class="info-card">
            <h2>📞 Get In Touch</h2>
            <p>We are here to support every citizen of Bharat. If you have any questions or need assistance, please reach out to us through the channels below.</p>
        </div>

        <!-- Contact Methods -->
        <div class="info-card">
            <i class="bi bi-geo-alt contact-icon"></i>
            <h3>Our Office</h3>
            <p>123 Sansad Marg, New Delhi, India</p>
        </div>

        <div class="info-card">
            <i class="bi bi-telephone contact-icon"></i>
            <h3>Phone Number</h3>
            <p>1800-456-7890 (Toll-Free Support)</p>
        </div>

        <div class="info-card">
            <i class="bi bi-envelope contact-icon"></i>
            <h3>Email Address</h3>
            <p>support@janmatbharat.in</p>
        </div>

    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
