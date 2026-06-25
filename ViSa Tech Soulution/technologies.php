<?php
$pageTitle = 'Technologies | ViSa Tech Solutions';
$pageDescription = 'Our technology stack includes HTML5, CSS3, JavaScript, Bootstrap, PHP, ASP.NET Core, Java, Python, MySQL, and more.';
$currentPage = 'technologies';
require_once 'includes/header.php';
$technologies = getTechnologies();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Technologies</span>
            <h1 class="page-title">Our Technology Stack</h1>
            <p class="page-subtitle">Modern tools and frameworks for building world-class applications</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($technologies as $category => $techs): ?>
            <div class="col-lg-6 fade-up">
                <div class="tech-detail-card">
                    <h4><i class="bi bi-gear me-2 text-primary"></i><?= sanitize($category) ?></h4>
                    <div class="tech-list">
                        <?php foreach ($techs as $tech): ?>
                        <div class="tech-list-item">
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <span><?= sanitize($tech) ?></span>
                        </div>
                        <?php endforeach; ?>
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
            <h2 class="section-title">Development Expertise</h2>
        </div>
        <div class="row g-4">
            <?php
            $expertise = [
                ['icon' => 'bi-window', 'title' => 'Frontend Development', 'desc' => 'Responsive, accessible, and performant user interfaces with modern frameworks.', 'techs' => 'HTML5, CSS3, JavaScript, Bootstrap 5, React.js'],
                ['icon' => 'bi-server', 'title' => 'Backend Development', 'desc' => 'Robust server-side applications with secure APIs and business logic.', 'techs' => 'PHP 8, ASP.NET Core, Java, Python, Node.js'],
                ['icon' => 'bi-database', 'title' => 'Database Management', 'desc' => 'Efficient data storage, optimization, and management solutions.', 'techs' => 'MySQL, MongoDB, SQL Server'],
                ['icon' => 'bi-cloud', 'title' => 'DevOps & Tools', 'desc' => 'Professional development workflow with industry-standard tools.', 'techs' => 'Git, GitHub, VS Code, Postman'],
            ];
            foreach ($expertise as $i => $e):
            ?>
            <div class="col-lg-6 fade-up delay-<?= ($i % 2) + 1 ?>">
                <div class="expertise-card">
                    <div class="expertise-icon"><i class="bi <?= $e['icon'] ?>"></i></div>
                    <h5><?= $e['title'] ?></h5>
                    <p><?= $e['desc'] ?></p>
                    <div class="tech-tags mt-3">
                        <?php foreach (explode(',', $e['techs']) as $t): ?>
                        <span class="tech-tag-sm"><?= trim($t) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding cta-section">
    <div class="container">
        <div class="cta-box text-center fade-up">
            <h2 class="section-title">Have a Technology Challenge?</h2>
            <p class="section-text mx-auto mb-4" style="max-width:600px">Our team has expertise across multiple technology stacks. Let's find the right solution for your project.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Discuss Your Project</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
