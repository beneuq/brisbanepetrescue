<?php
    require_once "config/constants.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        // Initialise an array/dictionary of breed_id = 0 and store in a cookie
        $breed_scores = [];
        $res = mysqli_query($conn, "SELECT breed_id FROM dog_breeds;");
        while($entry = mysqli_fetch_array($res)) {
            $breed_scores[$entry['breed_id']] = 0;
        }
        setcookie('breed_scores', json_encode($breed_scores));
        // TODO: If we need to get this in php again: $breed_scores = json_decode($_COOKIE['breed_scores'], true);
        ?>
        <!-- import generic head section -->
        <?php 
        $page_title = 'Home';
        include('partials/head.php'); 
        $active_home = 'active';
        ?>
        <script src="/js/cookies.js"></script>
        <script src="/js/jquery-3.5.1.min.js"></script>
        <script src="/js/script.js" async defer></script>
    </head>

    <body onload="scrollToResults()">
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

        <!-- Hero Section -->
        <section class="hero-section small-hero pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="margin-top-2 pad-bottom-1">Personality Quiz</h1>
                    <p class="pad-bottom-2">Find the perfect dog for you! With this quiz you will find the dog you are most compatible with.</p>
                </div>
            </div>

        </section>
        <!-- Section 2 -->
        <section id="personality-quiz" class="pg-section container">
            <form action="">
                <!-- Question 1 -->
                <fieldset id="p-quiz-q1" class="input-card">
                    <h1>Question 1</h1>
                    <h2>What size are you looking for in your dog?</h2>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-size_class">
                    <div class="quizSliderLabels">
                        <p>Small</p>
                        <p></p>
                        <p>Medium</p>
                        <p></p>
                        <p>Large</p>
                    </div>
                </fieldset>
                <!-- Question 2 -->
                <fieldset id="p-quiz-q2" class="input-card">
                    <h1>Question 2</h1>
                    <h2>How much are you willing to spend on the initial purchase?</h2>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-average_purchase_price_class">
                    <div class="quizSliderLabels">
                        <p><?php echo EMOJI_DOLLAR;?></p>
                        <p></p>
                        <p><?php echo str_repeat(EMOJI_DOLLAR, 2);?></p>
                        <p></p>
                        <p><?php echo str_repeat(EMOJI_DOLLAR, 3);?></p>
                    </div>
                </fieldset>
                <!-- Question 3 -->
                <fieldset id="p-quiz-q3" class="input-card">
                    <h1>Question 3</h1>
                    <h2>How much are you willing to spend over your dog's lifetime?</h2>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-lifetime_cost_class">
                    <div class="quizSliderLabels">
                        <p><?php echo EMOJI_DOLLAR;?></p>
                        <p></p>
                        <p><?php echo str_repeat(EMOJI_DOLLAR, 2);?></p>
                        <p></p>
                        <p><?php echo str_repeat(EMOJI_DOLLAR, 3);?></p>
                    </div>
                </fieldset>
                <!-- Question 4 -->
                <fieldset id="p-quiz-q4" class="input-card">
                    <h1>Question 4</h1>
                    <h2>Are you looking for or interested in a guard dog?</h2>
                    <input type="range" class="quizAnswer quizToggle" id="quiz-watchdog_class">
                    <div class="quizSliderLabels quizToggle">
                        <p>No</p>
                        <p>Yes</p>
                    </div>
                </fieldset>
                <!-- Question 5 -->
                <fieldset id="p-quiz-q5" class="input-card">
                    <h1>Question 5</h1>
                    <h2>How often will you be away from your dog?</h2>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-tolerates_being_alone_class">
                    <div class="quizSliderLabels">
                        <p>Rarely</p>
                        <p></p>
                        <p>Sometimes</p>
                        <p></p>
                        <p>Frequently</p>
                    </div>
                </fieldset>
                <!-- Question 6 -->
                <fieldset id="p-quiz-q6" class="input-card">
                    <h1>Question 6</h1>
                    <h2>How playful do you want your dog to be?</h2>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-potential_for_playfulness_class">
                    <div class="quizSliderLabels">
                        <p>None</p>
                        <p></p>
                        <p>Sometimes</p>
                        <p></p>
                        <p>Very</p>
                    </div>
                </fieldset>
                 <!-- Question 7 -->
                 <fieldset id="p-quiz-q7" class="input-card">
                    <h1>Question 7</h1>
                    <h2>Do you require the dog to be kid friendly?</h2>
                    <input type="range" class="quizAnswer quizToggle" id="quiz-incredibly_kid_friendly_class">
                     <div class="quizSliderLabels quizToggle">
                         <p>No</p>
                         <p>Yes</p>
                     </div>
                </fieldset>
                 <!-- Question 8 -->
                 <fieldset id="p-quiz-q8" class="input-card">
                    <h1>Question 8</h1>
                    <h2>How much experience have you had with pet ownership?</h2>
                    <input type="range" class="quizAnswer quizSlider quizInvert" id="quiz-good_for_novice_owners">
                     <div class="quizSliderLabels">
                         <p>First-time</p>
                         <p></p>
                         <p>Some</p>
                         <p></p>
                         <p>Lots</p>
                     </div>
                </fieldset>
                 <!-- Question 9 -->
                 <fieldset id="p-quiz-q9" class="input-card">
                    <h1>Question 9</h1>
                    <h2>How often could you to take your dog for exercise?</h2>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-exercise_needs_class">
                     <div class="quizSliderLabels">
                         <p>Rarely</p>
                         <p></p>
                         <p>Sometimes</p>
                         <p></p>
                         <p>Frequently</p>
                     </div>
                </fieldset>
                 <!-- Question 10 -->
                 <fieldset id="p-quiz-q10" class="input-card">
                    <h1>Question 10</h1>
                    <h2>How large will the dog’s living space be?</h2>
                    <input type="range" class="quizAnswer quizSlider quizInvert" id="quiz-apartment_living_class">
                     <div class="quizSliderLabels">
                         <p>Apartment</p>
                         <p></p>
                         <p>Mid-size</p>
                         <p></p>
                         <p>Big House</p>
                     </div>
                </fieldset>
                <!-- Question 11 -->
                <fieldset id="p-quiz-q11" class="input-card">
                    <h1>Question 11</h1>
                    <h2>Do you have any other dogs?</h2>
                    <input type="range" class="quizAnswer quizToggle" id="quiz-dog_friendly_class">
                    <div class="quizSliderLabels quizToggle">
                        <p>No</p>
                        <p>Yes</p>
                    </div>
                </fieldset>

                <!-- Submit button -->
                <button id="submit" class="submit-btn submit-p-quiz" type="submit" value="Submit">Submit</button>
            </form>
            <!-- This div is populated with the currently compatible breeds based on the quiz -->
        </section>
        <section id="personality-quiz-results" class="pg-section container">
            <h1>Your Most Compatible Breeds</h1>
            <div id="compatibleBreeds"></div>
        </section>



        <script src="/js/quiz.js">

        </script>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>