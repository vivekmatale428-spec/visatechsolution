<?php
$pageTitle = 'Contact Us | ViSaTech Solutions';
$pageDescription = 'Contact ViSaTech Solutions for a free consultation. Reach us at info@visatechsolutions.com.';
$currentPage = 'contact';
require_once 'includes/header.php';
$flash = getFlash();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Contact</span>
            <h1 class="page-title">Get In Touch</h1>
            <p class="page-subtitle">We'd love to hear about your project. Send us a message!</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show fade-up">
            <?= sanitize($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="row g-5">
            <div class="col-lg-5 fade-up">
                <h3 class="section-title mb-4">Contact Information</h3>
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                        <div>
                            <h6>Email Us</h6>
                            <a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a><br>
                            <a href="mailto:<?= CONTACT_EMAIL ?>"><?= CONTACT_EMAIL ?></a>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="bi bi-globe"></i></div>
                        <div><h6>Website</h6><span>visatechsolutions.com</span></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="bi bi-clock"></i></div>
                        <div><h6>Business Hours</h6><span>Mon - Sat: 9:00 AM - 6:00 PM IST</span></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 fade-up delay-1">
                <div class="contact-form-card">
                    <h4 class="mb-4">Send Us a Message</h4>
                    <form action="process_contact.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile Number</label>
                                <input type="tel" name="mobile" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Service Required</label>
                                <select name="service_required" class="form-select">
                                    <option value="">Select Service</option>
                                    <option value="Full Stack Development">Full Stack Development</option>
                                    <option value="MERN Stack Development">MERN Stack Development</option>
                                    <option value="Java Development">Java Development</option>
                                    <option value="Python Development">Python Development</option>
                                    <option value=".NET Development">.NET Development</option>
                                    <option value="UI/UX Design">UI/UX Design</option>
                                    <option value="Website Development">Website Development</option>
                                    <option value="API Development">API Development</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message *</label>
                                <textarea name="message" class="form-control" rows="5" required placeholder="Tell us about your project..."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
