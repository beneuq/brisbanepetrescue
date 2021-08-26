<?php
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'My Account';
        include('partials/head.php'); 
        $active_home = 'active';
        ?>
    </head>
    <body>
        <?php
            $firstname = $_SESSION['firstname']
        ?>
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

        <!-- Hero Section -->
        <section class="hero-section pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-bottom-1">My Account</h1>
                    <h2 class="pad-bottom-1">Welcome back, <?php echo $firstname ?>!</h2>
                    <p class="pad-bottom-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt, temporibus necessitatibus ad, magnam est facere? Cumque adipisci quis aliquam.</p>

                    <div class="pad-bottom-2">
                        <a href="#" class="margin-right-1 hero-btn">Available Dogs</a>
                        <a href="#" class="hero-btn hero-btn-alt">Personality Quiz</a>
                    </div>
                    <br>
                    <div class="pad-bottom-2">
                        <a href="logout.php" class="hero-btn hero-btn-alt">Logout</a>
                    </div>
                </div>
                <img class="hero-img" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down">
            </div>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>