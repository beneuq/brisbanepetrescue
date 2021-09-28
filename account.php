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
        ?>
    </head>
    <body>
        <?php
            $firstname = $_SESSION['firstname'];
            $user_id = $_SESSION['user_id']
        ?>
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

        <!-- Hero Section -->
        <section id="main-hero" class="hero-section pos-relative dimmer-sm">
            <div class="flex container">
                <div class="flex f-col hero-content bg-img">
                    <h1 class="pad-top-2 pad-bottom-1">My Account</h1>
                    <h2 class="pad-bottom-1">Welcome back, <?php echo $firstname ?>!</h2>
                    <p class="pad-bottom-2">Here, we understand the struggles of finding the perfect K-9 companion. Browse through the availabe dogs straight away or do a short quiz to find the perfect pet for you.</p>

                    <div class="btn-group pad-bottom-2">
                        <a href="dogs.php" class="margin-right-1 hero-btn">Available Dogs</a>
                        <a href="/quiz.php" class="hero-btn hero-btn-alt">Personality Quiz</a>
                    </div>
                    <div class="pad-bottom-2">
                        <a href="logout.php" class="hero-btn hero-btn-alt">Logout</a>
                    </div>
                </div>
                <!-- <img class="home-hero-img margin-top-2" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down"> -->
            </div>

        </section>

        <!-- Show some pet care RSS feeds -->
        <?php include('partials/rss-feeds.php'); ?>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>