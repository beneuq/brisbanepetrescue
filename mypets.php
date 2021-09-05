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
                    <br>
                </div>
        </section>

        <!-- This code iterates through the database and adds a table row for each dog in the database -->
        <div id="sqldata">
            <div id="tasks">
                <table>
                    <h2 class="center-txt">Post-adoption</h2>
                        <tr>
                            <th>Desexed?</th>
                            <th>Vaccinated?</th>
                            <th>Registration</th>
                        </tr>
                    <h2 class="center-txt">Reminders</h2>
                        <tr>
                            <th>Appointment</th>
                            <th>Worming Tablet</th>
                            <th>Tick Medication</th>
                            <th>Birthday</th>
                        </tr>
                </table>
                <table>
                    <h2 class="center-txt">Recommendations</h2>
                        <tr>
                            <th></th>
                            
                        </tr>
                    <h2 class="center-txt">In your area</h2>
                        <tr>
                            <th></th>
                            
                        </tr>
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
                    <td style='font-weight:bold; width:5%;'>" . $entry['Dog'] . "</td>
                    <td style='width:10%;'>" . $entry['Breed'] . "</td>
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