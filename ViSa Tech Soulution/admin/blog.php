<?php
$pageTitle = 'Blog Posts';
$currentAdminPage = 'blog';
require_once 'includes/header.php';
$db = getDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    if ($a === 'add' || $a === 'edit') {
        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '') ?: slugify($title);
        $d = [':t'=>$title,':s'=>$slug,':e'=>trim($_POST['excerpt']??''),':c'=>trim($_POST['content']??''),':a'=>trim($_POST['author']??'ViSaTech Solutions'),':p'=>(int)($_POST['is_published']??0)];
        if ($a==='add') $db->prepare('INSERT INTO blog_posts (title,slug,excerpt,content,author,is_published) VALUES (:t,:s,:e,:c,:a,:p)')->execute($d);
        else { $d[':id']=(int)$_POST['id']; $db->prepare('UPDATE blog_posts SET title=:t,slug=:s,excerpt=:e,content=:c,author=:a,is_published=:p WHERE id=:id')->execute($d); }
    }
    if ($a==='delete') $db->prepare('DELETE FROM blog_posts WHERE id=?')->execute([(int)$_POST['id']]);
    redirect('blog.php');
}
$rows = $db->query('SELECT * FROM blog_posts ORDER BY created_at DESC')->fetchAll();
?>
<div class="admin-topbar"><h2>Blog Posts</h2><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addM"><i class="bi bi-plus-lg"></i> Add Post</button></div>
<div class="admin-card"><div class="admin-card-body p-0"><table class="admin-table"><thead><tr><th>Title</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $b): ?><tr><td><?= sanitize($b['title']) ?></td><td><?= $b['is_published'] ? 'Published' : 'Draft' ?></td><td><?= date('M d,Y',strtotime($b['created_at'])) ?></td>
<td><button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#e<?= $b['id'] ?>"><i class="bi bi-pencil"></i></button>
<form method="POST" class="d-inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $b['id'] ?>"><button class="btn btn-sm btn-outline-danger btn-action"><i class="bi bi-trash"></i></button></form></td></tr>
<div class="modal fade" id="e<?= $b['id'] ?>"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="<?= $b['id'] ?>"><div class="modal-header"><h5>Edit Post</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php blogFields($b); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<div class="modal fade" id="addM"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST"><input type="hidden" name="action" value="add"><div class="modal-header"><h5>Add Post</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body admin-form"><?php blogFields(); ?></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button></div></form></div></div></div>
<?php function blogFields($b=[]): void { ?>
<div class="mb-3"><label class="form-label">Title</label><input name="title" class="form-control" value="<?= sanitize($b['title']??'') ?>" required></div>
<div class="mb-3"><label class="form-label">Slug</label><input name="slug" class="form-control" value="<?= sanitize($b['slug']??'') ?>" placeholder="auto-generated"></div>
<div class="mb-3"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2"><?= sanitize($b['excerpt']??'') ?></textarea></div>
<div class="mb-3"><label class="form-label">Content (HTML)</label><textarea name="content" class="form-control" rows="6" required><?= sanitize($b['content']??'') ?></textarea></div>
<div class="mb-3"><label class="form-label">Author</label><input name="author" class="form-control" value="<?= sanitize($b['author']??'ViSaTech Solutions') ?>"></div>
<div class="mb-3"><label class="form-label">Published</label><select name="is_published" class="form-control"><option value="0">Draft</option><option value="1" <?=($b['is_published']??0)?'selected':''?>>Published</option></select></div>
<?php } require_once 'includes/footer.php'; ?>
