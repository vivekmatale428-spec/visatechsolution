<?php
$pageTitle = 'Contact Messages';
$currentAdminPage = 'messages';
require_once 'includes/header.php';
$db = getDB();
if (isset($_GET['read'])) { $db->prepare('UPDATE contact_messages SET is_read=1 WHERE id=?')->execute([(int)$_GET['read']]); redirect('messages.php'); }
if (isset($_GET['delete'])) { $db->prepare('DELETE FROM contact_messages WHERE id=?')->execute([(int)$_GET['delete']]); redirect('messages.php'); }
$rows = $db->query('SELECT * FROM contact_messages ORDER BY created_at DESC')->fetchAll();
?>
<div class="admin-topbar"><h2>Contact Messages</h2></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Status</th><th>Name</th><th>Email</th><th>Mobile</th><th>Service</th><th>Date</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $r): ?>
<tr><td><?= !$r['is_read'] ? '<span class="badge-unread">New</span>' : 'Read' ?></td><td><?= sanitize($r['full_name']) ?></td><td><?= sanitize($r['email']) ?></td><td><?= sanitize($r['mobile']?:'-') ?></td><td><?= sanitize($r['service_required']?:'-') ?></td><td><?= date('M d,Y',strtotime($r['created_at'])) ?></td>
<td><button class="btn btn-sm btn-outline-info btn-action" data-bs-toggle="modal" data-bs-target="#m<?= $r['id'] ?>"><i class="bi bi-eye"></i></button>
<?php if(!$r['is_read']): ?><a href="?read=<?= $r['id'] ?>" class="btn btn-sm btn-outline-success btn-action"><i class="bi bi-check"></i></a><?php endif; ?>
<a href="?delete=<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger btn-action" onclick="return confirm('Delete?')"><i class="bi bi-trash"></i></a></td></tr>
<div class="modal fade" id="m<?= $r['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5>Message from <?= sanitize($r['full_name']) ?></h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><p><?= nl2br(sanitize($r['message'])) ?></p></div></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require_once 'includes/footer.php'; ?>
