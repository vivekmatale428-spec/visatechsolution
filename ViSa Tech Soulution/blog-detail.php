<?php
$slug = $_GET['slug'] ?? '';
$post = getBlogPost($slug);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    $pageTitle = 'Post Not Found | ViSaTech Solutions';
    $currentPage = 'blog';
    require_once 'includes/header.php';
    echo '<section class="section-padding text-center"><h2>Article Not Found</h2><a href="blog.php" class="btn btn-primary mt-3">Back to Blog</a></section>';
    require_once 'includes/footer.php';
    exit;
}

$pageTitle = sanitize($post['title']) . ' | ViSaTech Solutions Blog';
$pageDescription = sanitize($post['excerpt'] ?? '');
$currentPage = 'blog';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Blog</span>
            <h1 class="page-title"><?= sanitize($post['title']) ?></h1>
            <p class="page-subtitle">
                <i class="bi bi-calendar3"></i> <?= date('F d, Y', strtotime($post['created_at'])) ?>
                &middot; <?= sanitize($post['author']) ?>
            </p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 fade-up">
                <div class="blog-content">
                    <?= $post['content'] ?>
                </div>
                <div class="mt-4">
                    <a href="blog.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left me-2"></i>Back to Blog</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
