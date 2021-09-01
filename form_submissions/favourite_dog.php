<?php
require_once "../config/constants.php";
enforce_login();
// Adds an entry of user_id, dog_id in the favourite_dogs table, unless it already exists, in which case, delete it
if (isset($_POST['dog_id'])) {
    $user_id = get_userid();

    // Check for existing favourite entry
    $res = mysqli_query($conn,"SELECT * FROM favourite_dogs WHERE user_id = ".$user_id." AND dog_id = ".$_POST['dog_id']);
    if (mysqli_num_rows($res) < 1) {
        // Add the new favourite entry
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
    } else {
        // Un-favourite (Delete the favourite entry)
        $sql = "DELETE FROM favourite_dogs WHERE user_id = ".$user_id." AND dog_id = ".$_POST['dog_id'];
        if($query = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($query, "ss", $_SESSION["user_id"], $_POST['dog_id']);
            if (mysqli_stmt_execute($query)) {
                echo("Dog with ID = ".$_POST['dog_id']." un-favourited! for user ".$_SESSION['username']);
                header('Location: ../dogs.php');
            } else {
                alert_box("Error un-favouriting dog!");
                header('Location: ../dogs.php');
            }
            mysqli_stmt_close($query);
        }
    }
}