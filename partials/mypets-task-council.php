<?php
require_once "config/constants.php";
enforce_login();


// Completes a task or reminder (behaviour depends on task_type parameter)
if (isset($_GET['task_type']) && isset($_GET['dog_id'])) {
    $user_id = get_userid();
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Council Registration</title>
</head>

<body>
<!-- Start main page body -->
<h1>Council Registration</h1>
<form method="POST" action="../form_submissions/complete-task.php">
    <label for="council-id">Registration ID (Numbers only)</label><br>
    <input type="text" id="council-id" name="task_data">
    <input type="hidden" name="task_type" value="<?php echo $_GET['task_type']; ?>">
    <input type="hidden" name="dog_id" value="<?php echo $_GET['dog_id']; ?>">
    <input type="hidden" name="close_on_submit" value="true">
    <br>
    <input type="submit" value="Submit">
</form>

</body>

</html>

<?php
}
?>