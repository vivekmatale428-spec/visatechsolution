<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/functions.php';

$pageTitle = $pageTitle ?? SITE_NAME;
$pageDescription = $pageDescription ?? 'ViSaTech Solutions - Transforming Ideas Into Digital Solutions. Full Stack, MERN, Java, Python, .NET Development.';
$pageKeywords = $pageKeywords ?? 'software development, ViSaTech Solutions, full stack, MERN, Java, Python, .NET';
$currentPage = $currentPage ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= sanitize($pageTitle) ?></title>
    <meta name="description" content="<?= sanitize($pageDescription) ?>">
    <meta name="keywords" content="<?= sanitize($pageKeywords) ?>">
    <meta name="author" content="ViSaTech Solutions">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?= sanitize($pageTitle) ?>">
    <meta property="og:description" content="<?= sanitize($pageDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL ?>">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= htmlspecialchars(asset('css/style.css'), ENT_QUOTES) ?>" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= url('index.php') ?>">
            <span class="brand-icon"><span class="vs-logo">VS</span></span>
            <span class="brand-text">ViSa<span class="text-primary">Tech</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'home' ? 'active' : '' ?>" href="<?= url('index.php') ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'about' ? 'active' : '' ?>" href="<?= url('about.php') ?>">About</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'services' ? 'active' : '' ?>" href="<?= url('services.php') ?>">Services</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'technologies' ? 'active' : '' ?>" href="<?= url('technologies.php') ?>">Technologies</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'portfolio' ? 'active' : '' ?>" href="<?= url('portfolio.php') ?>">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'founders' ? 'active' : '' ?>" href="<?= url('founders.php') ?>">Founders</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'blog' ? 'active' : '' ?>" href="<?= url('blog.php') ?>">Blog</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'careers' ? 'active' : '' ?>" href="<?= url('careers.php') ?>">Careers</a></li>
                <li class="nav-item"><a class="nav-link <?= $currentPage === 'testimonials' ? 'active' : '' ?>" href="<?= url('testimonials.php') ?>">Reviews</a></li>
                <li class="nav-item ms-lg-1"><a class="nav-link <?= $currentPage === 'client' ? 'active' : '' ?>" href="<?= url('client/login.php') ?>"><i class="bi bi-person-circle"></i> Client</a></li>
                <li class="nav-item ms-lg-2"><a class="btn btn-primary btn-sm px-3" href="<?= url('contact.php') ?>">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
