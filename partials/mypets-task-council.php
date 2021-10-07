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
    ?>

<div class="popup-form-container" id="popupForm">
    <form method="POST" action="../form_submissions/complete-task.php" class="popup-form">
        <h3>Council Registration</h3>
        <label for="council-id">Enter <?php echo $row['name'];?>'s Registration ID (Numbers only)</label><br>
        <input type="text" id="council-id" name="task_data">
        <input type="hidden" name="task_type" value="<?php echo $_GET['task_type']; ?>">
        <input type="hidden" name="dog_id" value="<?php echo $_GET['dog_id']; ?>">
        <br>
        <button type="button" class="btn cancel" onclick="location.reload()">Cancel</button>
        <input type="submit" class="btn" value="Submit">
    </form>
</div>
<?php
}
?>