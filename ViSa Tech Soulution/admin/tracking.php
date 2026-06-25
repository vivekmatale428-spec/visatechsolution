<?php
$pageTitle = 'Project Tracking';
$currentAdminPage = 'tracking';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add' || $a === 'edit') {
        $status = $_POST['status'] ?? 'Requirement Analysis';
        $progress = getProjectProgress($status);
        $docFile = null;
        if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
            $docFile = uploadFile($_FILES['document'], 'documents', ['pdf','doc','docx','zip','png','jpg']);
        }
        if ($a === 'add') {
            $db->prepare('INSERT INTO project_tracking (client_id,project_name,description,status,progress,document_file,notes) VALUES (?,?,?,?,?,?,?)')->execute([
                (int)$_POST['client_id'], trim($_POST['project_name']??''), trim($_POST['description']??''), $status, $progress, $docFile, trim($_POST['notes']??'')
            ]);
        } else {
            $id = (int)$_POST['id'];
            if ($docFile) {
                $db->prepare('UPDATE project_tracking SET client_id=?,project_name=?,description=?,status=?,progress=?,document_file=?,notes=? WHERE id=?')->execute([
                    (int)$_POST['client_id'], trim($_POST['project_name']??''), trim($_POST['description']??''), $status, $progress, $docFile, trim($_POST['notes']??''), $id
                ]);
            } else {
                $db->prepare('UPDATE project_tracking SET client_id=?,project_name=?,description=?,status=?,progress=?,notes=? WHERE id=?')->execute([
                    (int)$_POST['client_id'], trim($_POST['project_name']??''), trim($_POST['description']??''), $status, $progress, trim($_POST['notes']??''), $id
                ]);
            }
        }
    }
    if ($a === 'delete') $db->prepare('DELETE FROM project_tracking WHERE id=?')->execute([(int)$_POST['id']]);
    redirect('tracking.php');
}
$rows = $db->query('SELECT pt.*, c.full_name as client_name FROM project_tracking pt JOIN clients c ON pt.client_id=c.id ORDER BY pt.updated_at DESC')->fetchAll();
$clients = $db->query('SELECT id, full_name, email FROM clients WHERE is_active=1')->fetchAll();
$statuses = PROJECT_STATUSES;
?>
<div class="admin-topbar"><h2>Project Tracking</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add Project</button></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Project</th><th>Client</th><th>Status</th><th>Progress</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $r): ?><tr><td><?= sanitize($r['project_name']) ?></td><td><?= sanitize($r['client_name']) ?></td><td><?= sanitize($r['status']) ?></td><td><?= getProjectProgress($r['status']) ?>%</td>
<td><button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $r['id'] ?>"><i class="bi bi-pencil"></i></button>
<form method="POST" class="d-inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<div class="modal fade" id="e<?= $r['id'] ?>"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST" enctype="multipart/form-data"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $r['id'] ?>"><div class="modal-header"><h5>Edit Project</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php trackFields($r, $clients, $statuses); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><div class="modal-header"><h5>Add Project</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php trackFields([], $clients, $statuses); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div></form></div></div></div>
<?php function trackFields($r=[], $clients=[], $statuses=[]): void { ?>
<div class="mb-3"><label class="form-label">Client</label><select name="client_id" class="form-control" required><?php foreach($clients as $c): ?><option value="<?= $c['id'] ?>" <?=($r['client_id']??'')==$c['id']?'selected':''?>><?= sanitize($c['full_name']) ?> (<?= sanitize($c['email']) ?>)</option><?php endforeach; ?></select></div>
<div class="mb-3"><label class="form-label">Project Name</label><input name="project_name" class="form-control" value="<?= sanitize($r['project_name']??'') ?>" required></div>
<div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"><?= sanitize($r['description']??'') ?></textarea></div>
<div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-control"><?php foreach($statuses as $s): ?><option value="<?= $s ?>" <?=($r['status']??'')===$s?'selected':''?>><?= $s ?></option><?php endforeach; ?></select></div>
<div class="mb-3"><label class="form-label">Document (optional)</label><input type="file" name="document" class="form-control" accept=".pdf,.doc,.docx,.zip,.png,.jpg"><?php if(!empty($r['document_file'])): ?><small class="text-muted">Current: <?= sanitize($r['document_file']) ?></small><?php endif; ?></div>
<div class="mb-3"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="2"><?= sanitize($r['notes']??'') ?></textarea></div>
<?php } require_once 'includes/footer.php'; ?>
