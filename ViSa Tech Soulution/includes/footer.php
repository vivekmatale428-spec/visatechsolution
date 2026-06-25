</main>

<footer class="footer-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">
                    <span class="brand-icon"><span class="vs-logo">VS</span></span>
                    <span class="brand-text">ViSa<span class="text-primary">Tech</span></span>
                </div>
                <p class="footer-desc">Transforming Ideas Into Digital Solutions. We deliver innovative, scalable, and reliable software solutions using modern technologies.</p>
                <div class="social-links">
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="GitHub"><i class="bi bi-github"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="<?= url('index.php') ?>">Home</a></li>
                    <li><a href="<?= url('about.php') ?>">About Us</a></li>
                    <li><a href="<?= url('services.php') ?>">Services</a></li>
                    <li><a href="<?= url('portfolio.php') ?>">Portfolio</a></li>
                    <li><a href="<?= url('blog.php') ?>">Blog</a></li>
                    <li><a href="<?= url('careers.php') ?>">Careers</a></li>
                    <li><a href="<?= url('contact.php') ?>">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Services</h5>
                <ul class="footer-links">
                    <li><a href="<?= url('services.php') ?>">Full Stack Development</a></li>
                    <li><a href="<?= url('services.php') ?>">MERN Stack</a></li>
                    <li><a href="<?= url('services.php') ?>">Java Development</a></li>
                    <li><a href="<?= url('services.php') ?>">Python Development</a></li>
                    <li><a href="<?= url('services.php') ?>">UI/UX Design</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Contact Info</h5>
                <ul class="footer-contact">
                    <li><i class="bi bi-envelope"></i> <a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a></li>
                    <li><i class="bi bi-envelope"></i> <a href="mailto:<?= CONTACT_EMAIL ?>"><?= CONTACT_EMAIL ?></a></li>
                    <li><i class="bi bi-globe"></i> visatechsolutions.com</li>
                </ul>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="mb-0">&copy; <?= date('Y') ?> ViSaTech Solutions. All Rights Reserved.</p>
            <p class="mb-0">Founded by Vivek Matale & Sagar</p>
        </div>
    </div>
</footer>

<button id="backToTop" class="back-to-top" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= htmlspecialchars(asset('js/main.js'), ENT_QUOTES) ?>"></script>
</body>
</html>
