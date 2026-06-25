<?php
session_start();
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(url('careers.php'));
}

$careerId = (int) ($_POST['career_id'] ?? 0);
$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$coverLetter = trim($_POST['cover_letter'] ?? '');

if (!$careerId || empty($fullName) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setFlash('error', 'Please fill in all required fields correctly.');
    redirect(url('careers.php'));
}

if (!isset($_FILES['resume']) || $_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
    setFlash('error', 'Please upload your resume.');
    redirect(url('careers.php'));
}

$resumePath = uploadFile($_FILES['resume'], 'resumes');
if (!$resumePath) {
    setFlash('error', 'Invalid resume file. Please upload PDF or DOC format.');
    redirect(url('careers.php'));
}

try {
    $db = getDB();
    $stmt = $db->prepare(
        'INSERT INTO job_applications (career_id, full_name, email, mobile, resume_file, cover_letter)
         VALUES (:cid, :name, :email, :mobile, :resume, :cover)'
    );
    $stmt->execute([
        ':cid' => $careerId,
        ':name' => $fullName,
        ':email' => $email,
        ':mobile' => $mobile,
        ':resume' => $resumePath,
        ':cover' => $coverLetter,
    ]);
    setFlash('success', 'Application submitted successfully! We will review and get back to you.');
} catch (PDOException $e) {
    setFlash('error', 'Something went wrong. Please try again.');
}

redirect('careers.php');
