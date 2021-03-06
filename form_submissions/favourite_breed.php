<?php
require_once "config/constants.php";
enforce_login();
// Adds an entry of user_id, breed_id in the favourite_breeds table, unless it already exists, in which case, delete it
if (isset($_POST['breed_id'])) {
    $user_id = get_userid();

    // Check for existing favourite entry
    $res = mysqli_query($conn,"SELECT * FROM favourite_breeds WHERE user_id = ".$user_id." AND breed_id = ".$_POST['breed_id']);
    if (mysqli_num_rows($res) < 1) {
        // Add the new favourite entry
        $sql = "INSERT INTO favourite_breeds (user_id, breed_id) VALUES (?, ?)";
        if($query = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($query, "ss", $_SESSION["user_id"], $_POST['breed_id']);
            if (mysqli_stmt_execute($query)) {
                echo("Breed with ID = ".$_POST['breed_id']." favourited! for user ".$_SESSION['username']);
            } else {
                alert_box("Error favouriting breed!");
            }
            mysqli_stmt_close($query);
        }
    } else {
        // Un-favourite (Delete the favourite entry)
        $sql = "DELETE FROM favourite_breeds WHERE user_id = ".$user_id." AND breed_id = ".$_POST['breed_id'];
        if($query = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($query, "ss", $_SESSION["user_id"], $_POST['breed_id']);
            if (mysqli_stmt_execute($query)) {
                echo("Breed with ID = ".$_POST['breed_id']." un-favourited! for user ".$_SESSION['username']);
            } else {
                alert_box("Error un-favouriting breed!");
            }
            mysqli_stmt_close($query);
        }
    }
}
// Send user back to exactly where they were on the previous page
if (strpos($_SERVER['HTTP_REFERER'], 'account.php') !== false) {
    // User came from account page
    header('Location: '.$_SERVER['HTTP_REFERER'].'#fav-breeds');
} else {
    // User came from breeds page
    header('Location: '.$_SERVER['HTTP_REFERER'].'#breed_id='.$_POST['breed_id']);
}
