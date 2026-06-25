<?php
$pageTitle = 'ViSaTech Solutions | Transforming Ideas Into Digital Solutions';
$pageDescription = 'ViSaTech Solutions delivers innovative, scalable, and reliable software solutions using modern technologies. Full Stack, MERN, Java, Python, .NET Development.';
$currentPage = 'home';

require_once 'includes/header.php';

$services = getServices();
$technologies = getTechnologies();
$whyChooseUs = getWhyChooseUs();
$testimonials = getTestimonials(4);
$portfolio = getPortfolioProjects(6);
$blogPosts = getBlogPosts(3);
?>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="hero-bg"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7">
                <div class="hero-content fade-up">
                    <span class="hero-badge">ViSaTech Solutions</span>
                    <h1 class="hero-title">Transforming Ideas Into <span class="text-gradient">Digital Solutions</span></h1>
                    <p class="hero-subtitle">We deliver innovative, scalable, and reliable software solutions using modern technologies.</p>
                    <div class="hero-buttons">
                        <a href="contact.php" class="btn btn-primary btn-lg me-3 mb-2">Get Free Consultation</a>
                        <a href="portfolio.php" class="btn btn-outline-light btn-lg mb-2">View Portfolio</a>
                    </div>
                    <div class="hero-stats mt-5">
                        <div class="row">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="counter" data-target="50">0</h3>
                                    <p>Projects Done</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="counter" data-target="30">0</h3>
                                    <p>Happy Clients</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="counter" data-target="5">0</h3>
                                    <p>Years Experience</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-visual fade-up delay-2">
                    <div class="code-window">
                        <div class="code-header">
                            <span class="dot red"></span>
                            <span class="dot yellow"></span>
                            <span class="dot green"></span>
                            <span class="code-title">solution.js</span>
                        </div>
                        <div class="code-body">
                            <pre><code><span class="code-keyword">const</span> <span class="code-var">solution</span> = {
  <span class="code-prop">company</span>: <span class="code-string">"ViSaTech Solutions"</span>,
  <span class="code-prop">mission</span>: <span class="code-string">"Transform Ideas"</span>,
  <span class="code-prop">stack</span>: [<span class="code-string">".NET"</span>, <span class="code-string">"MERN"</span>, <span class="code-string">"Python"</span>],
  <span class="code-prop">deliver</span>: <span class="code-keyword">async</span> () => {
    <span class="code-keyword">return</span> <span class="code-string">"Excellence"</span>;
  }
};</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Introduction -->
<section class="section-padding" id="about-preview">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-up">
                <span class="section-badge">About Us</span>
                <h2 class="section-title">Your Trusted Technology Partner</h2>
                <p class="section-text">ViSaTech Solutions is a technology-driven software company founded by Vivek Matale and Sagar. We provide complete web development, software development, and digital transformation solutions.</p>
                <p class="section-text">From startups to enterprise clients, we help transform ideas into successful digital products through quality development practices and customer-focused solutions.</p>
                <a href="about.php" class="btn btn-primary mt-2">Learn More About Us</a>
            </div>
            <div class="col-lg-6 fade-up delay-1">
                <div class="about-cards">
                    <div class="about-card">
                        <i class="bi bi-eye"></i>
                        <h5>Our Vision</h5>
                        <p>To become a globally trusted software development company delivering innovative solutions.</p>
                    </div>
                    <div class="about-card">
                        <i class="bi bi-bullseye"></i>
                        <h5>Our Mission</h5>
                        <p>To help businesses transform ideas into successful digital products through technology.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="section-padding bg-dark-alt" id="services-preview">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Our Services</span>
            <h2 class="section-title">What We Offer</h2>
            <p class="section-text mx-auto" style="max-width:600px">Comprehensive software development services tailored to your business needs.</p>
        </div>
        <div class="row g-4">
            <?php foreach (array_slice($services, 0, 6) as $i => $service): ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="service-card">
                    <div class="service-icon"><i class="bi <?= $service['icon'] ?>"></i></div>
                    <h5><?= sanitize($service['title']) ?></h5>
                    <p><?= sanitize($service['description']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5 fade-up">
            <a href="services.php" class="btn btn-outline-primary">View All Services</a>
        </div>
    </div>
</section>

<!-- Technology Expertise -->
<section class="section-padding" id="tech-preview">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Technologies</span>
            <h2 class="section-title">Our Tech Stack</h2>
            <p class="section-text mx-auto" style="max-width:600px">We leverage modern technologies to build robust and scalable solutions.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($technologies as $category => $techs): ?>
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="tech-category-card">
                    <h5><?= sanitize($category) ?></h5>
                    <div class="tech-tags">
                        <?php foreach ($techs as $tech): ?>
                        <span class="tech-tag"><?= sanitize($tech) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5 fade-up">
            <a href="technologies.php" class="btn btn-outline-primary">Explore Technologies</a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section-padding bg-dark-alt" id="why-us">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Why Choose Us</span>
            <h2 class="section-title">Why ViSaTech Solutions?</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($whyChooseUs as $i => $item): ?>
            <div class="col-lg-3 col-md-6 fade-up delay-<?= ($i % 4) + 1 ?>">
                <div class="why-card text-center">
                    <div class="why-icon"><i class="bi <?= $item['icon'] ?>"></i></div>
                    <h6><?= sanitize($item['title']) ?></h6>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Portfolio Preview -->
<section class="section-padding" id="portfolio-preview">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Portfolio</span>
            <h2 class="section-title">Our Recent Work</h2>
            <p class="section-text mx-auto" style="max-width:600px">Explore some of our successful projects and case studies.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($portfolio as $i => $project): ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <?php if ($project['live_demo_link'] && $project['live_demo_link'] !== '#'): ?>
                            <a href="<?= sanitize($project['live_demo_link']) ?>" class="btn btn-sm btn-primary" target="_blank">Live Demo</a>
                            <?php endif; ?>
                            <?php if ($project['github_link'] && $project['github_link'] !== '#'): ?>
                            <a href="<?= sanitize($project['github_link']) ?>" class="btn btn-sm btn-outline-light" target="_blank">GitHub</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h5><?= sanitize($project['project_name']) ?></h5>
                        <p><?= sanitize(substr($project['description'], 0, 100)) ?>...</p>
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
        <div class="text-center mt-5 fade-up">
            <a href="portfolio.php" class="btn btn-outline-primary">View All Projects</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding bg-dark-alt" id="testimonials-preview">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Testimonials</span>
            <h2 class="section-title">What Our Clients Say</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($testimonials as $i => $t): ?>
            <div class="col-lg-6 fade-up delay-<?= ($i % 2) + 1 ?>">
                <div class="testimonial-card">
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
        <div class="text-center mt-5 fade-up">
            <a href="testimonials.php" class="btn btn-outline-primary">Read More Reviews</a>
        </div>
    </div>
</section>

<!-- Blog Preview -->
<?php if (!empty($blogPosts)): ?>
<section class="section-padding" id="blog-preview">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Blog</span>
            <h2 class="section-title">Latest Insights</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($blogPosts as $i => $post): ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="blog-card">
                    <div class="blog-card-image"><i class="bi bi-journal-richtext"></i></div>
                    <div class="blog-card-body">
                        <div class="blog-meta"><?= date('M d, Y', strtotime($post['created_at'])) ?></div>
                        <h5><?= sanitize($post['title']) ?></h5>
                        <p><?= sanitize($post['excerpt'] ?? '') ?></p>
                        <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>" class="service-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5 fade-up">
            <a href="blog.php" class="btn btn-outline-primary">View All Articles</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contact CTA -->
<section class="section-padding cta-section" id="contact-cta">
    <div class="container">
        <div class="cta-box text-center fade-up">
            <h2 class="section-title">Ready to Start Your Project?</h2>
            <p class="section-text mx-auto mb-4" style="max-width:600px">Let's discuss how we can help transform your ideas into powerful digital solutions. Get a free consultation today.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Get Free Consultation</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
