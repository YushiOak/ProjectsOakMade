<?php
$path = realpath(__DIR__."/../");
require_once("$path/Database/DatabaseConnection.php");

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or homepage
    header("Location: ../pages/login.php");
    exit();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or homepage
header("Location: ../pages/login.php");
exit();
?>