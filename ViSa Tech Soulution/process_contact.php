<?php
session_start();
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(url('contact.php'));
}

$name = trim($_POST['full_name'] ?? $_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? $_POST['phone'] ?? '');
$service = trim($_POST['service_required'] ?? $_POST['project_type'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];
if (empty($name)) $errors[] = 'Full name is required.';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
if (empty($message)) $errors[] = 'Message is required.';

if (!empty($errors)) {
    setFlash('error', implode(' ', $errors));
    redirect(url('contact.php'));
}

try {
    $db = getDB();
    $stmt = $db->prepare(
        'INSERT INTO contact_messages (full_name, email, mobile, service_required, message)
         VALUES (:name, :email, :mobile, :service, :message)'
    );
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':mobile' => $mobile,
        ':service' => $service,
        ':message' => $message,
    ]);
    setFlash('success', 'Thank you! We will get back to you within 24 hours.');
} catch (PDOException $e) {
    setFlash('error', 'Something went wrong. Please email us at ' . CONTACT_EMAIL);
}

redirect(url('contact.php'));
