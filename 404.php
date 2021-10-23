<!DOCTYPE html>
<html lang="en">
<head>
    <!-- import generic head section -->
    <?php
    $page_title = 'Home';
    include('partials/head.php');
    $active_home = 'active';
    ?>
    <link rel="stylesheet" href="js/aos/aos.css">
</head>

<body>
<div class="underneath-nav"></div>
<!-- import menu -->
<?php include('partials/menu.php'); ?>

<!-- Hero Section -->
<section id="hero-error" class="hero-section pos-relative dimmer-sm">
    <div class="flex container">
        <div class="flex f-col hero-content bg-img">
            <h1 class="pad-top-2 pad-bottom-1">Page under construction</h1>
            <h2 class="pad-bottom-1">Uh-oh - That page isn't finished yet!</h2>
            <p class="pad-bottom-2">Return back to our homepage, or get in touch if you think we've made an error, but keep in mind this site may still be under construction.</p>

            <div class="btn-group pad-bottom-2">
                <a href="index.php" class="margin-right-1 hero-btn">Home</a>
                <a href="contact-us.php" class="hero-btn hero-btn-alt">Contact us</a>
            </div>
        </div>
        <!-- <img class="home-hero-img margin-top-2" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down"> -->
    </div>
</section>

<div class="clearfix"></div>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>
<script src="js/aos/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>