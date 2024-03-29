<?php
require_once "config/constants.php";
enforce_login(); // Redirect to login page if not logged in.
const REMINDER_DAYS_TO_SHOW = 14; // Don't show reminders more than this many days away
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
    <section class="hero-section smallest-hero pos-relative center-txt">
        <div class="container center-txt">
            <div class="f-col hero-content center-txt">
                <h1 class="pad-bottom-1 pad-top-1 center-txt"><?php echo $firstname ?>'s Pets</h1>
            </div>
        </div>
    </section>
    <!-- This code iterates through the database and adds a table row for each dog in the database -->
    <?php include "partials/mypets-tasks-and-reminders-logic.php"; ?>

    <?php
    // Check whether data is available or not
    if ($pet_count <= 0) {
    ?>
        <br>
        <h1 class='center-txt'>You haven't adopted any pets yet.</h1>
        <h2 class='center-txt'>Adopt one first then check out this page!</h2>
        <style>
            .task-set4 {
                margin-top: 0;
            }
        </style>
    <?php
    } else {
    ?>

        <div class="mypets-glider">
            <?php include "partials/my-pets-glider.php"; ?>
        </div>

        <div id="sqldata">
            <!-- Post adoptions tasks content -->
            <div class="task-set">
                <h2 class="tasks-txt">Post-adoption tasks</h2>
                <div class="tasks-table">
                    <table class="tasks">
                        <tr>
                            <th>Click to complete task</th>
                        </tr>
                        <!-- Add rows for each post adoption task -->
                        <?php
                        foreach ($post_adopt_tasks as $task) {
                            echo "
                                    <tr>
                                        <td><button class='task-complete-btn' onclick='complete_task(\"{$task["type"]}\", \"{$task["dog_id"]}\")'>○ {$task["text"]}</button></td>
                                    </tr>
                                ";
                        }
                        ?>
                    </table>
                </div>
                <!-- Popup form appears here if opened by task completion -->
                <div id="popup-form-container" class="popup-div"></div>

                <h2 class="tasks-txt">Upcoming reminders</h2>
                <div class="tasks-table">
                    <table class="tasks">
                        <tr>
                            <th>Click to complete task</th>
                            <th style='width: 20%'>Due</th>
                        </tr>
                        <!-- Add rows for each reminder -->
                        <?php
                        foreach ($reminders_soon as $reminder) {
                            echo "
                                <tr>
                                    <td class='{$reminder['cell_class']}'><button class='task-complete-btn' onclick='complete_task(\"{$reminder["type"]}\", \"{$reminder["dog_id"]}\")'>○ {$reminder['text']}</button></td>
                                    <td style='width: 20%' class='{$reminder['cell_class']}'><button class='{$reminder['cell_class']} task-complete-btn' onclick='complete_task(\"{$reminder["type"]}\", \"{$reminder["dog_id"]}\")'>{$reminder['days']} days</button></td>
                                </tr>
                                ";
                        }
                        ?>
                    </table>
                </div>
            </div>

            <!-- Calendar section -->
            <div class="task-set2">
                <h2 class="tasks-txt">Pet Calendar</h2>
                <?php include "partials/task-calendar.php"; ?>
            </div>

            <!-- Breed care section -->
            <div class="task-set3">
                <h2 class="tasks-txt">Breed&nbsp;Care&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                <div class="tasks-table-2">
                    <table class="tasks">
                        <tr>
                            <th>Recommended Food</th>
                        </tr>
                        <?php
                        $my_breeds = get_user_breeds();
                        foreach ($my_breeds as $breed_name) {
                            echo "
                                <tr>
                                    <td><a href='https://duckduckgo.com/?q=!ducky+" . urlencode("food for a " . $breed_name) . "' target='_blank'>{$breed_name} recommended diet</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </table>
                </div>

                <!-- Grooming section -->
                <div class="tasks-table-3">
                    <table class="tasks">
                        <tr>
                            <th>Grooming Advice</th>
                        </tr>
                        <?php
                        foreach ($my_breeds as $breed_name) {
                            echo "
                                <tr>
                                    <td><a href='https://duckduckgo.com/?q=!ducky+" . urlencode("how to groom a " . $breed_name) . "' target='_blank'>{$breed_name} grooming tips</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </table>
                </div>
            </div>

        <?php
    }
        ?>

        <!-- Map section -->
        <div class="task-set4">
            <h2 class="tasks-txt">In your area</h2>
            <!-- Load Google Maps Places API Library (if enabled) -->
            <?php
            if (USE_GOOGLE_MAPS_API) {
                echo "
                                <script src='https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_MAPS_API_KEY . "&libraries=places'></script>
                                <script src='js/pet-rescue-google-maps-api.js'></script>
                                ";
            } else {
                echo "<p style='background-color:red'>Results are not being displayed to save our free API credits. <br>Enable USE_GOOGLE_MAPS_API in constants.php to test </p>";
            }
            ?>
            <div id="map"></div>

            <!-- Local results -->
            <div class="tasks-table">
                <table class="tasks" id="nearby-vet-clinics">
                    <tr id="vet-clinics">
                        <th>Veterinary Clinics</th>
                        <th>Location</th>
                        <th>Rating</th>
                    </tr>
                </table>
                <p style="text-align: center; font-size: large" id="vetclinics-location-error"><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">Allow location permissions to use this feature.</a></p>
            </div>
            <div class="tasks-table">
                <table class="tasks" id="nearby-dog-parks">
                    <tr id="dog-parks">
                        <th>Dog Parks</th>
                        <th>Location</th>
                        <th>Rating</th>
                    </tr>
                </table>
                <p style="text-align: center; font-size: large" id="dogparks-location-error"><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">Allow location permissions to use this feature.</a></p>
            </div>
        </div>

        <div class="clearfix"></div>
        </div>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
</body>

</html>