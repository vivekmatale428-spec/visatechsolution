<?php
$pageTitle = 'Clients';
$currentAdminPage = 'clients';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add') {
        $hash = password_hash($_POST['password'] ?? 'client123', PASSWORD_DEFAULT);
        $db->prepare('INSERT INTO clients (full_name,email,password,company_name,phone) VALUES (?,?,?,?,?)')->execute([
            trim($_POST['full_name']??''), trim($_POST['email']??''), $hash, trim($_POST['company_name']??''), trim($_POST['phone']??'')
        ]);
    }
    if ($a === 'delete') $db->prepare('DELETE FROM clients WHERE id=?')->execute([(int)$_POST['id']]);
    redirect('clients.php');
}
$rows = $db->query('SELECT * FROM clients ORDER BY created_at DESC')->fetchAll();
?>
<div class="admin-topbar"><h2>Clients</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add Client</button></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $c): ?><tr><td><?= sanitize($c['full_name']) ?></td><td><?= sanitize($c['email']) ?></td><td><?= sanitize($c['company_name']?:'-') ?></td>
<td><form method="POST" class="d-inline" onsubmit="return confirm('Delete client and their projects?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="add"><div class="modal-header"><h5>Add Client</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form">
<div class="mb-3"><label class="form-label">Full Name</label><input name="full_name" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" value="client123" required></div>
<div class="mb-3"><label class="form-label">Company</label><input name="company_name" class="form-control"></div>
<div class="mb-3"><label class="form-label">Phone</label><input name="phone" class="form-control"></div>
</div><div class="modal-footer"><button type="submit" class="btn btn-primary">Create Client</button></div></form></div></div></div>
<?php require_once 'includes/footer.php'; ?>
