<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../includes/functions.php';
requireAdminLogin();
$currentAdminPage = $currentAdminPage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= sanitize($pageTitle ?? 'Admin') ?> | ViSaTech Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body class="admin-body">
<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <h4>ViSa<span class="text-primary">Tech</span></h4>
            <small>Admin Panel</small>
        </div>
        <nav class="admin-nav">
            <a href="dashboard.php" class="admin-nav-link <?= $currentAdminPage === 'dashboard' ? 'active' : '' ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="messages.php" class="admin-nav-link <?= $currentAdminPage === 'messages' ? 'active' : '' ?>"><i class="bi bi-envelope"></i> Messages <?php $u = getUnreadMessagesCount(); if ($u): ?><span class="badge bg-primary ms-auto"><?= $u ?></span><?php endif; ?></a>
            <a href="projects.php" class="admin-nav-link <?= $currentAdminPage === 'projects' ? 'active' : '' ?>"><i class="bi bi-briefcase"></i> Projects</a>
            <a href="testimonials.php" class="admin-nav-link <?= $currentAdminPage === 'testimonials' ? 'active' : '' ?>"><i class="bi bi-chat-quote"></i> Testimonials</a>
            <a href="services.php" class="admin-nav-link <?= $currentAdminPage === 'services' ? 'active' : '' ?>"><i class="bi bi-grid"></i> Services</a>
            <a href="blog.php" class="admin-nav-link <?= $currentAdminPage === 'blog' ? 'active' : '' ?>"><i class="bi bi-journal-text"></i> Blog</a>
            <a href="careers.php" class="admin-nav-link <?= $currentAdminPage === 'careers' ? 'active' : '' ?>"><i class="bi bi-person-badge"></i> Careers</a>
            <a href="founders.php" class="admin-nav-link <?= $currentAdminPage === 'founders' ? 'active' : '' ?>"><i class="bi bi-people"></i> Founders</a>
            <a href="clients.php" class="admin-nav-link <?= $currentAdminPage === 'clients' ? 'active' : '' ?>"><i class="bi bi-person-check"></i> Clients</a>
            <a href="tracking.php" class="admin-nav-link <?= $currentAdminPage === 'tracking' ? 'active' : '' ?>"><i class="bi bi-kanban"></i> Project Tracking</a>
            <hr style="border-color:var(--admin-border);margin:1rem 1.5rem">
            <a href="../index.php" class="admin-nav-link" target="_blank"><i class="bi bi-globe"></i> View Website</a>
            <a href="logout.php" class="admin-nav-link"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </nav>
    </aside>
    <main class="admin-main">
