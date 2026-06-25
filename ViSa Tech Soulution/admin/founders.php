<?php
$pageTitle = 'Founders';
$currentAdminPage = 'founders';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'edit') {
        $db->prepare('UPDATE founders SET name=?,designation=?,skills=?,bio=?,sort_order=? WHERE id=?')->execute([
            trim($_POST['name']??''), trim($_POST['designation']??''), trim($_POST['skills']??''), trim($_POST['bio']??''), (int)($_POST['sort_order']??0), (int)$_POST['id']
        ]);
    }
    redirect('founders.php');
}
$rows = $db->query('SELECT * FROM founders ORDER BY sort_order')->fetchAll();
?>
<div class="admin-topbar"><h2>Founders</h2></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Name</th><th>Designation</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $f): ?><tr><td><?= sanitize($f['name']) ?></td><td><?= sanitize($f['designation']) ?></td>
<td><button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $f['id'] ?>"><i class="bi bi-pencil"></i></button></td></tr>
<div class="modal fade" id="e<?= $f['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $f['id'] ?>"><div class="modal-header"><h5>Edit Founder</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form">
<div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" value="<?= sanitize($f['name']) ?>" required></div>
<div class="mb-3"><label class="form-label">Designation</label><input name="designation" class="form-control" value="<?= sanitize($f['designation']) ?>" required></div>
<div class="mb-3"><label class="form-label">Skills</label><input name="skills" class="form-control" value="<?= sanitize($f['skills']) ?>"></div>
<div class="mb-3"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="2"><?= sanitize($f['bio']) ?></textarea></div>
<div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?= $f['sort_order'] ?>"></div>
</div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require_once 'includes/footer.php'; ?>
