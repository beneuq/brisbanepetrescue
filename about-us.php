<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'About Us';
        include('partials/head.php'); 
        $active_about_us = 'active';
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
                    <h1 class="pad-bottom-1"><?php echo $page_title; ?></h1>
                </div>
            </div>
        </section>
        <!-- Section 2 -->
        <section class="pg-section">

        </section>
        <!-- Section 3 -->
        <section class="pg-section" style="background-color: grey;">
            
        </section>
        <!-- Section 4 -->
        <section class="pg-section">
            
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>