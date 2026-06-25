<?php
$pageTitle = 'Dashboard';
$currentAdminPage = 'dashboard';
require_once 'includes/header.php';
try {
    $db = getDB();
    $stats = [
        'messages' => (int) $db->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn(),
        'unread' => getUnreadMessagesCount(),
        'projects' => (int) $db->query('SELECT COUNT(*) FROM projects')->fetchColumn(),
        'testimonials' => (int) $db->query('SELECT COUNT(*) FROM testimonials WHERE is_approved = 1')->fetchColumn(),
        'applications' => (int) $db->query('SELECT COUNT(*) FROM job_applications WHERE status = "pending"')->fetchColumn(),
        'clients' => (int) $db->query('SELECT COUNT(*) FROM clients')->fetchColumn(),
    ];
    $recent = $db->query('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5')->fetchAll();
} catch (PDOException $e) {
    $stats = ['messages'=>0,'unread'=>0,'projects'=>0,'testimonials'=>0,'applications'=>0,'clients'=>0];
    $recent = [];
}
?>
<div class="admin-topbar"><div><h2>Dashboard</h2><p class="text-muted mb-0">Welcome, <?= sanitize($_SESSION['admin_username'] ?? 'Admin') ?></p></div></div>
<div class="row g-4 mb-4">
    <?php foreach ([['messages','Messages','envelope','#2563EB'],['unread','Unread','envelope-exclamation','#ffc107'],['projects','Projects','briefcase','#198754'],['applications','Pending Apps','person-badge','#dc3545']] as $s): ?>
    <div class="col-lg-3 col-md-6"><div class="stat-card"><div class="stat-icon" style="background:rgba(37,99,235,0.12);color:<?= $s[3] ?>"><i class="bi bi-<?= $s[2] ?>"></i></div><h3><?= $stats[$s[0]] ?></h3><p><?= $s[1] ?></p></div></div>
    <?php endforeach; ?>
</div>
<div class="admin-card"><div class="admin-card-header"><h5>Recent Messages</h5><a href="messages.php" class="btn btn-sm btn-outline-primary">View All</a></div>
<div class="admin-card-body p-0"><?php if (empty($recent)): ?><p class="text-muted p-4 mb-0">No messages yet.</p><?php else: ?>
<table class="admin-table"><thead><tr><th>Name</th><th>Email</th><th>Service</th><th>Date</th><th>Status</th></tr></thead><tbody>
<?php foreach ($recent as $m): ?><tr><td><?= sanitize($m['full_name']) ?></td><td><?= sanitize($m['email']) ?></td><td><?= sanitize($m['service_required'] ?: '-') ?></td><td><?= date('M d, Y', strtotime($m['created_at'])) ?></td><td><?= !$m['is_read'] ? '<span class="badge-unread">New</span>' : 'Read' ?></td></tr><?php endforeach; ?>
</tbody></table><?php endif; ?></div></div>
<?php require_once 'includes/footer.php'; ?>
