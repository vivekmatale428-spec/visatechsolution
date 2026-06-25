<?php
/**
 * One-time setup — open in browser: http://localhost/ViSa%20Tech%20Soulution/setup.php
 * Delete this file after successful setup.
 */
$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'visatech_solutions';

header('Content-Type: text/html; charset=utf-8');

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
    ]);

    $sql = file_get_contents(__DIR__ . '/database/schema.sql');
    $pdo->exec($sql);

    $pdo->exec("USE `$dbName`");

    $adminHash = password_hash('admin123', PASSWORD_DEFAULT);
    $pdo->prepare('DELETE FROM admin WHERE username = ?')->execute(['admin']);
    $pdo->prepare('INSERT INTO admin (username, password, email) VALUES (?, ?, ?)')
        ->execute(['admin', $adminHash, 'admin@visatechsolutions.com']);

    $clientHash = password_hash('client123', PASSWORD_DEFAULT);
    $pdo->prepare('DELETE FROM clients WHERE email = ?')->execute(['demo@visatech.com']);
    $pdo->prepare('INSERT INTO clients (full_name, email, password, company_name, phone) VALUES (?, ?, ?, ?, ?)')
        ->execute(['Demo Client', 'demo@visatech.com', $clientHash, 'Demo Company', '9876543210']);

    $clientId = (int) $pdo->lastInsertId();
    $pdo->prepare('DELETE FROM project_tracking WHERE client_id = ?')->execute([$clientId]);
    $pdo->prepare(
        'INSERT INTO project_tracking (client_id, project_name, description, status, progress, notes)
         VALUES (?, ?, ?, ?, ?, ?)'
    )->execute([
        $clientId,
        'Business Website',
        'Corporate website with admin panel and contact form.',
        'Development',
        50,
        'Frontend completed. Backend integration in progress.',
    ]);

    foreach (['resumes', 'documents'] as $dir) {
        $path = __DIR__ . '/uploads/' . $dir;
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    echo '<!DOCTYPE html><html><head><title>Setup Complete</title>
    <style>body{font-family:Arial,sans-serif;max-width:600px;margin:40px auto;padding:20px;background:#0F172A;color:#fff}
    a{color:#38BDF8}code{background:#1E293B;padding:2px 8px;border-radius:4px}.ok{color:#4ade80}.warn{color:#fbbf24}</style></head><body>';
    echo '<h2 class="ok">Setup Complete!</h2>';
    echo '<p>Database <strong>' . htmlspecialchars($dbName) . '</strong> created with sample data.</p>';
    echo '<h3>Website</h3><p><a href="index.php">Open Homepage</a></p>';
    echo '<h3>Admin Panel</h3><p><a href="admin/index.php">admin/index.php</a><br>Username: <code>admin</code> | Password: <code>admin123</code></p>';
    echo '<h3>Client Dashboard (Demo)</h3><p><a href="client/login.php">client/login.php</a><br>Email: <code>demo@visatech.com</code> | Password: <code>client123</code></p>';
    echo '<p class="warn"><strong>Delete setup.php after setup for security!</strong></p>';
    echo '</body></html>';
} catch (PDOException $e) {
    echo '<!DOCTYPE html><html><head><title>Setup Error</title>
    <style>body{font-family:Arial,sans-serif;max-width:600px;margin:40px auto;padding:20px;background:#0F172A;color:#fff}
    .err{color:#f87171}</style></head><body>';
    echo '<h2 class="err">Setup Error</h2>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p>Make sure WAMP MySQL is running, then refresh this page.</p>';
    echo '</body></html>';
}
