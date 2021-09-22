<?php
require_once "../config/constants.php";
enforce_login();


// Completes a task or reminder (behaviour depends on task_type parameter)
if (isset($_GET['task_type']) && isset($_GET['dog_id'])) {
    $user_id = get_userid();

    switch ($_GET['task_type']) {
        case "worm_meds_start":
            $medication_type = "Worming";
            break;
        case "tick_meds_start":
            $medication_type = "Tick";
            break;
        default:
            alert_box("Error! Task type {$_POST['task_type']} not recognised.");
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medication Reminder</title>
</head>

<body>
<!-- Start main page body -->
<h1>Medication Reminder Setup</h1>
<form method="POST" action="../form_submissions/complete-task.php">
    <label for="days">Days between <?php echo $medication_type;?> doses: </label>
    <input type="number" id="days" name="task_data" value=30>
    <input type="hidden" name="task_type" value="<?php echo $_GET['task_type']; ?>">
    <input type="hidden" name="dog_id" value="<?php echo $_GET['dog_id']; ?>">
    <input type="hidden" name="close_on_submit" value="true">
    <br>
    <input type="submit" value="Administer first dose now">
</form>

</body>

</html>

<?php
}
?>