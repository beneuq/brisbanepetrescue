<?php
require_once "config/constants.php";
require "config/helper_functions.php";

$username = "";
$password_attempt = "";

// On form submission:
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password_attempt = $_POST["password_attempt"];

    // TODO Validate all user inputs!
    $sql = "SELECT first_name, password FROM users WHERE username LIKE ?";

    if($query = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($query, "s", $username);

        // TODO use hashing

        // Execute the query and store result, then check if password is correct
        if(mysqli_stmt_execute($query)) {
            mysqli_stmt_store_result($query);
            if(mysqli_stmt_num_rows($query)) { // A matching username was found
                mysqli_stmt_bind_result($query, $first_name, $password);
                mysqli_stmt_fetch($query);
                if ($password_attempt == $password) {
                    header("Location: https://pics.me.me/whats-the-password-is-it-dog-muffled-meeting-behind-the-63634880.png");
                } else {
                    alert_box("Login failed! $first_name's password is actually $password");
                }
            } else {
                alert_box("No user found matching the username: $username");
            }
        } else {
            alert_box("SQL Error!");
        }
        mysqli_stmt_close($query);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brisbane Pet Rescue | Login</title>
    <!-- import generic head section -->
    <?php include('partials/head.php'); ?>
</head>

<body>
<!-- import menu -->
<?php include('partials/menu.php'); ?>

<h1>Log in to your Account</h1>
<form action="login.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="<?php echo $username;?>">
    <br>
    <label for="password_attempt">Password</label>
    <input type="password" id="password_attempt" name="password_attempt" value="<?php echo $password_attempt;?>">
    <br><br>
    <input type="submit" class="btn btn-primary" value="Login">
</form>

<br>
<h2> New User?</h2>
<p><a href="create_account.php">Click here</a> to create a new account!</p>

<!-- import footer -->
<?php include('partials/footer.php'); ?>
</body>

</html>