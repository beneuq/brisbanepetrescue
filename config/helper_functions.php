<?php

/**
 * Shows a popup message in an alertbox
 * @param $msg - The Message to alert
 */
function alertBox($msg) {
    $msg = addslashes($msg);
    echo "<script>alert('$msg');</script>";
}

?>