<?php
$pageTitle = 'Services';
$currentAdminPage = 'services';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add' || $a === 'edit') {
        $d = [':t'=>trim($_POST['title']??''),':d'=>trim($_POST['description']??''),':i'=>trim($_POST['icon']??'bi-code-slash'),':o'=>(int)($_POST['sort_order']??0)];
        if ($a==='add') $db->prepare('INSERT INTO services (title,description,icon,sort_order) VALUES (:t,:d,:i,:o)')->execute($d);
        else { $d[':id']=(int)$_POST['id']; $db->prepare('UPDATE services SET title=:t,description=:d,icon=:i,sort_order=:o WHERE id=:id')->execute($d); }
    }
    if ($a==='delete') $db->prepare('DELETE FROM services WHERE id=?')->execute([(int)$_POST['id']]);
    redirect('services.php');
}
$rows = $db->query('SELECT * FROM services ORDER BY sort_order')->fetchAll();
?>
<div class="admin-topbar"><h2>Services</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add</button></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Title</th><th>Description</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $s): ?><tr><td><i class="bi <?= sanitize($s['icon']) ?> me-2"></i><?= sanitize($s['title']) ?></td><td><small><?= sanitize(substr($s['description'],0,60)) ?>...</small></td>
<td><button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $s['id'] ?>"><i class="bi bi-pencil"></i></button>
<form method="POST" class="d-inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<div class="modal fade" id="e<?= $s['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $s['id'] ?>"><div class="modal-header"><h5>Edit Service</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php serviceFields($s); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="add"><div class="modal-header"><h5>Add Service</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php serviceFields(); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div></form></div></div></div>
<?php function serviceFields($s=[]): void { ?>
<div class="mb-3"><label class="form-label">Title</label><input name="title" class="form-control" value="<?= sanitize($s['title']??'') ?>" required></div>
<div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2" required><?= sanitize($s['description']??'') ?></textarea></div>
<div class="mb-3"><label class="form-label">Icon (Bootstrap Icons class)</label><input name="icon" class="form-control" value="<?= sanitize($s['icon']??'bi-code-slash') ?>"></div>
<div class="mb-3"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?= $s['sort_order']??0 ?>"></div>
<?php } require_once 'includes/footer.php'; ?>
