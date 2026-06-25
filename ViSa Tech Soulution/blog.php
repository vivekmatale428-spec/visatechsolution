<?php
$pageTitle = 'Blog | ViSaTech Solutions';
$pageDescription = 'Read the latest articles on software development, technology trends, and digital transformation from ViSaTech Solutions.';
$currentPage = 'blog';
require_once 'includes/header.php';
$posts = getBlogPosts();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Blog</span>
            <h1 class="page-title">Insights & Articles</h1>
            <p class="page-subtitle">Technology insights, development tips, and industry trends</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if (empty($posts)): ?>
        <div class="text-center fade-up">
            <i class="bi bi-journal-text display-1 text-muted"></i>
            <h4 class="mt-3">Blog Coming Soon</h4>
            <p class="text-muted">We're preparing insightful articles. Check back soon!</p>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($posts as $i => $post): ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="blog-card">
                    <div class="blog-card-image">
                        <?php if ($post['featured_image']): ?>
                        <img src="<?= sanitize($post['featured_image']) ?>" alt="" style="width:100%;height:100%;object-fit:cover">
                        <?php else: ?>
                        <i class="bi bi-journal-richtext"></i>
                        <?php endif; ?>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-meta">
                            <i class="bi bi-calendar3"></i> <?= date('M d, Y', strtotime($post['created_at'])) ?>
                            &middot; <?= sanitize($post['author']) ?>
                        </div>
                        <h5><?= sanitize($post['title']) ?></h5>
                        <p><?= sanitize($post['excerpt'] ?? substr(strip_tags($post['content']), 0, 120)) ?>...</p>
                        <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>" class="service-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
