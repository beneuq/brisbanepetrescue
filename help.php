<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'Help';
        include('partials/head.php'); 
        $active_help = 'active';
        ?>
    </head>

    <body class="help-main">
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

        <!-- Hero Section -->
        <section class="hero-section about-hero pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="margin-top-2 pad-bottom-2"><?php echo $page_title; ?></h1>
                </div>
            </div>
        </section>
        <!-- Section 2 -->
        <section id="help-page" class="pg-section container margin-top-2 margin-bottom-3">
            <a href="breeds.php">
                <h1 class="margin-bottom-1">Learn more about Breeds</h1>
            </a>
            <p class="margin-bottom-3">Taking care of a pet can be hard work, especially a new pet! To simplify things for you, we have collected some of the greatest resources from the across net, for your viewing.  With this information, you will be able to take after your pet/s with ease and confidence!</p>
            <div id="help-boxes">
                <div class="help-box">
                    <div class="help-content">
                        <h2>Get help with your dog</h2>
                        <p>Is your dog sick? Perhaps they are showcasing behaviours you don't understand?</p>
                        <a href="">Read More</a>
                    </div>
                    <div class="help-thumbnail"></div>
                </div>

                <div class="help-box help-box-2">
                    <div class="help-content">
                        <h2>Should I be doing this for my dog?</h2>
                        <p>Are you confused regarding what your dog can eat? Perhaps you are wondering whether certain behaviours should be encouraged?</p>
                        <a href="">Read More</a>
                    </div>
                    <div class="help-thumbnail"></div>
                </div>
            </div>
        </section>

        <!-- Show some pet care RSS feeds -->
        <?php include('partials/rss-feeds.php'); ?>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>