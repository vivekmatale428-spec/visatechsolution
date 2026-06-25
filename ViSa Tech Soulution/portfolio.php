<?php
$pageTitle = 'Portfolio | ViSa Tech Solutions';
$pageDescription = 'View our portfolio of software development projects including web applications, enterprise systems, and custom software solutions.';
$currentPage = 'portfolio';
require_once 'includes/header.php';
$projects = getPortfolioProjects();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Portfolio</span>
            <h1 class="page-title">Our Work</h1>
            <p class="page-subtitle">Showcasing our successful projects and case studies</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if (empty($projects)): ?>
        <div class="text-center fade-up">
            <i class="bi bi-folder2-open display-1 text-muted"></i>
            <h4 class="mt-3">Projects Coming Soon</h4>
            <p class="text-muted">We're working on showcasing our latest projects. Check back soon!</p>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($projects as $i => $project): ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <?php if ($project['image']): ?>
                        <img src="<?= sanitize($project['image']) ?>" alt="<?= sanitize($project['project_name']) ?>">
                        <?php else: ?>
                        <div class="portfolio-placeholder">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <?php endif; ?>
                        <div class="portfolio-overlay">
                            <?php if ($project['live_demo_link'] && $project['live_demo_link'] !== '#'): ?>
                            <a href="<?= sanitize($project['live_demo_link']) ?>" class="btn btn-sm btn-primary" target="_blank" rel="noopener">Live Demo</a>
                            <?php endif; ?>
                            <?php if ($project['github_link'] && $project['github_link'] !== '#'): ?>
                            <a href="<?= sanitize($project['github_link']) ?>" class="btn btn-sm btn-outline-light" target="_blank" rel="noopener">GitHub</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h5><?= sanitize($project['project_name']) ?></h5>
                        <p><?= sanitize($project['description']) ?></p>
                        <div class="tech-tags">
                            <?php foreach (explode(',', $project['technologies'] ?? $project['technology_stack'] ?? '') as $tech): ?>
                            <span class="tech-tag-sm"><?= sanitize(trim($tech)) ?></span>
                            <?php endforeach; ?>
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
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Stats</span>
            <h2 class="section-title">Our Track Record</h2>
        </div>
        <div class="row g-4 text-center">
            <div class="col-lg-3 col-md-6 fade-up">
                <div class="stat-box">
                    <h2 class="counter text-primary" data-target="50">0</h2>
                    <p>Projects Completed</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-up delay-1">
                <div class="stat-box">
                    <h2 class="counter text-primary" data-target="30">0</h2>
                    <p>Happy Clients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-up delay-2">
                <div class="stat-box">
                    <h2 class="counter text-primary" data-target="12">0</h2>
                    <p>Technologies</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-up delay-3">
                <div class="stat-box">
                    <h2 class="counter text-primary" data-target="5">0</h2>
                    <p>Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding cta-section">
    <div class="container">
        <div class="cta-box text-center fade-up">
            <h2 class="section-title">Want to Be Our Next Success Story?</h2>
            <p class="section-text mx-auto mb-4" style="max-width:600px">Let's create something amazing together. Share your project idea with us.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Start Your Project</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
