<?php
$pageTitle = 'Testimonials';
$currentAdminPage = 'testimonials';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add' || $a === 'edit') {
        $d = [':n'=>trim($_POST['client_name']??''),':c'=>trim($_POST['company_name']??''),':d'=>trim($_POST['designation']??''),':r'=>trim($_POST['review']??''),':rt'=>(int)($_POST['rating']??5),':ap'=>(int)($_POST['is_approved']??0)];
        if ($a==='add') $db->prepare('INSERT INTO testimonials (client_name,company_name,designation,review,rating,is_approved) VALUES (:n,:c,:d,:r,:rt,:ap)')->execute($d);
        else { $d[':id']=(int)$_POST['id']; $db->prepare('UPDATE testimonials SET client_name=:n,company_name=:c,designation=:d,review=:r,rating=:rt,is_approved=:ap WHERE id=:id')->execute($d); }
    }
    if ($a==='approve') $db->prepare('UPDATE testimonials SET is_approved=1 WHERE id=?')->execute([(int)$_POST['id']]);
    if ($a==='delete') $db->prepare('DELETE FROM testimonials WHERE id=?')->execute([(int)$_POST['id']]);
    redirect('testimonials.php');
}
$rows = $db->query('SELECT * FROM testimonials ORDER BY created_at DESC')->fetchAll();
?>
<div class="admin-topbar"><h2>Testimonials</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add</button></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Client</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $t): ?><tr><td><strong><?= sanitize($t['client_name']) ?></strong><br><small><?= sanitize($t['company_name']) ?></small></td><td><?= renderStars((int)$t['rating']) ?></td>
<td><?= $t['is_approved'] ? '<span class="text-success">Approved</span>' : '<span class="text-warning">Pending</span>' ?></td>
<td><?php if(!$t['is_approved']): ?><form method="POST" class="d-inline"><input type="hidden" name="action" value="approve"><input type="hidden" name="id" value="<?= $t['id'] ?>"><button class="btn btn-sm btn-outline-success btn-action"><i class="bi bi-check-lg"></i></button></form><?php endif; ?>
<button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $t['id'] ?>"><i class="bi bi-pencil"></i></button>
<form method="POST" class="d-inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $t['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<div class="modal fade" id="e<?= $t['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $t['id'] ?>"><div class="modal-header"><h5>Edit</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php testimonialFields($t); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="add"><div class="modal-header"><h5>Add Testimonial</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php testimonialFields(); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div></form></div></div></div>
<?php function testimonialFields($t=[]): void { ?>
<div class="mb-3"><label class="form-label">Client Name</label><input name="client_name" class="form-control" value="<?= sanitize($t['client_name']??'') ?>" required></div>
<div class="mb-3"><label class="form-label">Company</label><input name="company_name" class="form-control" value="<?= sanitize($t['company_name']??'') ?>"></div>
<div class="mb-3"><label class="form-label">Designation</label><input name="designation" class="form-control" value="<?= sanitize($t['designation']??'') ?>"></div>
<div class="mb-3"><label class="form-label">Rating</label><select name="rating" class="form-control"><?php for($i=5;$i>=1;$i--): ?><option value="<?= $i ?>" <?=($t['rating']??5)==$i?'selected':''?>><?= $i ?></option><?php endfor; ?></select></div>
<div class="mb-3"><label class="form-label">Review</label><textarea name="review" class="form-control" rows="3" required><?= sanitize($t['review']??'') ?></textarea></div>
<div class="mb-3"><label class="form-label">Approved</label><select name="is_approved" class="form-control"><option value="0" <?=($t['is_approved']??0)==0?'selected':''?>>Pending</option><option value="1" <?=($t['is_approved']??0)==1?'selected':''?>>Approved</option></select></div>
<?php } require_once 'includes/footer.php'; ?>
