<?php
$pageTitle = 'Careers | ViSaTech Solutions';
$pageDescription = 'Join ViSaTech Solutions. Open positions for Full Stack, MERN, Java, Python, and .NET developers.';
$currentPage = 'careers';
require_once 'includes/header.php';

$careers = getCareers();
$flash = getFlash();
?>

<section class="page-hero">
    <div class="container">
        <div class="fade-up">
            <span class="section-badge">Careers</span>
            <h1 class="page-title">Join Our Team</h1>
            <p class="page-subtitle">Build the future of technology with ViSaTech Solutions</p>
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

        <?php if (empty($careers)): ?>
        <div class="text-center fade-up">
            <i class="bi bi-briefcase display-1 text-muted"></i>
            <h4 class="mt-3">No Open Positions</h4>
            <p class="text-muted">We don't have openings right now, but send your resume to <?= CONTACT_EMAIL ?></p>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($careers as $i => $job): ?>
            <div class="col-lg-6 fade-up delay-<?= ($i % 2) + 1 ?>">
                <div class="career-card">
                    <div class="mb-3">
                        <span class="career-badge"><?= sanitize($job['job_type']) ?></span>
                        <span class="career-badge"><?= sanitize($job['location']) ?></span>
                    </div>
                    <h4><?= sanitize($job['job_title']) ?></h4>
                    <p class="text-muted"><?= sanitize($job['description']) ?></p>
                    <?php if ($job['requirements']): ?>
                    <p><strong>Requirements:</strong> <?= sanitize($job['requirements']) ?></p>
                    <?php endif; ?>
                    <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#applyModal<?= $job['id'] ?>">
                        <i class="bi bi-send me-1"></i> Apply Now
                    </button>
                </div>
            </div>

            <div class="modal fade" id="applyModal<?= $job['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-color);color:#fff">
                        <form action="process_career.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="career_id" value="<?= $job['id'] ?>">
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title">Apply: <?= sanitize($job['job_title']) ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="full_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="tel" name="mobile" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Resume (PDF/DOC) *</label>
                                    <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cover Letter</label>
                                    <textarea name="cover_letter" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
