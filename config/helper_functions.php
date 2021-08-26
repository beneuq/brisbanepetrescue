<?php

/**
 * Shows a popup message in an alert box
 * @param $msg - The Message to alert
 */
function alert_box($msg) {
    $msg = addslashes($msg);
    echo "<script>alert('$msg');</script>";
}

/**
 * Redirects the user to login page if they are not logged in, otherwise does nothing.
 */
function enforce_login() {
    if (!isset($_SESSION['logged_in'])) {
        // User not logged in, redirect them to login page
        header("Location: /login.php");
        exit();
    }
}