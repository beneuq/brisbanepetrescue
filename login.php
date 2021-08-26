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
    <!-- import generic head section -->
    <?php 
    $page_title = 'Login';
    include('partials/head.php'); 
    $active_login = 'active';
    ?>
</head>

<body class="banner">
    <?php include('partials/menu.php'); ?>
    <div id="top"></div>
    <div class="wrapper"> 
        <!-- import menu -->
        

        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="password_attempt">Password</label>
                <input type="password" id="password_attempt" name="password_attempt">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            
        </form>

    
        <p>Don't have an account?  
            <a href="create_account.php">Sign up now.</a>
        </p>
        
        
        
    </div>
    <div id="top"></div>
    <!-- import footer -->
    <?php include('partials/footer.php'); ?>

</body>
</html>