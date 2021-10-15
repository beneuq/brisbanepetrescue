<?php
include_once "constants.php";

/**
 * Shows a popup message in an alert box
 * @param $msg - The Message to alert
 */
function alert_box($msg) {
    $msg = addslashes($msg);
    echo "<script>alert('$msg');</script>";
}

/** Returns true if user is logged in, false otherwise */
function logged_in(): bool
{
    return isset($_SESSION['logged_in']);
}

/** Returns the user's user_id */
function get_userid() {
    return $_SESSION['user_id'];
}

/** Reverses classes (1 becomes 5, 5 becomes 1, etc.) */
function reverse1to5($num) {
    return 6 - $num;
}

/** Redirects the user to login page if they are not logged in, otherwise does nothing. */
function enforce_login() {
    if (!logged_in()) {
        // User not logged in, redirect them to login page
        header("Location: /login.php?display-error");
        exit();
    }
}

/**
 * From https://stackoverflow.com/questions/3109978/display-numbers-with-ordinal-suffix-in-php
 * Returns the ordinal format for a number (e.g. 1 becomes "1st", 2 becomes "2nd", etc.)
 */
function ordinal($number): string
{
    $suffix = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $suffix[$number % 10];
}

/** Check if user owns any dogs */
function user_owns_dogs(): bool
{
    enforce_login();
    $user_id = get_userid();
    global $conn;
    $sql = "SELECT * from dogs WHERE owner_id={$user_id}";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    return $count > 0;
}

/** Get list of unique breeds owned by user */
function get_user_breeds(): array
{
    enforce_login();
    $user_id = get_userid();
    $my_breeds = array();
    global $conn;
    $sql = "SELECT DISTINCT Breed FROM dog_breeds INNER JOIN dogs ON dogs.breed_id=dog_breeds.breed_id WHERE owner_id={$user_id}";
    $res = mysqli_query($conn, $sql);
    while($entry = mysqli_fetch_array($res)) {
        array_push($my_breeds, $entry['Breed']);
    }
    return $my_breeds;
}
