<?php
$pageTitle = 'Services | ViSa Tech Solutions';
$pageDescription = 'Explore our software development services: Full Stack, .NET, Java, Python, PHP, MERN Stack, Web Development, API Development, and more.';
$currentPage = 'services';
require_once 'includes/header.php';
$services = getServices();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Our Services</span>
            <h1 class="page-title">Services We Offer</h1>
            <p class="page-subtitle">Comprehensive software development solutions for every business need</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($services as $i => $service): ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="service-card service-card-detailed">
                    <div class="service-icon"><i class="bi <?= $service['icon'] ?>"></i></div>
                    <h5><?= sanitize($service['title']) ?></h5>
                    <p><?= sanitize($service['description']) ?></p>
                    <a href="contact.php" class="service-link">Get a Quote <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding bg-dark-alt">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Our Process</span>
            <h2 class="section-title">How We Work</h2>
        </div>
        <div class="row g-4">
            <?php
            $process = [
                ['step' => '01', 'title' => 'Discovery', 'desc' => 'We understand your requirements, goals, and business challenges.'],
                ['step' => '02', 'title' => 'Planning', 'desc' => 'We create a detailed project plan with timelines and milestones.'],
                ['step' => '03', 'title' => 'Development', 'desc' => 'Our team builds your solution using best practices and modern tech.'],
                ['step' => '04', 'title' => 'Testing', 'desc' => 'Rigorous testing ensures quality, security, and performance.'],
                ['step' => '05', 'title' => 'Deployment', 'desc' => 'We launch your product and ensure a smooth go-live experience.'],
                ['step' => '06', 'title' => 'Support', 'desc' => 'Ongoing maintenance and support to keep your product running smoothly.'],
            ];
            foreach ($process as $i => $p):
            ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="process-card">
                    <span class="process-step"><?= $p['step'] ?></span>
                    <h5><?= $p['title'] ?></h5>
                    <p><?= $p['desc'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding cta-section">
    <div class="container">
        <div class="cta-box text-center fade-up">
            <h2 class="section-title">Need a Custom Solution?</h2>
            <p class="section-text mx-auto mb-4" style="max-width:600px">Tell us about your project and we'll provide a tailored solution that fits your budget and timeline.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Request a Free Quote</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
