<?php
require_once "config/constants.php";
enforce_login();


// Completes a task or reminder (behaviour depends on task_type parameter)
if (isset($_GET['task_type']) && isset($_GET['dog_id'])) {
    $user_id = get_userid();
    // Get dog's name from its ID
    $sql = "SELECT name FROM dogs WHERE dog_id={$_GET['dog_id']}";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

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

<div class="popup-form-container" id="popupForm">
    <form method="POST" action="../form_submissions/complete-task.php" class="popup-form">
        <h3>Medication Reminder Setup for <?php echo $row['name'];?></h3>
        <label for="days">Days between <?php echo $medication_type;?> doses: </label>
        <input type="number" id="days" name="task_data" value=30>
        <input type="hidden" name="task_type" value="<?php echo $_GET['task_type']; ?>">
        <input type="hidden" name="dog_id" value="<?php echo $_GET['dog_id']; ?>">
        <input type="hidden" name="close_on_submit" value="true">
        <br>
        <button type="button" class="btn cancel" onclick="location.reload()">Cancel</button>
        <input type="submit" class="btn" value="Administer now">
    </form>
</div>


<?php
}
?>