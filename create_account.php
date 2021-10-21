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
    // First check if any fields are empty
    if(isset($first_name) && !empty($first_name) AND isset($last_name) && !empty($last_name) AND isset($email) && !empty($email) AND 
    isset($dob) && !empty($dob) AND isset($username) && !empty($username) AND isset($password) && !empty($password)) {
        // No fields were empty so we can begin to check them
        
        // Check the email address is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // alert_box("email goodo");

            // Let's also check if the user is already in the database
            $sql = "SELECT user_id, first_name, password FROM users WHERE username LIKE ?";
            
            // Preparing the SQL query
            if($query = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($query, "s", $username);

                // Execute the query and store result, then check if password is correct
                if(mysqli_stmt_execute($query)) {
                    mysqli_stmt_store_result($query);

                    // A matching username was found
                    if(mysqli_stmt_num_rows($query)) {
                        $userError = 'Username is already taken. Please enter another username.';
                    } else {
                        // Check the password has a capital letter and number by checking each letter in password
                        $isCapital = 0;
                        $isNumber = 0;
                        $isLength = 0;
                        for ($i = 0; $i <= strlen($password) - 1; $i++) {
                            // Check if character is a capital letter
                            if (ctype_upper($password{$i})) {
                                // say a capital was found
                                $isCapital = 1;
                            }

                            // Check if character is a number
                            if (ctype_digit($password{$i})) {
                                // say a number was found
                                $isNumber = 1;
                            } 

                            // Add to length
                            $isLength++;
                        }

                        
                        // Now let's check if a capital letter, number and length criterias were met
                        if ($isCapital == 1 AND $isNumber == 1 AND $isLength >= 8) {
                            // alert_box("Pog");
                            // Insert the user into the database
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
                                    alert_box("There was an error creating account. Please try again later.");
                                }
                                
                                mysqli_stmt_close($query);
                            }
                        } else {
                            $passwordError = 'You require a stronger password. Ensure your password is of a minimum length of 8 characters and includes a capital letter and a number';
                        }

                        
                    }
                }
            }

            mysqli_stmt_close($query);
                        
         

            
        } else {
            // Set the email error
            $emailError = 'The email you have entered is invalid. Please try again with a valid email';

            // Let's also check if the user is already in the database
            $sql = "SELECT user_id, first_name, password FROM users WHERE username LIKE ?";

            // Preparing the SQL query
            if($query = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($query, "s", $username);

                // Execute the query and store result, then check if password is correct
                if(mysqli_stmt_execute($query)) {
                    mysqli_stmt_store_result($query);

                    // A matching username was found
                    if(mysqli_stmt_num_rows($query)) {
                        $userError = 'Username is already taken. Please enter another username.';
                    }
                }
            }
        }
        
        
            //      I think mysqli has some functionality to escape characters but also check for blank inputs, etc.
        // $sql = "INSERT INTO users (username, first_name, last_name, dob, email, password) VALUES (?, ?, ?, ?, ?, ?)";

        // if($query = mysqli_prepare($conn, $sql)) {
        //     mysqli_stmt_bind_param($query, "ssssss", $username, $first_name, $last_name, $dob, $email, $password);

        //     // TODO Hash the password
        //     //$password = password_hash($password, PASSWORD_DEFAULT);

        //     if(mysqli_stmt_execute($query)) {
        //         // Send user to login page now
        //         alert_box("Thanks for signing up, $first_name!");
        //         header("Location: /login.php");
        //     } else {
        //         alert_box("There was an error creating account. Please try again later.");
        //     }
        //     mysqli_stmt_close($query);
        // }
   // }
    } else {
        // There are blank fields so ask them to fill in the fields
        $emptyError = 'You have not completed all the fields. Please fill in all account information.';
    }
    
}    

?>

<!DOCTYPE html>
<html lang="en">

<body class="banner">
<div id="top"></div>
<head>
    <title>Brisbane Pet Rescue | Sign Up</title>
    <!-- import generic head section -->
    <?php include('partials/head.php'); ?>
</head>



<div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

    <div id="create-account" class="wrapper container">   
        <form action="create_account.php" method="post">
            <fieldset class ="input-card">
                <legend>Create a New Account</legend>
                <?php 
                    // Check if the email is an error and print the message
                    if(isset($emptyError)){
                        echo '<div class="statusmsg">'.$emptyError.'</div>';
                    } 
                ?>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $first_name;?>">
                </div>

                <div class="form-group">
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
                <?php 
                    // Check if the email is an error and print the message
                    if(isset($emailError)){
                        echo '<div class="statusmsg">'.$emailError.'</div>';
                    } 
                ?>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $username;?>">
                </div>
                <?php 
                    // Check if the username is an error and print the message
                    if(isset($userError)){
                        echo '<div class="statusmsg">'.$userError.'</div>';
                    } 
                ?>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo $password;?>">
                </div>
                <?php 
                    // Check if the password is an error and print the message
                    if(isset($passwordError)){
                        echo '<div class="statusmsg">'.$passwordError.'</div>';
                    } 
                ?>
                <div class="form-group">
                    <input type="submit" class="submit-btn" value="Create Account">
                </div>
            </fieldset>
        </form>
        
    </div>
</body>
<!-- import footer -->
<?php include('partials/footer.php'); ?>


</html>