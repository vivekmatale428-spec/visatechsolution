<?php
$pageTitle = 'Testimonials | ViSa Tech Solutions';
$pageDescription = 'Read what our clients say about ViSa Tech Solutions. Client reviews and feedback on our software development services.';
$currentPage = 'testimonials';
require_once 'includes/header.php';
$testimonials = getTestimonials();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Testimonials</span>
            <h1 class="page-title">Client Reviews</h1>
            <p class="page-subtitle">Hear from businesses we've helped succeed</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if (empty($testimonials)): ?>
        <div class="text-center fade-up">
            <i class="bi bi-chat-quote display-1 text-muted"></i>
            <h4 class="mt-3">Testimonials Coming Soon</h4>
            <p class="text-muted">We're collecting feedback from our clients. Check back soon!</p>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($testimonials as $i => $t): ?>
            <div class="col-lg-6 fade-up delay-<?= ($i % 2) + 1 ?>">
                <div class="testimonial-card testimonial-card-lg">
                    <div class="testimonial-stars mb-3"><?= renderStars((int) $t['rating']) ?></div>
                    <p class="testimonial-text">"<?= sanitize($t['review']) ?>"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><?= strtoupper(substr($t['client_name'], 0, 1)) ?></div>
                        <div>
                            <h6 class="mb-0"><?= sanitize($t['client_name']) ?></h6>
                            <small class="text-muted"><?= sanitize($t['designation']) ?>, <?= sanitize($t['company_name']) ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section-padding bg-dark-alt">
    <div class="container">
        <div class="text-center fade-up">
            <div class="rating-summary">
                <h2 class="display-4 text-primary fw-bold">5.0</h2>
                <div class="mb-2"><?= renderStars(5) ?></div>
                <p class="text-muted">Average client satisfaction rating</p>
            </div>
        </div>
    </div>
</section>

<section class="section-padding cta-section">
    <div class="container">
        <div class="cta-box text-center fade-up">
            <h2 class="section-title">Join Our Happy Clients</h2>
            <p class="section-text mx-auto mb-4" style="max-width:600px">Experience the same quality and dedication that our clients rave about.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Start Your Project</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
