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
    <section id="account-page-hero" class="hero-section pos-relative dimmer-sm">
        <div class="flex container">
            <div class="flex f-col hero-content bg-img">
                <h1 class="pad-top-2 pad-bottom-1">My Account</h1>
                <?php
                // display users dogs if they have any
                if (user_owns_dogs()) {
                ?>
                    <h2 class="pad-bottom-1">Welcome back, <?php echo $firstname ?>!</h2>
                    <p class="pad-bottom-2">Check up on your pet care reminders, find a new companion, or check out some articles below.</p>
                    <div class="btn-group margin-bottom-2">
                        <a href="/mypets.php" class="margin-right-1 hero-btn">My pets</a>
                        <a href="/dogs.php" class="margin-right-1 hero-btn hero-btn-alt">Explore dogs</a>
                    </div>
                <?php
                    // display prompt to perform quiz if they don't have any pets
                } else {
                ?>
                    <h2 class="margin-bottom-1">Welcome, <?php echo $firstname ?>!</h2>
                    <p>Time to get the ball rolling on your pet adoption? We recommend starting with a personality quiz to find a breed that matches your lifestyle. You can also save breeds to your favorites, or keep a shortlist of dogs you can come back to at any time! </p>
                    <div class="btn-group margin-top-1 pad-bottom-2">
                        <a href="/quiz.php" class="margin-right-1 hero-btn">Personality Quiz</a>
                        <a href="/dogs.php" class="margin-right-1 hero-btn hero-btn-alt">Explore dogs</a>
                    </div>
                <?php
                }
                ?>
                <!-- Call to action buttons -->
                <div class="btn-group pad-bottom-2">
                    <a href="logout.php" class="margin-right-1 hero-btn">Log out</a>
                    <a href="/favourites.php" class="margin-right-1 hero-btn hero-btn-alt">View favourites</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Show some pet care RSS feeds -->
    <?php include('partials/rss-feeds.php'); ?>

    <!-- FOOTER -->
    <?php include('partials/footer.php'); ?>
</body>

</html>