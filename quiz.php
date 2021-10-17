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
        $page_title = 'Breed Quiz';
        include('partials/head.php'); 
        $active_home = 'active';
        ?>
        <script src="/js/cookies.js"></script>
        <script src="/js/jquery-3.5.1.min.js"></script>
        <script src="/js/script.js" async defer></script>
    </head>

    <body>
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
            <form action="quiz.php#personality-quiz-results">
                <!-- Question 1 -->
                <fieldset id="p-quiz-q1" class="input-card">
                    <h1>Question 1</h1>
                    <h2>What size are you looking for in your dog?</h2>
                    <input type="checkbox" id="question1N/A" class="N/A" name="question1N/A">
                    <label for="question1N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-size_class">
                    <div class="quizSliderLabels">
                        <span><p>Small</p></span>
                        <span></span>
                        <span><p>Medium</p></span>
                        <span></span>
                        <span><p>Large</p></span>
                    </div>
                </fieldset>
                <!-- Question 2 -->
                <fieldset id="p-quiz-q2" class="input-card">
                    <h1>Question 2</h1>
                    <h2>How much are you willing to spend on the initial purchase?</h2>
                    <input type="checkbox" id="question2N/A" class="N/A" name="question2N/A">
                    <label for="question2N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-average_purchase_price_class">
                    <div class="quizSliderLabels">
                        <span><p>$50</p></span>
                        <span> </span>
                        <span><p>$500</p></span>
                        <span></span>
                        <span><p>$1000+</p></span>
                    </div>
                </fieldset>
                <!-- Question 3 -->
                <fieldset id="p-quiz-q3" class="input-card">
                    <h1>Question 3</h1>
                    <h2>How much are you willing to spend over your dog's lifetime?</h2>
                    <input type="checkbox" id="question3N/A" class="N/A" name="question3N/A">
                    <label for="question3N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-lifetime_cost_class">
                    <div class="quizSliderLabels">
                        <span><p>$5k</p></span>
                        <span></span>
                        <span><p>$25k</p></span>
                        <span></span>
                        <span><p>$50k+</p></span>
                    </div>
                    <div class="center-txt margin-top-2">
                        <a class="main-purple-txt grey-txt-hover" href="https://www.rspcansw.org.au/what-we-do/care-for-animals/owning-a-pet/costs/" target="_blank">Why do dogs cost so much?</a>
                    </div>
                </fieldset>
                <!-- Question 4 -->
                <fieldset id="p-quiz-q4" class="input-card">
                    <h1>Question 4</h1>
                    <h2>Are you looking for or interested in a guard dog?</h2>
                    <input type="checkbox" id="question4N/A" class="N/A" name="question4N/A">
                    <label for="question4N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizToggle" id="quiz-watchdog_class">
                    <div class="quizSliderLabels quizToggle">
                        <span><p>No</p></span>
                        <span><p>Yes</p></span>
                    </div>
                </fieldset>
                <!-- Question 5 -->
                <fieldset id="p-quiz-q5" class="input-card">
                    <h1>Question 5</h1>
                    <h2>How often will you be away from your dog?</h2>
                    <input type="checkbox" id="question5N/A" class="N/A" name="question5N/A">
                    <label for="question5N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-tolerates_being_alone_class">
                    <div class="quizSliderLabels">
                        <span><p>Rarely</p></span>
                        <span></span>
                        <span><p>Sometimes</p></span>
                        <span></span>
                        <span><p>Very</p></span>
                    </div>
                </fieldset>
                <!-- Question 6 -->
                <fieldset id="p-quiz-q6" class="input-card">
                    <h1>Question 6</h1>
                    <h2>How playful do you want your dog to be?</h2>
                    <input type="checkbox" id="question6N/A" class="N/A" name="question6N/A">
                    <label for="question6N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-potential_for_playfulness_class">
                    <div class="quizSliderLabels">
                        <span><p>Rarely</p></span>
                        <span></span>
                        <span><p>Sometimes</p></span>
                        <span></span>
                        <span><p>Very</p></span>
                    </div>
                </fieldset>
                 <!-- Question 7 -->
                 <fieldset id="p-quiz-q7" class="input-card">
                    <h1>Question 7</h1>
                    <h2>Do you require the dog to be kid friendly?</h2>
                    <input type="checkbox" id="question7N/A" class="N/A" name="question7N/A">
                    <label for="question7N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizToggle" id="quiz-incredibly_kid_friendly_class">
                    <div class="quizSliderLabels quizToggle">
                        <span><p>No</p></span>
                        <span><p>Yes</p></span>
                    </div>
                </fieldset>
                 <!-- Question 8 -->
                 <fieldset id="p-quiz-q8" class="input-card">
                    <h1>Question 8</h1>
                    <h2>How much experience have you had with pet ownership?</h2>
                    <input type="checkbox" id="question8N/A" class="N/A" name="question8N/A">
                    <label for="question8N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider quizInvert" id="quiz-good_for_novice_owners">
                    <div class="quizSliderLabels">
                        <span><p>First time</p></span>
                        <span></span>
                        <span><p>Some</p></span>
                        <span></span>
                        <span><p>Lots</p></span>
                    </div>
                </fieldset>
                 <!-- Question 9 -->
                 <fieldset id="p-quiz-q9" class="input-card">
                    <h1>Question 9</h1>
                    <h2>How often could you to take your dog for exercise?</h2>
                    <input type="checkbox" id="question9N/A" class="N/A" name="question9N/A">
                    <label for="question9N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider" id="quiz-exercise_needs_class">
                    <div class="quizSliderLabels">
                        <span><p>Rarely</p></span>
                        <span></span>
                        <span><p>Sometimes</p></span>
                        <span></span>
                        <span><p>Very</p></span>
                    </div>
                </fieldset>
                 <!-- Question 10 -->
                 <fieldset id="p-quiz-q10" class="input-card">
                    <h1>Question 10</h1>
                    <h2>How large will the dog’s living space be?</h2>
                    <input type="checkbox" id="question10N/A" class="N/A" name="question10N/A">
                    <label for="question10N/A"> Not sure / skip</label><br>
                    <input type="range" class="quizAnswer quizSlider quizInvert" id="quiz-apartment_living_class">
                    <div class="quizSliderLabels">
                        <span><p>Apartment</p></span>
                        <span></span>
                        <span><p>Mid-size</p></span>
                        <span></span>
                        <span><p>Big House</p></span>
                    </div>
                </fieldset>
                <!-- Question 11 -->
                <fieldset id="p-quiz-q11" class="input-card">
                    <h1>Question 11</h1>
                    <h2>Do you have any other dogs?</h2>
                    <input type="checkbox" id="question11N/A" class="N/A" name="question11N/A">
                    <label for="question11N/A"> Not sure / skip</label><br>
                    <div>
                        <input type="range" class="quizAnswer quizToggle" id="quiz-dog_friendly_class">
                        <div class="quizSliderLabels quizToggle">
                            <span><p>No</p></span>
                            <span><p>Yes</p></span>
                        </div>
                    </div>
                </fieldset>
                <!-- Question 12 -->
                <fieldset id="p-quiz-q12" class="input-card">
                    <h1>Question 12</h1>
                    <h2>Are you okay with a dog that sheds a lot? (Consider allergies in your family)</h2>
                    <input type="checkbox" id="question12N/A" class="N/A" name="question12N/A">
                    <label for="question12N/A"> Not sure / skip</label><br>
                    <div>
                        <input type="range" class="quizAnswer quizToggle" id="quiz-shedding_amount_class">
                        <div class="quizSliderLabels quizToggle">
                            <span><p>No</p></span>
                            <span><p>Yes</p></span>
                        </div>
                    </div>
                </fieldset>

                <!-- Submit button -->
                <button id="submit" class="submit-btn submit-p-quiz" type="submit" value="Submit">Submit</button>
            </form>
            <!-- This div is populated with the currently compatible breeds based on the quiz -->
        </section>
        <section id="personality-quiz-results" class="pg-section container">
            <h1>Your Most Compatible Breeds</h1>
            <h3>Click the heart icon to add the breed to your favourites</h3>
            <div id="compatibleBreeds"></div>
        </section>



        <script src="/js/quiz.js">

        </script>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>