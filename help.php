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
                    <h1 class="about-title"><?php echo $page_title; ?></h1>
                </div>
            </div>
        </section>
        <!-- Section 2 -->
        <section class="pg-section container">
            <a href="breeds.php"><h2>Learn more about Breeds</h2></a>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt, temporibus necessitatibus ad, magnam est facere? Cumque adipisci quis aliquam.</p>

            <div class="help-box">
                <div class="help-content">
                    <h2>Get help with your dog</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt, temporibus necessitatibus ad, magnam est facere?</p>
                    <a href="">Read More</a>
                </div>
                <div class="help-thumbnail">
                </div>
            </div>

            <div class="help-box">
                <div class="help-content">
                    <h2>Should I be doing this for my dog?</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt.</p>
                    <a href="">Read More</a>
                </div>
                <div class="help-thumbnail">
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>