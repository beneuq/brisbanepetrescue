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

    <body class="about-main">
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
        <section class="pg-section">
            <p class="about-us-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent metus turpis, rutrum a ullamcorper eu, faucibus non nunc. Nam dignissim euismod dui, id tincidunt lacus sollicitudin eget. Sed mauris turpis, hendrerit in condimentum nec, tristique non diam. Aliquam eu lectus ligula. Fusce posuere leo id ipsum malesuada ullamcorper. Nunc sed ornare diam. Cras porttitor leo ultricies magna feugiat gravida. Etiam posuere commodo fringilla.</p>
            <p class="about-us-text">Donec ultricies pretium diam, ac laoreet nisl. Etiam posuere nunc hendrerit lorem ornare egestas. Sed a cursus augue. Sed a posuere tortor. Quisque non lacus nulla. Ut porttitor vulputate metus non luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id lorem viverra, fermentum augue a, consequat sem. Aliquam ullamcorper dictum pretium.</p>
            <p class="about-us-text">Praesent suscipit vestibulum faucibus. Praesent aliquam mi non mi tempus fringilla. Maecenas laoreet justo lacus, nec euismod erat malesuada sed. Pellentesque efficitur mi sem, in commodo dui rhoncus vel. Aenean eget tincidunt risus, a eleifend mi. Fusce eget justo elementum, consectetur metus at, iaculis neque. Suspendisse interdum luctus dignissim. Curabitur ullamcorper velit eu ante vehicula, quis lacinia risus laoreet. Curabitur pharetra, ipsum vitae pretium venenatis, tortor felis volutpat arcu, in tincidunt justo velit id odio. Maecenas blandit at turpis ut mattis. In porta imperdiet efficitur. In feugiat tellus eget nulla eleifend pellentesque. Aliquam erat volutpat. Nulla quis ipsum vulputate, consequat ligula in, luctus enim. Etiam tempor nisl sed magna semper ullamcorper. Sed sit amet cursus dolor.</p>
            <p class="about-us-text">Nunc sit amet porta nibh. Mauris ac ligula at metus laoreet pharetra. Nulla vel felis metus. Integer sit amet lorem vitae tellus molestie pulvinar. Donec vitae dolor at est scelerisque varius eu at felis. Etiam volutpat tortor libero. Vestibulum sit amet cursus turpis, ut feugiat metus. Maecenas posuere, urna ut porttitor sagittis, nibh velit posuere arcu, quis lacinia mauris erat at mi. Quisque facilisis finibus tortor, ut fringilla elit rhoncus sed. Aliquam sed ligula tempus, euismod ligula sit amet, molestie tortor. Praesent id nibh sed elit condimentum dapibus eu et metus.</p>   
        </section>

        <!-- Section 3 -->
        <section id="start-quiz-section" class="pg-section small-pg-section flex" style="background-color: lightgrey;">
            <div class="container">
                <div class="fleX pad-top-1">
                    <h1 class="pad-top-2 pad-bottom-1">Ready to get the ball rolling?</h1>
                    <h2 class="pad-bottom-1">Start with a personality quiz</h2>
                    <p class="pad-bottom-2">Taking our specialised quiz will help us to find a breed of dog that suits your and your lifestyle best!</p>

                    <div class="btn-group pad-bottom-2">
                        <a href="quiz.php" class="hero-btn hero-btn-alt">Take the Quiz</a>
                    </div>
            </div>
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>