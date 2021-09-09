<?php
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
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

        <!-- This code iterates through the database and adds a table row for each dog in the database -->
        <div id="sqldata">
            <div class="task-set">
                <table class="tasks">
                    <h2 class="tasks-txt">Post-adoption</h2>
                        <tr>
                            <th>Tasks</th>
                            <th>Complete</th>
                        </tr>
                        <tr>
                            <td>EXAMPLE</td>
                            <td>EXAMPLE</td>
                        </tr>
                </table>
                <table class="tasks">
                    <h2 class="tasks-txt">Reminders</h2>
                        <tr>
                            <th>Appointment</th>
                            <th>Worming Tablet</th>
                            <th>Tick Medication</th>
                            <th>Birthday</th>
                        </tr>
                        <tr>
                            <td>EXAMPLE</td>
                            <td>EXAMPLE</td>
                            <td>EXAMPLE</td>
                            <td>EXAMPLE</td>
                        </tr>
                </table>
            </div>
            <div class="task-set">
                <table class="tasks">
                    <h2 class="tasks-txt">Recommendations</h2>
                        <tr>
                            <th>Recommended Food</th>
                        </tr>
                        <tr>
                            <td>EXAMPLE</td>
                        </tr>

                </table>
           
                <table class="tasks" id="nearby-places">
                    <h2 class="tasks-txt">In your area</h2>
                    <!-- Load Google Maps Places API Library (if enabled) -->
                    <div id="map"></div>
                    <?php
                        if (USE_GOOGLE_MAPS_API) {
                            echo "
                            <script async src='https://maps.googleapis.com/maps/api/js?key=".GOOGLE_MAPS_API_KEY."&libraries=places'></script>
                            <script src='js/pet-rescue-google-maps-api.js'></script>
                            ";
                        } else {
                            echo "<p style='background-color: red'>Results are not being displayed to save our free API credits. <br>Enable USE_GOOGLE_MAPS_API in constants.php to test </p>";
                        }
                    ?>

                    <tr id="vet-clinics"><th>Veterinary Clinics</th><th>Location</th><th>Rating</th></tr>
                    <tr id="dog-parks"><th>Dog Parks</th><th>Location</th><th>Rating</th></tr>
                    <tr><th>Puppy Preschools / Obedience Training</th><th>Location</th><th>Rating</th></tr>
                    <tr><th>Dog Groomers</th><th>Location</th><th>Rating</th></tr>
                </table>
            </div>
            <table class="breeds-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Birthday</th>
                    <th>Adopted</th>
                    <th>Gender</th>
                    <th>Desexed</th>
                    <th>Vaccinated</th>
                    <th>Worming Tablet</th>
                    <th>Tick Medication</th>
                    <th></th>
                </tr>
                <thead>
                <tbody>
                <?php
                // Gets all dogs, as well as their shelter, and also whether the dog has been shortlisted by the logged-in user
                $res = mysqli_query($conn, "
                    SELECT DISTINCT
                        d.name AS Dog,
                        Breed,
                        age,
                        DATE_FORMAT(adoption_date, '%M %D, %Y') as adoption_date,
                        DATE_FORMAT(dob, '%M %D') as birthday,
                        gender,
                        desexed,
                        vaccinated,
                        path,
                        d.dog_id AS dog_id,
                        d.breed_id AS breed_id,
                        DATEDIFF(DATE_ADD(last_worming_medication, INTERVAL worming_medication_frequency DAY), SYSDATE()) as worm_meds_due,
                        DATEDIFF(DATE_ADD(last_tick_medication, INTERVAL tick_medication_frequency DAY), SYSDATE()) as tick_meds_due
                        FROM dogs d
                            INNER JOIN dog_breeds b ON d.breed_id = b.breed_id
                            INNER JOIN breed_image bi ON d.breed_id = bi.breed_id
                            LEFT JOIN favourite_dogs f ON d.dog_id = f.dog_id
                        WHERE owner_id=". get_userid()."
                            AND main_image  
                        ORDER BY d.name
                ");

                while($entry = mysqli_fetch_array($res)) {
                    // Store data in php array


                    // Hide countdown or set to red if null or overdue
                    if (is_null($entry['worm_meds_due'])) {
                        $add_style_worm = 'font-size:0';
                    } else if ($entry['worm_meds_due'] <= 0) {
                        $add_style_worm = 'color:red';
                    } else {
                        $add_style_worm = '';
                    }
                    if (is_null($entry['tick_meds_due'])) {
                        $add_style_tick = 'font-size:0';
                    } else if ($entry['tick_meds_due'] <= 0) {
                        $add_style_tick = 'color:red';
                    } else {
                        $add_style_tick = '';
                    }

                    echo "<tr id='dog_id=".$entry['dog_id']."'>
                    <td style='font-weight:bold; width:5%;'><a href='category-dogs.php?dog_id=".$entry['dog_id']."'>". $entry['Dog'] . "</a></td>
                    <td style='width:10%;'><a href='category-breeds.php?breed_id=".$entry['breed_id']."'>" . $entry['Breed'] . "</a></td>
                    <td style='width:5%;'>" . $entry['age'] . "</td>
                    <td style='width:5%;'>" . $entry['birthday'] . "</td>
                    <td style='width:10%;'>" . $entry['adoption_date'] . "</td>
                    <td style='width:5%;'><img src='/images/icons/". $entry['gender'] .".png' alt='dog image' width='20%'></td>
                    <td style='width:5%;'><img src='/images/icons/boolean-checkbox-". $entry['desexed'] .".png' alt='dog image' width='25%'></td>
                    <td style='width:5%;'><img src='/images/icons/boolean-checkbox-". $entry['vaccinated'] .".png' alt='dog image' width='25%'></td>
                    <td style='width:5%;".$add_style_worm."'>" . $entry['worm_meds_due'] . " days</td>
                    <td style='width:5%;".$add_style_tick."'>" . $entry['tick_meds_due'] . " days</td>
                    <td style='width:10%;'> <img src='". SITEURL.$entry['path'] ."' alt='dog image' width='50%'> </td>
                </tr>";
                }
                mysqli_close($conn)
                ?>
                <tbody>
            </table>
        </div>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>