<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'Home';
        include('partials/head.php'); 
        $active_home = 'active';
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
                    <ul>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Large</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeA" name="p-quiz-o2"><span>Fairly Large</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o3"><span>Moderate</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeA" name="p-quiz-o4"><span>Fairly Small</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeA" name="p-quiz-o5"><span>Small</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
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
                                <input type="radio" class="answerTypeA" name="p-quiz-o1"><span>Answer 1</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeB" name="p-quiz-o2"><span>Answer 2</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeC" name="p-quiz-o3"><span>Answer 3</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeD" name="p-quiz-o4"><span>Answer 4</span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="answerTypeE" name="p-quiz-o5"><span>Answer 5</span>
                            </label>
                        </li>     
                    </ul>
                </fieldset>

                <!-- Submit button -->
                <button class="submit-btn submit-p-quiz" type="submit" value="Submit">Submit</button>
            
            </form>
        </section>

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>