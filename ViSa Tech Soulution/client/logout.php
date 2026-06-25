<?php
session_start();
unset($_SESSION['client_id'], $_SESSION['client_name']);
require_once __DIR__ . '/../includes/functions.php';
redirect(url('client/login.php'));
