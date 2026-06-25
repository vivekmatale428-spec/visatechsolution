<?php
$pageTitle = 'Founders | ViSaTech Solutions';
$pageDescription = 'Meet Vivek Matale and SagarShedage — co-founders of ViSaTech Solutions with expertise in Full Stack, MERN, Java, and Python development.';
$currentPage = 'founders';
require_once 'includes/header.php';
$founders = getFounders();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Our Team</span>
            <h1 class="page-title">Meet Our Founders</h1>
            <p class="page-subtitle">The visionaries behind ViSaTech Solutions</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <?php foreach ($founders as $i => $f): ?>
            <div class="col-lg-5 col-md-6 fade-up delay-<?= $i + 1 ?>">
                <div class="founder-card">
                    <div class="founder-avatar">
                        <?php if (!empty($f['profile_image'])): ?>
                        <img src="<?= sanitize($f['profile_image']) ?>" alt="<?= sanitize($f['name']) ?>">
                        <?php else: ?>
                        <div class="avatar-placeholder"><?= strtoupper(substr($f['name'], 0, 1)) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="founder-info">
                        <h3><?= sanitize($f['name']) ?></h3>
                        <p class="founder-role"><?= sanitize($f['designation']) ?></p>
                        <?php if ($f['bio']): ?><p class="founder-bio"><?= sanitize($f['bio']) ?></p><?php endif; ?>
                        <h6 class="skills-heading">Technical Skills</h6>
                        <div class="tech-tags">
                            <?php foreach (explode(',', $f['skills']) as $skill): ?>
                            <span class="tech-tag-sm"><?= sanitize(trim($skill)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding bg-dark-alt">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Expertise</span>
            <h2 class="section-title">Combined Expertise</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-6 fade-up"><div class="expertise-card"><h5><i class="bi bi-code-slash text-primary me-2"></i>Full Stack & Backend</h5><p>Building complete applications across Java, Python, and modern web frameworks.</p></div></div>
            <div class="col-lg-6 fade-up delay-1"><div class="expertise-card"><h5><i class="bi bi-stack text-primary me-2"></i>MERN & Modern Web</h5><p>MERN Stack, REST APIs, and responsive design for exceptional user experiences.</p></div></div>
            <div class="col-lg-6 fade-up delay-2"><div class="expertise-card"><h5><i class="bi bi-database text-primary me-2"></i>Database & Architecture</h5><p>Database design, optimization, and scalable software architecture.</p></div></div>
            <div class="col-lg-6 fade-up delay-3"><div class="expertise-card"><h5><i class="bi bi-shield-check text-primary me-2"></i>Quality & Security</h5><p>Clean code, secure development practices, and thorough testing.</p></div></div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
