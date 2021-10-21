<?php
require_once "config/constants.php";
enforce_login();


// Completes a task or reminder (behaviour depends on task_type parameter)
if (isset($_POST['task_type']) && isset($_POST['dog_id'])) {
    $user_id = get_userid();

    /** Gets extra POST parameter 'task_data', or errors if param was not passed. */
    function get_extra_param() {
        if (isset($_POST['task_data'])) {
            return $_POST['task_data'];
        } else {
            alert_box("Error! Task type {$_POST['task_type']} requires an extra 'task_data' parameter.");
            header('Location: /mypets.php');
            return false;
        }
    }

    // Validate the dog_id input
    if (!is_numeric($_POST['dog_id'])) {
        alert_box("Error! Invalid dog_id");
        header('Location: /mypets.php');
    } else {
        $dog_id = $_POST['dog_id'];
    }

    // Note current date in case needed as param
    $today = date('Y-m-d');

    $sql = "";
    switch ($_POST['task_type']) {
        case "desexed": // Set desexed field to true
            $sql = "UPDATE dogs SET desexed=1 WHERE dog_id={$dog_id}";
            break;
        case "vaccinated": // Set vaccinated field to true
            $sql = "UPDATE dogs SET vaccinated=1 WHERE dog_id={$dog_id}";
            break;
        case "council_registration_id": // Set council_registration_id to task_data
            $council_reg_id = get_extra_param();
            if (is_numeric($council_reg_id)) {
                $sql = "UPDATE dogs SET council_registration_id={$council_reg_id} WHERE dog_id={$dog_id}";
            } else {
                alert_box("Error! Invalid council registration ID.");
                header('Location: /mypets.php');
            }
            break;
        case "birthday":
            break;
        case "worm_meds_due": // Set last_worming_medication field to current date
            $sql = "UPDATE dogs SET last_worming_medication='{$today}' WHERE dog_id={$dog_id}";
            break;
        case "tick_meds_due": // Set last_tick_medication field to current date
            $sql = "UPDATE dogs SET last_tick_medication='{$today}' WHERE dog_id={$dog_id}";
            break;
        case "worm_meds_start": // Set last_worming_medication field to current date and worming_medication_frequency to task_data
            $meds_interval = get_extra_param();
            if (is_numeric($meds_interval)) {
                $sql = "UPDATE dogs SET last_worming_medication='{$today}', worming_medication_frequency={$meds_interval} WHERE dog_id={$dog_id}";
            } else {
                alert_box("Error! Invalid medication interval.");
                header('Location: /mypets.php');
            }
            break;
        case "tick_meds_start": // Set last_tick_medication field to current date and tick_medication_frequency to task_data
            $meds_interval = get_extra_param();
            $today = date('Y-m-d');
            if (is_numeric($meds_interval)) {
                $sql = "UPDATE dogs SET last_tick_medication='{$today}', tick_medication_frequency={$meds_interval} WHERE dog_id={$dog_id}";
            } else {
                alert_box("Error! Invalid medication interval.");
                header('Location: /mypets.php');
            }
            break;
        default:
            alert_box("Error! Task type {$_POST['task_type']} not recognised.");
    }

    error_log("Running SQL: ".$sql);
    if (mysqli_query($conn, $sql)) {
        echo("Task completed");
    } else {
        alert_box("Error! Failed to complete task {$_POST['task_type']} for dog_id={$dog_id}");
    }
    mysqli_close($conn);
}

// Send user back to My Pets page or close popup window
header('Location: /mypets.php');

