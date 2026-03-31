<!-- admin_sidebar.php -->
<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <h4 class="m-0 text-white">Jan Mat Bharat</h4>
        <small class="text-white-50">Admin Panel</small>
    </div>
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/admin/index.php">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'users.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/admin/users.php">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'votes.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/admin/votes.php">
                <i class="bi bi-box-seam me-2"></i> Votes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'settings.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/admin/settings.php">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'add_admin.php') ? 'active' : ''; ?>" href="/jan_mat_bharat/admin/add_admin.php">
                <i class="bi bi-person-plus me-2"></i> Add Admin
            </a>
        </li>
        <li class="nav-item mt-5 pt-3 border-top border-secondary">
            <a class="nav-link text-warning" href="/jan_mat_bharat/admin/logout.php">
                <i class="bi bi-box-arrow-left me-2"></i> Exit Admin
            </a>
        </li>
    </ul>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
