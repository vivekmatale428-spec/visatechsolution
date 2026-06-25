<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';

if (isClientLoggedIn()) {
    redirect(url('client/dashboard.php'));
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM clients WHERE email = :email AND is_active = 1 LIMIT 1');
        $stmt->execute([':email' => $email]);
        $client = $stmt->fetch();

        if ($client && password_verify($password, $client['password'])) {
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['client_name'] = $client['full_name'];
            redirect(url('client/dashboard.php'));
        } else {
            $error = 'Invalid email or password. Use demo@visatech.com / client123 or contact admin for access.';
        }
    } catch (PDOException $e) {
        $error = 'Unable to connect. Please ensure the database is set up.';
    }
}

$pageTitle = 'Client Login | ViSaTech Solutions';
$currentPage = 'client';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="client-dashboard">
    <div class="container">
        <div class="client-login-card fade-up">
            <div class="text-center mb-4">
                <span class="brand-icon d-inline-flex mb-3"><span class="vs-logo">VS</span></span>
                <h3>Client Dashboard</h3>
                <p class="text-muted">Login to view your project status and documents</p>
            </div>

            <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?= sanitize($error) ?></div>
            <?php endif; ?>

            <div class="alert alert-info py-2 mb-3" style="font-size:0.85rem">
                <strong>Demo login:</strong> demo@visatech.com / client123
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
            <p class="text-center text-muted mt-3 mb-0" style="font-size:0.85rem">
                Contact us at <?= CONTACT_EMAIL ?> for client access
            </p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
