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
            <p class="about-us-text">Bit by Bit was first founded in 2021 as a University group of dedicated students who are all massive dog lovers. Our goal was to develop and create a simple, easy and helpful website to reduce the amount of euthanased animals each year. Each individual brought something to the table and we believe our project can make a difference in the pet adoption process.</p>
            <p class="about-us-text">According to the RSPCA, 12.35% of dogs were euthanased in the 2019 to 2020 financial year. It is unthinkable to think that the 'Man's best friend' is being put down at these alarming rates. A majority of these cases, these pets just need a loving home but wannabe pet owner's are unable to find a perfect match.</p>
            <p class="about-us-text">Our project can tackle the amount of animals that go unloved through a variety of user friendly features which you can freely explore. We assist at all stages of the process such as: scouting out the pefect pet, adopting the dog from a verified adoption clinic and post adoption assistance.</p>
            <p class="about-us-text">If you have or are looking for a pet, do not worry. We have you covered! Our personality quiz and filters will make the search as easy as walking the dog. Worried you might forget your pets vaccinations? We got you covered with a simple reminder calendar which stores all information you need. Happy adopting and if you have any enquires feel free to contact us.</p>   
        </section>

        <!-- Section 3 -->
        <section id="start-quiz-section" class="pg-section small-pg-section flex" style="background-color: lightgrey;">
            <div class="container">
                <div class="fleX pad-top-1">
                    <h1 class="pad-top-2 pad-bottom-1">Ready to get the ball rolling?</h1>
                    <h2 class="pad-bottom-1">Start with a personality quiz</h2>
                    <p class="pad-bottom-2">Taking our specialised quiz will help us to find a breed of dog that suits you and your lifestyle best!</p>

                    <div class="btn-group pad-bottom-2">
                        <a href="quiz.php" class="hero-btn hero-btn-alt">Take the Quiz</a>
                    </div>
            </div>
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>