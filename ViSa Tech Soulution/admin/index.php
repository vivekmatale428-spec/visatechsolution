<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';

if (isAdminLoggedIn()) redirect('dashboard.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    try {
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM admin WHERE username = :u LIMIT 1');
        $stmt->execute([':u' => $username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            redirect('dashboard.php');
        }
        $error = 'Invalid username or password.';
    } catch (PDOException $e) {
        $error = 'Database error. Run setup.php first.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | ViSaTech Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body class="admin-body">
<div class="login-page">
    <div class="login-card">
        <div class="text-center mb-4"><i class="bi bi-shield-lock text-primary" style="font-size:2.5rem"></i></div>
        <h3>Admin Login</h3>
        <p class="subtitle">ViSaTech Solutions Admin Panel</p>
        <?php if ($error): ?><div class="alert alert-danger py-2"><?= sanitize($error) ?></div><?php endif; ?>
        <form method="POST" class="admin-form">
            <div class="mb-3"><label class="form-label">Username</label><input type="text" name="username" class="form-control" required autofocus></div>
            <div class="mb-4"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-box-arrow-in-right me-2"></i>Login</button>
        </form>
    </div>
</div>
</body>
</html>
