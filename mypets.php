<?php
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
    const REMINDER_DAYS_TO_SHOW = 14; // Don't show reminders more than this many days away
    // TODO maybe set to <30 days (but must be sure to pick dogs where this can be shown off in the demo)
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'My Pets';
        include('partials/head.php'); 
        $active_home = 'active';
        ?>
        <script src="/js/mypets-task-complete.js"></script>
        <link rel="stylesheet" href="/css/task.calendar.css">
        <!-- add styles for slider -->
        <link rel="stylesheet" href="/css/glide.core.css">
        <link rel="stylesheet" href="/css/glide.theme.css">
    </head>
    <body>
        <?php
            $firstname = $_SESSION['firstname'];
            $user_id = $_SESSION['user_id']
        ?>
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>


        <!-- Hero Section -->
        <section class="hero-section small-hero pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-bottom-1">My Pets</h1>
                    <h2 class="pad-bottom-2"><?php echo $firstname ?>'s Adopted K-9 Friends</h2>
                </div>
            </div>
        </section>
        <?php include "partials/mypets-tasks-and-reminders-logic.php";?>

        <?php include "partials/my-pets-glider.php";?>

        <!-- This code iterates through the database and adds a table row for each dog in the database -->



        <div id="sqldata">
            <div class="task-set">
                <h2 class="tasks-txt">Post-adoption</h2>
                <div class="tasks-table">
                    <table class="tasks">
                        <tr>
                            <th>Tasks</th>
                            <th>Complete</th>
                        </tr>
                        <!-- Add rows for each post adoption task -->
                        <?php
                            foreach ($post_adopt_tasks as $task) {
                                echo "
                                    <tr>
                                        <td>{$task["text"]}</td>
                                        <td><button onclick='complete_task(\"{$task["type"]}\", \"{$task["dog_id"]}\")'>Complete</button></td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <!-- Popup form appears here if opened by task completion -->
                <div id="popup-form-container" class="popup-div"></div>

                <h2 class="tasks-txt">Next 2 weeks</h2>
                <div class="tasks-table">
                    <table class="tasks">
                        <tr>
                            <th>Reminders</th>
                            <th>Due Date</th>
                            <th>Complete</th>
                        </tr>
                        <!-- Add rows for each reminder -->
                        <?php
                            foreach ($reminders_soon as $reminder) {
                                echo "
                                <tr>
                                    <td class='{$reminder['cell_class']}'>{$reminder['text']}</td>
                                    <td class='{$reminder['cell_class']}'>in {$reminder['days']} days</td>
                                    <td class='{$reminder['cell_class']}'><button onclick='complete_task(\"{$reminder["type"]}\", \"{$reminder["dog_id"]}\")'>Complete</button></td>
                                </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="task-set2">
            <h2 class="tasks-txt">Reminders</h2>
                <?php include "partials/task-calendar.php";?>
            </div>

            <div class="task-set3"> 
                <h2 class="tasks-txt">Recommendations</h2>
                <div class="tasks-table">
                    <table class="tasks">
                            <tr>
                                <th>Recommended Food</th>
                            </tr>
                            <tr>
                                <td>EXAMPLE</td>
                            </tr>
                    </table>
                </div>
            </div>
                            
            <div class="task-set3">               
                <h2 class="tasks-txt">In your area</h2>
                <div class="tasks-table">
                    <table class="tasks" id="nearby-places">
                        <!-- Load Google Maps Places API Library (if enabled) -->
                        <div id="map"></div>
                        <?php
                            if (USE_GOOGLE_MAPS_API) {
                                echo "
                                <script async src='https://maps.googleapis.com/maps/api/js?key=".GOOGLE_MAPS_API_KEY."&libraries=places'></script>
                                <script src='js/pet-rescue-google-maps-api.js'></script>
                                ";
                            } else {
                                echo "<p style='background-color:red'>Results are not being displayed to save our free API credits. <br>Enable USE_GOOGLE_MAPS_API in constants.php to test </p>";
                            }
                        ?>
                        <tr id="vet-clinics"><th>Veterinary Clinics</th><th>Location</th><th>Rating</th></tr>
                        <tr id="dog-parks"><th>Dog Parks</th><th>Location</th><th>Rating</th></tr>
                        <tr><th>Puppy Preschools / Obedience Training</th><th>Location</th><th>Rating</th></tr>
                        <tr><th>Dog Groomers</th><th>Location</th><th>Rating</th></tr>
                    </table>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>