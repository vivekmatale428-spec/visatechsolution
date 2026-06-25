<?php
$pageTitle = 'About Us | ViSaTech Solutions';
$pageDescription = 'Learn about ViSaTech Solutions — our story, mission, and vision. Founded by Vivek Matale and Sagar.';
$currentPage = 'about';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">About Us</span>
            <h1 class="page-title">About ViSaTech Solutions</h1>
            <p class="page-subtitle">Building trust through innovation and excellence</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-up">
                <h2 class="section-title">Our Story</h2>
                <p class="section-text">ViSaTech Solutions is a technology-driven software company founded by Vivek Matale and Sagar. We provide complete web development, software development, and digital transformation solutions for startups, enterprises, and international clients.</p>
                <p class="section-text">From Full Stack and MERN Stack development to Java, Python, and .NET solutions — we help businesses transform ideas into successful digital products.</p>
                <p class="section-text">Today, we serve startups, small businesses, medium enterprises, and corporate clients across the globe — building everything from custom web applications to enterprise-grade software systems.</p>
            </div>
            <div class="col-lg-6 fade-up delay-1">
                <div class="about-image-grid">
                    <div class="grid-item gi-1"><i class="bi bi-code-slash"></i><span>Development</span></div>
                    <div class="grid-item gi-2"><i class="bi bi-lightbulb"></i><span>Innovation</span></div>
                    <div class="grid-item gi-3"><i class="bi bi-people"></i><span>Teamwork</span></div>
                    <div class="grid-item gi-4"><i class="bi bi-trophy"></i><span>Excellence</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-dark-alt">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 fade-up">
                <div class="mission-card">
                    <div class="mission-icon"><i class="bi bi-eye"></i></div>
                    <h3>Our Vision</h3>
                    <p>Become a trusted global technology partner.</p>
                </div>
            </div>
            <div class="col-lg-6 fade-up delay-1">
                <div class="mission-card">
                    <div class="mission-icon"><i class="bi bi-bullseye"></i></div>
                    <h3>Our Mission</h3>
                    <p>Deliver innovative and affordable software solutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Core Values</span>
            <h2 class="section-title">What We Stand For</h2>
        </div>
        <div class="row g-4">
            <?php
            $values = [
                ['icon' => 'bi-lightbulb', 'title' => 'Innovation', 'desc' => 'We embrace new technologies and creative approaches to solve complex problems.'],
                ['icon' => 'bi-shield-check', 'title' => 'Trust', 'desc' => 'We build lasting relationships through honesty, reliability, and integrity.'],
                ['icon' => 'bi-eye', 'title' => 'Transparency', 'desc' => 'Clear communication and open processes at every stage of development.'],
                ['icon' => 'bi-star', 'title' => 'Excellence', 'desc' => 'We strive for the highest quality in every line of code we write.'],
                ['icon' => 'bi-heart', 'title' => 'Customer Satisfaction', 'desc' => 'Your success is our success. We go above and beyond for our clients.'],
                ['icon' => 'bi-arrow-repeat', 'title' => 'Continuous Improvement', 'desc' => 'We constantly learn, adapt, and improve our skills and processes.'],
            ];
            foreach ($values as $i => $v):
            ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="value-card">
                    <div class="value-icon"><i class="bi <?= $v['icon'] ?>"></i></div>
                    <h5><?= $v['title'] ?></h5>
                    <p><?= $v['desc'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding bg-dark-alt">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge">Target Market</span>
            <h2 class="section-title">Who We Serve</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $markets = [
                ['icon' => 'bi-rocket', 'title' => 'Startups', 'desc' => 'Launch your MVP and scale fast with our agile development approach.'],
                ['icon' => 'bi-shop', 'title' => 'Small Businesses', 'desc' => 'Affordable custom solutions to digitize and grow your business.'],
                ['icon' => 'bi-building', 'title' => 'Medium Enterprises', 'desc' => 'Scalable systems to streamline operations and boost productivity.'],
                ['icon' => 'bi-briefcase', 'title' => 'Corporate Clients', 'desc' => 'Enterprise-grade applications with robust security and performance.'],
                ['icon' => 'bi-globe2', 'title' => 'International Clients', 'desc' => 'Global delivery with transparent communication across time zones.'],
            ];
            foreach ($markets as $i => $m):
            ?>
            <div class="col-lg-4 col-md-6 fade-up delay-<?= ($i % 3) + 1 ?>">
                <div class="market-card text-center">
                    <div class="market-icon"><i class="bi <?= $m['icon'] ?>"></i></div>
                    <h5><?= $m['title'] ?></h5>
                    <p><?= $m['desc'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding cta-section">
    <div class="container">
        <div class="cta-box text-center fade-up">
            <h2 class="section-title">Let's Build Something Great Together</h2>
            <p class="section-text mx-auto mb-4" style="max-width:600px">Ready to transform your business with technology? We'd love to hear from you.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Contact Us Today</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
