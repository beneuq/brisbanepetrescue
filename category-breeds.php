<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brisbane Pet Rescue</title>
    <!-- import generic head section -->
    <?php include('partials/head.php'); ?>
    <!-- add styles for slider -->
    <link rel="stylesheet" href="css/glide.core.css">
    <link rel="stylesheet" href="css/glide.theme.css">
</head>

<body>
    <!-- import menu -->
    <?php include('partials/menu.php'); ?>
    <!-- import slider script -->
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <?php
    //CHeck whether id is passed or not
    if (isset($_GET['breed_id'])) {
        //Category id is set and get the id
        $breed_id = $_GET['breed_id'];
        // Get the CAtegory Title Based on Category ID
        $sql = "SELECT Breed as title FROM dog_breeds WHERE breed_id=$breed_id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Get the value from Database
        $row = mysqli_fetch_assoc($res);
        //Get the TItle
        $breed_title = $row['title'];
    } else {
        //CAtegory not passed
        //Redirect to Home page
        header('location:' . SITEURL);
    }
    ?>


    <!-- fOOD MEnu Section Starts Here -->
    <div class="underneath-nav"></div>
    <section class="food-menu">
        <div class="container">

            <?php

            //Create SQL Query to Get foods based on Selected CAtegory
            $sql2 = "SELECT b.breed_id AS id, Breed as title, path, alt_text, b.lifetime_cost_class as price FROM dog_breeds AS b, breed_image as i WHERE b.breed_id = i.breed_id AND b.breed_id=$breed_id ORDER BY main_image DESC";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count the Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food is available or not
            if ($count2 > 0) {
            ?>
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <?php
                            //Food is Available
                            while ($row2 = mysqli_fetch_assoc($res2)) {
                                $id = $row2['id'];
                                $title = $row2['title'];
                                $price = $row2['price'];
                                $image_name = $row2['path'];
                                $image_alt = $row2['alt_text'];
                                if ($image_name == "") {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                } else {
                                    //Image Available
                            ?>
                                    <!-- use slider for images -->
                                    <li class="glide__slide"><img src="https://brisbanepetrescue.me<?php echo $image_name; ?>" alt="<?php echo $image_alt; ?>"></li>
                        <?php
                                }
                            }
                        }
                        ?>
                        </ul>

                    </div>
                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
                        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
                    </div>
                </div>
                <script>
                    new Glide('.glide').mount()
                </script>

                <!-- heading -->
                <h2 class="category-title"><?php echo $breed_title ?></h2>
                <?php
                // Grabbing all the info on that breed
                $sql_breed_info = "SELECT * FROM dog_breeds WHERE breed_id=$breed_id";
                // Execute the Query
                $res_breed_info = mysqli_query($conn, $sql_breed_info);
                // Get the row (should only ever be 1)
                $entry_breed_info = mysqli_fetch_assoc($res_breed_info);

                // Grabbing descriptions for trait class ranking numbers
                $sql_trait_desc = "SELECT * FROM breed_good_bad_desc";
                // Execute the Query
                $res_trait_desc = mysqli_query($conn, $sql_trait_desc);
                // Iterate through the breed trait class fields and store data in array
                $trait_values = [];
                $trait_good_descs = [];
                $trait_bad_descs = [];
                while($entry_trait_desc = mysqli_fetch_array($res_trait_desc)) {
                    if ($entry_trait_desc['high_good']) { // If a high class number is good, leave value as is
                        $trait_values[$entry_trait_desc['breed_field']] = $entry_breed_info[$entry_trait_desc['breed_field']];
                    } else { // If a high class number is a bad thing, reverse the number to make it easier to use
                        $trait_values[$entry_trait_desc['breed_field']] = reverse1to5($entry_breed_info[$entry_trait_desc['breed_field']]);
                    }
                    $trait_good_descs[$entry_trait_desc['breed_field']] = $entry_trait_desc['good_text'];
                    $trait_bad_descs[$entry_trait_desc['breed_field']] = $entry_trait_desc['bad_text'];
                }
                arsort($trait_values);
                $best_traits = [];
                $worst_traits = [];
                const NUM_TRAITS_TO_SHOW = 5;
                for ($i = 1; $i <= NUM_TRAITS_TO_SHOW; $i++) {
                    array_push($best_traits, $trait_good_descs[array_keys($trait_values)[$i]]);
                    array_push($worst_traits, $trait_bad_descs[array_keys($trait_values)[count($trait_values)-$i]]);
                }
                ?>
                <!-- description if exists -->
                <div class="category-info">
                    <h3>Description</h3>
                    <p> TODO: Add description </p>
                    <h3>Great breed qualities</h3>
                        <ul class="good-traits"> <?php foreach ($best_traits as $quality) {echo "<li>".$quality."</li>";} ?> </ul>
                    <h3>Breed not recommended for:</h3>
                        <ul class="bad-traits"> <?php foreach ($worst_traits as $quality) {echo "<li>".$quality."</li>";} ?> </ul>
                    <!-- Section with all details -->

                    <h3>Detailed breed information</h3>
                    <p>All breeds are given a rating from 1 to 5 (5 being high) for a number of important physical and personality traits.
                        Please note that these are general traits and may not reflect every dog of this breed. </p>
                    <h4>General</h4>
                    <p>Type of dog: <span style="text-transform: capitalize;"><?php echo $entry_breed_info['type_of_dog']; ?></span></p>
                    <p>Popularity: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['popularity_class'])
                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['popularity_class']); ?></p>
                    <p>Good first time pet: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['good_for_novice_owners'])
                                                . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['good_for_novice_owners']); ?></p>
                    <p>Size: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['size_class'])
                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['size_class']); ?></p>
                    <p>Height: <?php echo $entry_breed_info['height_low']; ?>cm - <?php echo $entry_breed_info['height_high']; ?>cm</p>
                    <p>Weight: <?php echo $entry_breed_info['weight_low']; ?>kgs - <?php echo $entry_breed_info['weight_high']; ?>kgs</p>
                    <p>Calorie intake (when adult):
                        <?php echo $entry_breed_info['adult_cal_intake_low'] . "cals - "
                            . $entry_breed_info['adult_cal_intake_high'] . "cals"; ?></p>
                    <p>Average Lifespan: <?php echo $entry_breed_info['average_lifespan']; ?> years</p>
                    <h4>Personality</h4>
                    <p>Adaptability: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['adaptability_class'])
                                            . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['adaptability_class']); ?></p>
                    <p>Playful: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['potential_for_playfulness_class'])
                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['potential_for_playfulness_class']); ?></p>
                    <p>Sensitive: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['sensitivity_class'])
                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['sensitivity_class']); ?></p>
                    <p>High Energy: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['energy_level_class'])
                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['energy_level_class']); ?></p>
                    <p>Wanderlust Potential: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['wanderlust_potential_class'])
                                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['wanderlust_potential_class']); ?></p>
                    <p>Intensity: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['intensity_class'])
                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['intensity_class']); ?></p>
                    <p>Potential to be loud: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['potential_for_mouthiness_class'])
                                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['potential_for_mouthiness_class']); ?></p>
                    <h4>Family, Friends and other pets</h4>
                    <p>General Friendliness: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['general_friendliness_class'])
                                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['general_friendliness_class']); ?></p>
                    <p>Incredibly Child Friendly: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['incredibly_kid_friendly_class'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['incredibly_kid_friendly_class']); ?></p>
                    <p>Affectionate towards family: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['family_affectionate_class'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['family_affectionate_class']); ?></p>
                    <p>Friendly with other dogs: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['dog_friendly_class'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['dog_friendly_class']); ?></p>
                    <p>Friendly towards strangers: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['friendly_toward_strangers_class'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['friendly_toward_strangers_class']); ?></p>
                    <p>Prey Drive: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['prey_drive_class'])
                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['prey_drive_class']); ?></p>
                    <h4>Health and Lifestyle</h4>
                    <p>Exercise Required: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['exercise_needs_class'])
                                                . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['exercise_needs_class']); ?></p>
                    <p>Suited to aparment living: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['apartment_living_class'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['apartment_living_class']); ?></p>
                    <p>Ok alone: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['tolerates_being_alone_class'])
                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['tolerates_being_alone_class']); ?></p>
                    <p>Generaly health: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['general_health_class'])
                                            . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['general_health_class']); ?></p>
                    <p>Potential to put on weight: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['potential_for_weight_gain_class'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['potential_for_weight_gain_class']); ?></p>
                    <p>Common Genetic Conditions: <?php echo $entry_breed_info['genetic_conditions']; ?></p>
                    <p>Common Genetic Diseases: <?php echo $entry_breed_info['genetic_diseases']; ?></p>
                    <h4>Intelligence</h4>
                    <p><?php echo $entry_breed_info['intelligence_desc']; ?></p>
                    <p>Overall: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['intelligence_class'])
                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['intelligence_class']); ?></p>
                    <p>Obeys instructions (%): <?php echo $entry_breed_info['obey_perc'] * 100; ?>%</p>
                    <p>Repetitions required to train: <?php echo $entry_breed_info['training_reps_low'] . " - " . $entry_breed_info['training_reps_high']; ?></p>
                    <h4>Cost</h4>
                    <p>Initial Cost: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['average_purchase_price_class'])
                                            . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['average_purchase_price_class']); ?></p>
                    <p>Lifetime Cost: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['lifetime_cost_class'])
                                            . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['lifetime_cost_class']); ?></p>
                    <h4>Other things to consider</h4>
                    <p>Amount of shedding: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['shedding_amount_class'])
                                                . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['shedding_amount_class']); ?></p>
                    <p>Drooling potential: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['drooling_potential_class'])
                                                . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['drooling_potential_class']); ?></p>
                    <p>Ease of grooming: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['ease_of_grooming_class'])
                                                . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['ease_of_grooming_class']); ?></p>
                    <p>Makes a good watchdog: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['watchdog_class'])
                                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['watchdog_class']); ?></p>
                    <p>Suited to warm weather: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['tolerates_hot_weather_class'])
                                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['tolerates_hot_weather_class']); ?></p>
                    <p>Suited to cold weather: <?php echo str_repeat("<img src='/images/icons/star-full.png'>", $entry_breed_info['tolerates_cold_weather_class'])
                                                    . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $entry_breed_info['tolerates_cold_weather_class']); ?></p>
                    <p>count: <?php echo $count2; ?></p>
                    <br>

                </div>


                <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footer.php'); ?>
</body>

</html>