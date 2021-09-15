<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'Home';
        include('partials/head.php'); 
        $active_home = 'active';
        ?>
        <script defer src="js/quiz.js"></script>
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
            <form action="" method="POST">
                <!-- Question 1 -->
                <fieldset id="p-quiz-q1" class="input-card">
                    <h1>Question 1</h1>
                    <h2>What size are you looking for in your dog?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionOneAnswerA" type="radio" class="answerTypeA" name="questionOne" value="AnswerA"><span>Large</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionOneAnswerB" type="radio" class="answerTypeA" name="questionOne" value="AnswerB"><span>Fairly Large</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionOneAnswerC" type="radio" class="answerTypeB" name="questionOne" value="AnswerC"><span>Moderate</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionOneAnswerD" type="radio" class="answerTypeA" name="questionOne" value="AnswerD"><span>Fairly Small</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionOneAnswerE" type="radio" class="answerTypeA" name="questionOne" value="AnswerE"><span>Small</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                <!-- Question 2 -->
                <fieldset id="p-quiz-q2" class="input-card">
                    <h1>Question 2</h1>
                    <h2>How much of an issue is the initial price of the dog for you?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionTwoAnswerA" type="radio" class="answerTypeA" name="questionTwo" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTwoAnswerB" type="radio" class="answerTypeB" name="questionTwo" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTwoAnswerC" type="radio" class="answerTypeC" name="questionTwo" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTwoAnswerD" type="radio" class="answerTypeD" name="questionTwo" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTwoAnswerE" type="radio" class="answerTypeE" name="questionTwo" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                <!-- Question 3 -->
                <fieldset id="p-quiz-q3" class="input-card">
                    <h1>Question 3</h1>
                    <h2>Are you concerned about your ability to take care of the dog financially in the future?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionThreeAnswerA" type="radio" class="answerTypeA" name="questionThree" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionThreeAnswerB" type="radio" class="answerTypeB" name="questionThree" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionThreeAnswerC" type="radio" class="answerTypeC" name="questionThree" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionThreeAnswerD" type="radio" class="answerTypeD" name="questionThree" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionThreeAnswerE" type="radio" class="answerTypeE" name="questionThree" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                <!-- Question 4 -->
                <fieldset id="p-quiz-q4" class="input-card">
                    <h1>Question 4</h1>
                    <h2>Are you looking for or interested in a guard dog?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionFourAnswerA" type="radio" class="answerTypeA" name="questionFour" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFourAnswerB" type="radio" class="answerTypeB" name="questionFour" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFourAnswerC" type="radio" class="answerTypeC" name="questionFour" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFourAnswerD" type="radio" class="answerTypeD" name="questionFour" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFourAnswerE" type="radio" class="answerTypeE" name="questionFour" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                <!-- Question 5 -->
                <fieldset id="p-quiz-q5" class="input-card">
                    <h1>Question 5</h1>
                    <h2>How much affection can you give to your animal?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionFiveAnswerA" type="radio" class="answerTypeA" name="questionFive" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFiveAnswerB" type="radio" class="answerTypeB" name="questionFive" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFiveAnswerC" type="radio" class="answerTypeC" name="questionFive" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFiveAnswerD" type="radio" class="answerTypeD" name="questionFive" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionFiveAnswerE" type="radio" class="answerTypeE" name="questionFive" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                <!-- Question 6 -->
                <fieldset id="p-quiz-q6" class="input-card">
                    <h1>Question 6</h1>
                    <h2>How playful (or how active) do you want your dog to be?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionSixAnswerA" type="radio" class="answerTypeA" name="questionSix" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSixAnswerB" type="radio" class="answerTypeB" name="questionSix" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSixAnswerC" type="radio" class="answerTypeC" name="questionSix" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSixAnswerD" type="radio" class="answerTypeD" name="questionSix" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSixAnswerE" type="radio" class="answerTypeE" name="questionSix" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                 <!-- Question 7 -->
                 <fieldset id="p-quiz-q7" class="input-card">
                    <h1>Question 7</h1>
                    <h2>Do you require the dog to be kid friendly?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionSevenAnswerA" type="radio" class="answerTypeA" name="questionSeven" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSevenAnswerB" type="radio" class="answerTypeB" name="questionSeven" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSevenAnswerC" type="radio" class="answerTypeC" name="questionSeven" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSevenAnswerD" type="radio" class="answerTypeD" name="questionSeven" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionSevenAnswerE" type="radio" class="answerTypeE" name="questionSeven" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                 <!-- Question 8 -->
                 <fieldset id="p-quiz-q8" class="input-card">
                    <h1>Question 8</h1>
                    <h2>How experienced of a pet owner are you?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionEightAnswerA" type="radio" class="answerTypeA" name="questionEight" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionEightAnswerB" type="radio" class="answerTypeB" name="questionEight" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionEightAnswerC" type="radio" class="answerTypeC" name="questionEight" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionEightAnswerD" type="radio" class="answerTypeD" name="questionEight" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionEightAnswerE" type="radio" class="answerTypeE" name="questionEight" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                 <!-- Question 9 -->
                 <fieldset id="p-quiz-q9" class="input-card">
                    <h1>Question 9</h1>
                    <h2>How willing are you to take your dog for exercise?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionNineAnswerA" type="radio" class="answerTypeA" name="questionNine" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionNineAnswerB" type="radio" class="answerTypeB" name="questionNine" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionNineAnswerC" type="radio" class="answerTypeC" name="questionNine" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionNineAnswerD" type="radio" class="answerTypeD" name="questionNine" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionNineAnswerE" type="radio" class="answerTypeE" name="questionNine" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>
                 <!-- Question 10 -->
                 <fieldset id="p-quiz-q10" class="input-card">
                    <h1>Question 10</h1>
                    <h2>How big will the dog’s living space be?</h2>
                    <ul>
                        <li>
                            <label>
                                <input id="questionTenAnswerA" type="radio" class="answerTypeA" name="questionTen" value="AnswerA"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTenAnswerB" type="radio" class="answerTypeB" name="questionTen" value="AnswerB"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTenAnswerC" type="radio" class="answerTypeC" name="questionTen" value="AnswerC"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTenAnswerD" type="radio" class="answerTypeD" name="questionTen" value="AnswerD"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input id="questionTenAnswerE" type="radio" class="answerTypeE" name="questionTen" value="AnswerE"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>

                <!-- Submit button -->
                <button id="submit" class="submit-btn submit-p-quiz" type="submit" value="Submit">Submit</button>
            
            </form>

            <!-- This bit of code below is me attempting to make a listen loop. Might be an easier way to do this -->
            <?php
            // for ($i=0;$i<2;$i++)
            // {
            //     // Check if submit button has been clicked
            //     if (submitClicked(0) == 0) 
            //     {
            //         $i = 0;
            //     } else 
            //     {
            //         // Here was where I had the sql. The ruins of what I was trying to do can be seen in the quiz.js
            //     }
            // }
            ?> 
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>