<?php
require_once "../config/constants.php";
enforce_login();
// Adds an entry of user_id, dog_id in the favourite_dogs table, unless it already exists, in which case, delete it
if (isset($_GET['dog_id'])) {
    $user_id = get_userid();

    // Mark dog as adopted, so it does not appear in master list
    $sql = "
        UPDATE dogs 
        SET 
            owner_id = ".$user_id.", 
            adoption_date = SYSDATE()
        WHERE dog_id = ".$_GET['dog_id'];

    if (mysqli_query($conn, $sql)) {
        echo("Owner updated");
    } else {
        alert_box("Error updating owner!");
    }
    mysqli_close($conn);
}
// Send user to My Pets page
header('Location: /mypets.php');
