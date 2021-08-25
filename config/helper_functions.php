<?php

/**
 * Shows a popup message in an alert box
 * @param $msg - The Message to alert
 */
function alert_box($msg) {
    $msg = addslashes($msg);
    echo "<script>alert('$msg');</script>";
}

