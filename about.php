<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/header.php"; 
?>

<link rel="stylesheet" href="/jan_mat_bharat/css/about.css">

<!-- 
    HERO SECTION
-->
<section class="info-hero">
    <h1>About Jan-Mat Bharat</h1>
    <p>Your Voice • Your Power • Your Democracy 🇮🇳</p>
</section>

<!-- 
    ABOUT CONTENT
-->
<section class="info-section">
    <div class="info-container">
        
        <!-- Mission Statement -->
        <div class="info-card">
            <h2>🎯 Our Mission</h2>
            <p>Jan-Mat Bharat is a digital voting platform designed to make democracy accessible, transparent, and secure for every Indian citizen. We believe that every vote matters and every voice deserves to be heard.</p>
        </div>

        <!-- Features List -->
        <div class="info-card">
            <h2>💡 What We Do</h2>
            <p>We provide a simple, secure, and user-friendly platform where citizens can:</p>
            <ul>
                <li>Register as voters with verified credentials</li>
                <li>Cast their votes securely and confidentially</li>
                <li>View real-time election results</li>
                <li>Participate in strengthening Indian democracy</li>
            </ul>
        </div>

        <!-- Benefits of Digital Voting -->
        <div class="info-card">
            <h2>🌐 Why Digital Voting?</h2>
            <p>Digital voting platforms offer several advantages:</p>
            <ul>
                <li><strong>Convenience:</strong> Vote from anywhere, anytime</li>
                <li><strong>Speed:</strong> Instant vote counting and results</li>
                <li><strong>Accuracy:</strong> Eliminates manual counting errors</li>
                <li><strong>Cost-Effective:</strong> Reduces election expenses</li>
                <li><strong>Eco-Friendly:</strong> Paperless voting process</li>
            </ul>
        </div>

        <!-- Contact Information -->
        <div class="info-card contact-card">
            <h2>Contact Us</h2>
            <p><strong>Email:</strong> support@janmatbharat.in</p>
            <p><strong>Phone:</strong> 1800-XXX-XXXX (Toll-Free)</p>
            <p><strong>Address:</strong> New Delhi, India</p>
        </div>

    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/footer.php"; ?>
