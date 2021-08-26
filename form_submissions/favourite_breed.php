<?php
require_once "../config/constants.php";
enforce_login();
// Adds an entry of user_id, breed_id in the favourite_breeds table
if (isset($_POST['breed_id'])) {
    $sql = "INSERT INTO favourite_breeds (user_id, breed_id) VALUES (?, ?)";
    if($query = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($query, "ss", $_SESSION["user_id"], $_POST['breed_id']);
        if (mysqli_stmt_execute($query)) {
            echo("Breed with ID = ".$_POST['breed_id']." favourited! for user ".$_SESSION['username']);
            header('Location: ../breeds.php');
        } else {
            alert_box("Error favouriting breed!");
            header('Location: ../breeds.php');
        }
        mysqli_stmt_close($query);
    }
}