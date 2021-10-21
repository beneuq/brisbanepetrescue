<?php
    include_once "config/constants.php";
/**
 * This file is designed to be called from mypets.php.
 * It is the logic that runs prior to the table creation.
 * It runs an SQL query and then populates arrays for the tasks and reminders data
 */
// Empty arrays to fill with task and reminder associative arrays
$post_adopt_tasks = array();
$reminders = array();
$pet_count = 0;

// Gets all dogs, as well as their shelter, and also whether the dog has been shortlisted by the logged-in user
$res = mysqli_query($conn, "
    SELECT DISTINCT
        name,
        age,
        DATE_ADD(adoption_date, INTERVAL YEAR(CURDATE())-YEAR(adoption_date) + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(adoption_date),1,0) YEAR) as next_adoption_anniversary,   
        DATEDIFF(DATE_ADD(adoption_date, INTERVAL YEAR(CURDATE())-YEAR(adoption_date) + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(adoption_date),1,0) YEAR), SYSDATE()) as days_to_adoption_anniversary,   
        DATE_ADD(dob, INTERVAL YEAR(CURDATE())-YEAR(dob) + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(dob),1,0) YEAR) as next_birthday,   
        DATEDIFF(DATE_ADD(dob, INTERVAL YEAR(CURDATE())-YEAR(dob) + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(dob),1,0) YEAR), SYSDATE()) as days_to_birthday,   
        desexed,
        vaccinated,
        council_registration_id,
        dog_id,
        DATE_ADD(last_worming_medication, INTERVAL worming_medication_frequency DAY) as worm_meds_date,
        DATEDIFF(DATE_ADD(last_worming_medication, INTERVAL worming_medication_frequency DAY), SYSDATE()) as worm_meds_due,
        DATE_ADD(last_tick_medication, INTERVAL tick_medication_frequency DAY) as tick_meds_date,
        DATEDIFF(DATE_ADD(last_tick_medication, INTERVAL tick_medication_frequency DAY), SYSDATE()) as tick_meds_due
        FROM dogs
        WHERE owner_id=". get_userid()."
        ORDER BY name
");

// Populate tasks and reminders from data returned by SQL query
while($entry = mysqli_fetch_array($res)) {
    $pet_count++;
    // Check council registration status
    if (is_null($entry['council_registration_id'])) {
        // No council registration id recorded yet, add as task
        $task = array(
            "text" => "Register {$entry['name']} with your local council",
            "dog_id" => $entry['dog_id'],
            "dog_name" => $entry['name'],
            "type" => "council_registration_id",
        );
        array_push($post_adopt_tasks, $task);
    }

    // Check vaccination status
    if (!$entry['vaccinated']) {
        // Not vaccinated yet, add as task
        $task = array(
            "text" => "Vaccinate {$entry['name']} at your local vet",
            "dog_id" => $entry['dog_id'],
            "dog_name" => $entry['name'],
            "type" => "vaccinated",
        );
        array_push($post_adopt_tasks, $task);
    }

    // Check if desexed
    if (!$entry['desexed']) {
        // Not desexed yet, add as task
        $task = array(
            "text" => "Get {$entry['name']} de-sexed at your local vet",
            "dog_id" => $entry['dog_id'],
            "dog_name" => $entry['name'],
            "type" => "desexed",
        );
        array_push($post_adopt_tasks, $task);
    }

    // Check if birthday approaching
    $ordinal_age = ordinal($entry['age']); // 8 becomes "8th", 2 becomes "2nd"
    if ($entry['days_to_birthday'] == 0) {
        // Birthday is today
        $reminder = array(
            "text"=>"Happy {$ordinal_age} Birthday, {$entry['name']}!",
            "date"=>$entry['next_birthday'],
            "days"=>$entry['days_to_birthday'],
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"birthday",
            "cell_class"=>"overdueReminder"
        );
        array_push($reminders, $reminder);
    } else if ($entry['days_to_birthday'] < 300) {
        // Birthday is approaching
        $reminder = array(
            "text"=>"{$entry['name']}'s {$ordinal_age} birthday",
            "date"=>$entry['next_birthday'],
            "days"=>$entry['days_to_birthday'],
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"birthday",
            "cell_class"=>"regularReminder"
        );
        array_push($reminders, $reminder);
    }

    // Check worming medication status
    if (is_null($entry['worm_meds_due'])) {
        // No worm meds data yet, add as task
        $task = array(
            "text"=>"Start {$entry['name']} on de-worming medication",
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"worm_meds_start",
        );
        array_push($post_adopt_tasks, $task);
    } else if ($entry['worm_meds_due'] < 0) {
        // Worm meds are overdue, add to reminders and style differently
        $reminder = array(
            "text"=>"{$entry['name']}'s de-worming medication is overdue!",
            "date"=>$entry['worm_meds_date'],
            "days"=>$entry['worm_meds_due'],
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"worm_meds_due",
            "cell_class"=>"overdueReminder"
        );
        array_push($reminders, $reminder);
    } else {
        // Worm meds not due yet, but add to reminders
        $reminder = array(
            "text"=>"{$entry['name']} is due for de-worming medication",
            "date"=>$entry['worm_meds_date'],
            "days"=>$entry['worm_meds_due'],
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"worm_meds_due",
            "cell_class"=>"regularReminder"
        );
        array_push($reminders, $reminder);
    }

    // Check tick medication status
    if (is_null($entry['tick_meds_due'])) {
        // No tick meds data yet, add as task
        $task = array(
            "text"=>"Start {$entry['name']} on tick medication",
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"tick_meds_start",
        );
        array_push($post_adopt_tasks, $task);
    } else if ($entry['tick_meds_due'] < 0) {
        // Tick meds are overdue, add to reminders and style differently
        $reminder = array(
            "text"=>"{$entry['name']}'s tick medication is overdue!",
            "date"=>$entry['tick_meds_date'],
            "days"=>$entry['tick_meds_due'],
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"tick_meds_due",
            "cell_class"=>"overdueReminder"
        );
        array_push($reminders, $reminder);
    } else {
        // Tick meds not due yet, but add to reminders
        $reminder = array(
            "text"=>"{$entry['name']} is due for tick medication",
            "date"=>$entry['tick_meds_date'],
            "days"=>$entry['tick_meds_due'],
            "dog_id"=>$entry['dog_id'],
            "dog_name" => $entry['name'],
            "type"=>"tick_meds_due",
            "cell_class"=>"regularReminder"
        );
        array_push($reminders, $reminder);
    }
}
// Sort reminders by nearest approaching
usort($reminders, function ($item1, $item2) {
    return $item1['days'] <=> $item2['days'];
});

// Exclude any reminders that are more than REMINDER_DAYS_TO_SHOW away
$reminders_soon = array_filter($reminders, function ($x) { return $x['days'] <= REMINDER_DAYS_TO_SHOW; });