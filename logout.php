<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- import generic head section -->
    <?php
    $page_title = 'Breeds';
    include('partials/head.php');
    $active_dogs = 'active';
    ?>
</head>

<body>
<div class="underneath-nav"></div>
<!-- import menu -->
<?php include('partials/menu.php'); ?>

<!-- Hero Section -->
<section class="hero-section pos-relative">
    <div class="flex container">
        <div class="flex f-col hero-content">
            <h1 class="pad-bottom-1">You have been logged out.</h1>
            <h2 class="pad-bottom-1">Redirecting to homepage in 3 seconds...</h2>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>
</body>

</html>

<?php
header('Refresh: 3; URL=/');
//other code
?>