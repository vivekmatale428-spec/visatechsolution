<?php
$pageTitle = 'Projects';
$currentAdminPage = 'projects';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add' || $a === 'edit') {
        $d = [':n'=>trim($_POST['project_name']??''),':d'=>trim($_POST['description']??''),':t'=>trim($_POST['technologies']??''),':i'=>trim($_POST['image']??''),':g'=>trim($_POST['github_link']??''),':l'=>trim($_POST['live_demo_link']??'')];
        if ($a==='add') { $db->prepare('INSERT INTO projects (project_name,description,technologies,image,github_link,live_demo_link) VALUES (:n,:d,:t,:i,:g,:l)')->execute($d); }
        else { $d[':id']=(int)$_POST['id']; $db->prepare('UPDATE projects SET project_name=:n,description=:d,technologies=:t,image=:i,github_link=:g,live_demo_link=:l WHERE id=:id')->execute($d); }
    }
    if ($a==='delete') $db->prepare('DELETE FROM projects WHERE id=?')->execute([(int)$_POST['id']]);
    redirect('projects.php');
}
$rows = $db->query('SELECT * FROM projects ORDER BY created_at DESC')->fetchAll();
?>
<div class="admin-topbar"><h2>Portfolio Projects</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add</button></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Name</th><th>Technologies</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $p): ?><tr><td><?= sanitize($p['project_name']) ?></td><td><small><?= sanitize($p['technologies']) ?></small></td>
<td><button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $p['id'] ?>"><i class="bi bi-pencil"></i></button>
<form method="POST" class="d-inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<div class="modal fade" id="e<?= $p['id'] ?>"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $p['id'] ?>">
<div class="modal-header"><h5>Edit Project</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php projectFields($p); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="add">
<div class="modal-header"><h5>Add Project</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php projectFields(); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div></form></div></div></div>
<?php function projectFields($p=[]): void { foreach(['project_name'=>'Name','description'=>'Description','technologies'=>'Technologies','image'=>'Image URL','github_link'=>'GitHub','live_demo_link'=>'Live Demo'] as $k=>$l): ?>
<div class="mb-3"><label class="form-label"><?= $l ?></label><?php if($k==='description'): ?><textarea name="<?= $k ?>" class="form-control" rows="3" required><?= sanitize($p[$k]??'') ?></textarea><?php else: ?><input name="<?= $k ?>" class="form-control" value="<?= sanitize($p[$k]??'') ?>" <?= in_array($k,['project_name','description','technologies'])?'required':'' ?>><?php endif; ?></div>
<?php endforeach; } require_once 'includes/footer.php'; ?>
