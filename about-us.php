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
        <section class="hero-section small-hero pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-top-2 pad-bottom-1"><?php echo $page_title; ?></h1>
                    <p class="pad-bottom-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt, temporibus necessitatibus ad, magnam est facere? Cumque adipisci quis aliquam.</p>

                </div>
            </div>
        </section>
        <!-- Section 2 -->
        <section class="pg-section">

        </section>
        <!-- Section 3 -->
        <section class="pg-section small-pg-section" style="background-color: grey;">
            
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>