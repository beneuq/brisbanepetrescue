<?php
require_once "../config/constants.php";
enforce_login();
// Adds an entry of user_id, dog_id in the favourite_dogs table
if (isset($_POST['dog_id'])) {
    $sql = "INSERT INTO favourite_dogs (user_id, dog_id) VALUES (?, ?)";
    if($query = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($query, "ss", $_SESSION["user_id"], $_POST['dog_id']);
        if (mysqli_stmt_execute($query)) {
            echo("Dog with ID = ".$_POST['dog_id']." favourited! for user ".$_SESSION['username']);
            header('Location: ../dogs.php');
        } else {
            alert_box("Error favouriting dog!");
            header('Location: ../dogs.php');
        }
        mysqli_stmt_close($query);
    }
}