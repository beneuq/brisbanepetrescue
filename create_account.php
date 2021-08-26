<?php
require_once "config/constants.php";

// Initialise form parameters
$email = "";
$username = "";
$password = "";
$dob = "";
$first_name = "";
$last_name = "";

// On form submission:
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $dob = $_POST["dob"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // TODO Validate all user inputs!
    //      I think mysqli has some functionality to escape characters but also check for blank inputs, etc.
    $sql = "INSERT INTO users (username, first_name, last_name, dob, email, password) VALUES (?, ?, ?, ?, ?, ?)";

    if($query = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($query, "ssssss", $username, $first_name, $last_name, $dob, $email, $password);

        // TODO Hash the password
        //$password = password_hash($password, PASSWORD_DEFAULT);

        if(mysqli_stmt_execute($query)) {
            // Send user to login page now
            alert_box("Thanks for signing up, $first_name!");
            header("Location: /login.php");
        } else {
            alert_box("Error creating account!");
        }
        mysqli_stmt_close($query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brisbane Pet Rescue | Sign Up</title>
    <!-- import generic head section -->
    <?php include('partials/head.php'); ?>
</head>


<!-- import menu -->
<?php include('partials/menu.php'); ?>
<!-- TODO @Front-end team please make my page look less bad :) -->


<body class="banner">
<h1>Create a New Account</h1>
    <div class="wrapper"> 
        <form action="create_account.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name;?>">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name;?>">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?php echo $dob;?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $username;?>">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $password;?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create Account">
            </div>
        </form>
    </div>
</body>
<!-- import footer -->
<?php include('partials/footer.php'); ?>


</html>