<?php
$pageTitle = 'Careers';
$currentAdminPage = 'careers';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add' || $a === 'edit') {
        $d = [':t'=>trim($_POST['job_title']??''),':d'=>trim($_POST['description']??''),':r'=>trim($_POST['requirements']??''),':l'=>trim($_POST['location']??'Remote'),':j'=>trim($_POST['job_type']??'Full-time')];
        if ($a==='add') $db->prepare('INSERT INTO careers (job_title,description,requirements,location,job_type) VALUES (:t,:d,:r,:l,:j)')->execute($d);
        else { $d[':id']=(int)$_POST['id']; $db->prepare('UPDATE careers SET job_title=:t,description=:d,requirements=:r,location=:l,job_type=:j WHERE id=:id')->execute($d); }
    }
    if ($a==='delete') $db->prepare('DELETE FROM careers WHERE id=?')->execute([(int)$_POST['id']]);
    if ($a==='status') $db->prepare('UPDATE job_applications SET status=? WHERE id=?')->execute([$_POST['status'],(int)$_POST['app_id']]);
    redirect('careers.php');
}
$jobs = $db->query('SELECT * FROM careers ORDER BY created_at DESC')->fetchAll();
$apps = $db->query('SELECT ja.*, c.job_title FROM job_applications ja JOIN careers c ON ja.career_id=c.id ORDER BY ja.created_at DESC')->fetchAll();
?>
<div class="admin-topbar"><h2>Careers</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add Job</button></div>
<div class="admin-card mb-4"><div class="admin-card-header"><h5>Job Openings</h5></div><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Title</th><th>Type</th><th>Location</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($jobs as $j): ?><tr><td><?= sanitize($j['job_title']) ?></td><td><?= sanitize($j['job_type']) ?></td><td><?= sanitize($j['location']) ?></td>
<td><button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $j['id'] ?>"><i class="bi bi-pencil"></i></button>
<form method="POST" class="d-inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $j['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<div class="modal fade" id="e<?= $j['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $j['id'] ?>"><div class="modal-header"><h5>Edit Job</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php careerFields($j); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<div class="admin-card"><div class="admin-card-header"><h5>Applications</h5></div><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Name</th><th>Position</th><th>Status</th><th>Resume</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($apps as $a): ?><tr><td><?= sanitize($a['full_name']) ?><br><small><?= sanitize($a['email']) ?></small></td><td><?= sanitize($a['job_title']) ?></td><td><?= sanitize($a['status']) ?></td>
<td><a href="../uploads/<?= sanitize($a['resume_file']) ?>" class="btn btn-sm btn-outline-primary btn-action" target="_blank"><i class="bi bi-download"></i></a></td>
<td><form method="POST" class="d-inline"><input type="hidden" name="action" value="status"><input type="hidden" name="app_id" value="<?= $a['id'] ?>"><select name="status" class="form-select form-select-sm d-inline-block" style="width:auto" onchange="this.form.submit()"><option value="pending" <?=$a['status']==='pending'?'selected':''?>>Pending</option><option value="reviewed" <?=$a['status']==='reviewed'?'selected':''?>>Reviewed</option><option value="shortlisted" <?=$a['status']==='shortlisted'?'selected':''?>>Shortlisted</option><option value="rejected" <?=$a['status']==='rejected'?'selected':''?>>Rejected</option></select></form></td></tr>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="add"><div class="modal-header"><h5>Add Job</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php careerFields(); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div></form></div></div></div>
<?php function careerFields($j=[]): void { foreach(['job_title'=>'Title','description'=>'Description','requirements'=>'Requirements','location'=>'Location','job_type'=>'Job Type'] as $k=>$l): ?>
<div class="mb-3"><label class="form-label"><?= $l ?></label><?php if(in_array($k,['description','requirements'])): ?><textarea name="<?= $k ?>" class="form-control" rows="2"><?= sanitize($j[$k]??'') ?></textarea><?php else: ?><input name="<?= $k ?>" class="form-control" value="<?= sanitize($j[$k]??($k==='location'?'Remote':($k==='job_type'?'Full-time':''))) ?>" <?= $k==='job_title'?'required':'' ?>><?php endif; ?></div>
<?php endforeach; } require_once 'includes/footer.php'; ?>
