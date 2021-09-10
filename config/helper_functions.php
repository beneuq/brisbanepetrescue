<?php

/**
 * Shows a popup message in an alert box
 * @param $msg - The Message to alert
 */
function alert_box($msg) {
    $msg = addslashes($msg);
    echo "<script>alert('$msg');</script>";
}

/** Returns true if user is logged in, false otherwise */
function logged_in() {
    return isset($_SESSION['logged_in']);
}

/** Returns the user's user_id */
function get_userid() {
    return $_SESSION['user_id'];
}

/** Reverses classes (1 becomes 5, 5 becomes 1, etc.) */
function reverse1to5($num) {
    return 6 - $num;
}

/**
 * Redirects the user to login page if they are not logged in, otherwise does nothing.
 */
function enforce_login() {
    if (!logged_in()) {
        // User not logged in, redirect them to login page
        header("Location: /login.php?display-error");
        exit();
    }
}
