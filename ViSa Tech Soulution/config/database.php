<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'visatech_solutions');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('SITE_NAME', 'ViSaTech Solutions');
define('SITE_TAGLINE', 'Transforming Ideas Into Digital Solutions');
define('SITE_URL', 'http://localhost/ViSa%20Tech%20Soulution');
define('SITE_EMAIL', 'info@visatechsolutions.com');
define('CONTACT_EMAIL', 'contact@visatechsolutions.com');

define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', 'uploads/');

define('PROJECT_STATUSES', [
    'Requirement Analysis',
    'UI Design',
    'Development',
    'Testing',
    'Deployment',
    'Completed',
]);

function getDB(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Unknown database') !== false) {
                die('<div style="font-family:Arial;max-width:500px;margin:80px auto;padding:30px;background:#0F172A;color:#fff;border-radius:12px;text-align:center">
                <h2 style="color:#38BDF8">Database Not Set Up</h2>
                <p>Please run setup first:</p>
                <p><a href="' . url('setup.php') . '" style="color:#38BDF8">' . url('setup.php') . '</a></p>
                <p style="color:#94A3B8;font-size:14px">Make sure WAMP MySQL is running (green icon).</p></div>');
            }
            throw $e;
        }
    }
    return $pdo;
}
