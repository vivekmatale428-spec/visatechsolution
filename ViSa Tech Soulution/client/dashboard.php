<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
requireClientLogin();

$clientId = (int) $_SESSION['client_id'];
$projects = getClientProjects($clientId);

$pageTitle = 'Client Dashboard | ViSaTech Solutions';
$currentPage = 'client';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="client-dashboard">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 fade-up">
            <div>
                <h2 class="section-title mb-1">Welcome, <?= sanitize($_SESSION['client_name']) ?></h2>
                <p class="text-muted mb-0">Track your project progress and download documents</p>
            </div>
            <a href="<?= url('client/logout.php') ?>" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-left me-1"></i>Logout</a>
        </div>

        <?php if (empty($projects)): ?>
        <div class="dashboard-card text-center fade-up">
            <i class="bi bi-folder2-open display-4 text-muted"></i>
            <h5 class="mt-3">No Projects Yet</h5>
            <p class="text-muted">Your projects will appear here once assigned by our team.</p>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($projects as $i => $project): ?>
            <?php
            $progress = getProjectProgress($project['status']);
            $statuses = PROJECT_STATUSES;
            $currentIdx = array_search($project['status'], $statuses);
            ?>
            <div class="col-lg-6 fade-up delay-<?= ($i % 2) + 1 ?>">
                <div class="dashboard-card">
                    <h5><?= sanitize($project['project_name']) ?></h5>
                    <?php if ($project['description']): ?>
                    <p class="text-muted small"><?= sanitize($project['description']) ?></p>
                    <?php endif; ?>

                    <div class="my-3">
                        <?= renderProgressBar($project['status']) ?>
                    </div>

                    <div class="status-timeline">
                        <?php foreach ($statuses as $idx => $step): ?>
                        <div class="status-step <?= $idx < $currentIdx ? 'completed' : ($idx === $currentIdx ? 'active' : '') ?>">
                            <?= sanitize($step) ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($project['document_file']): ?>
                    <div class="mt-3">
                        <a href="<?= url('uploads/' . $project['document_file']) ?>" class="btn btn-sm btn-outline-primary" download>
                            <i class="bi bi-download me-1"></i>Download Document
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if ($project['notes']): ?>
                    <div class="mt-3 p-3 rounded" style="background:rgba(255,255,255,0.04)">
                        <small class="text-muted"><strong>Notes:</strong> <?= sanitize($project['notes']) ?></small>
                    </div>
                    <?php endif; ?>

                    <small class="text-muted d-block mt-2">Last updated: <?= date('M d, Y', strtotime($project['updated_at'])) ?></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
