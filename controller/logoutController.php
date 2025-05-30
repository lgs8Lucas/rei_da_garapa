<?php
// LogoutController.php
session_start();
if (isset($_SESSION['user_id'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page or home page
    header('Location: ./../pages/loginPage.php');
    exit();
} else {
    // If no user is logged in, redirect to login page
    header('Location: ./../pages/loginPage.php');
    exit();
}