<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/jan_mat_bharat/includes/db_connect.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /jan_mat_bharat/admin/login.php");
    exit;
}

// Admin Site Settings Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site Settings | Admin Panel</title>
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
            <h1 class="h3 mb-0 text-gray-800">Site Settings</h1>
            <button class="btn btn-success px-4">Save All Changes</button>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- GENERAL SETTINGS -->
                <div class="admin-card mb-4">
                    <h5 class="mb-4">General Configuration</h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Website Name</label>
                            <input type="text" class="form-control" value="Jan Mat Bharat">
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Site Tagline</label>
                            <input type="text" class="form-control" value="Your Vote • Your Right • Your Future">
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Hero Text (Hindi)</label>
                            <input type="text" class="form-control" value="जन-मत भारत">
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Hero Quote (Hindi)</label>
                            <input type="text" class="form-control" value="“मतदान राष्ट्र सेवा का पहला कदम है”">
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
