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
                <h2 class="text-center"><?php echo $breed_title ?></h2>

                <!-- description if exists -->
                <div class="food-menu-desc">
                    <h3>Description</h3>
                    <p> TODO: Add description </p>
                    <h3>Great breed qualities</h3>
                    <p> TODO: Add breed qualities</p>
                    <h3>Breed not recommended for:</h3>
                    <p> TODO: Add breed negatives</p>
                    <!-- Section with all details -->
                    <?php
                    // Grabbing all the info on that breed
                    $sql3 = "SELECT * FROM dog_breeds WHERE breed_id=$breed_id";
                    //Execute the Query
                    $res3 = mysqli_query($conn, $sql3);
                    // Get the row (should only ever be 1)
                    $row3 = mysqli_fetch_assoc($res3);
                    ?>
                    <h3>Detailed breed information</h3>
                    <p>All breeds are given a rating from 1 to 5 (5 being high) for a number of important physical and personality traits.
                        Please note that these are general traits and may not reflect every dog of this breed. </p>
                    <h4>General</h4>
                    <p>Type of dog: <span style="text-transform: capitalize;"><?php echo $row3['type_of_dog']; ?></span></p>
                    <p>Popularity: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['popularity_class'])
                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['popularity_class']); ?></p>
                    <p>Good first time pet: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['good_for_novice_owners'])
                                                . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['good_for_novice_owners']); ?></p>
                    <p>Size: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['size_class'])
                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['size_class']); ?></p>
                    <p>Height: <?php echo $row3['height_low']; ?>cm - <?php echo $row3['height_high']; ?>cm</p>
                    <p>Weight: <?php echo $row3['weight_low']; ?>kgs - <?php echo $row3['weight_high']; ?>kgs</p>
                    <p>Calorie intake (when adult):
                        <?php echo $row3['adult_cal_intake_low'] . "cals - "
                            . $row3['adult_cal_intake_high'] . "cals"; ?></p>
                    <p>Average Lifespan: <?php echo $row3['average_lifespan']; ?> years</p>
                    <h4>Personality</h4>
                    <p>Adaptability: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['adaptability_class'])
                                            . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['adaptability_class']); ?></p>
                    <p>Playful: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['potential_for_playfulness_class'])
                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['potential_for_playfulness_class']); ?></p>
                    <p>Sensitive: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['sensitivity_class'])
                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['sensitivity_class']); ?></p>
                    <p>High Energy: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['energy_level_class'])
                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['energy_level_class']); ?></p>
                    <p>Wanderlust Potential: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['wanderlust_potential_class'])
                                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['wanderlust_potential_class']); ?></p>
                    <p>Intensity: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['intensity_class'])
                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['intensity_class']); ?></p>
                    <p>Potential to be loud: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['potential_for_mouthiness_class'])
                                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['potential_for_mouthiness_class']); ?></p>
                    <h4>Family, Friends and other pets</h4>
                    <p>General Friendliness: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['general_friendliness_class'])
                                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['general_friendliness_class']); ?></p>
                    <p>Incredibly Child Friendly: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['incredibly_kid_friendly_class'])
                                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['incredibly_kid_friendly_class']); ?></p>
                    <p>Affectionate towards family: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['family_affectionate_class'])
                                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['family_affectionate_class']); ?></p>
                    <p>Friendly with other dogs: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['dog_friendly_class'])
                                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['dog_friendly_class']); ?></p>
                    <p>Friendly towards strangers: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['friendly_toward_strangers_class'])
                                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['friendly_toward_strangers_class']); ?></p>
                    <p>Prey Drive: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['prey_drive_class'])
                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['prey_drive_class']); ?></p>
                    <h4>Health and Lifestyle</h4>
                    <p>Exercise Required: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['exercise_needs_class'])
                                                . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['exercise_needs_class']); ?></p>
                    <p>Suited to aparment living: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['apartment_living_class'])
                                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['apartment_living_class']); ?></p>
                    <p>Ok alone: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['tolerates_being_alone_class'])
                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['tolerates_being_alone_class']); ?></p>
                    <p>Generaly health: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['general_health_class'])
                                            . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['general_health_class']); ?></p>
                    <p>Potential to put on weight: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['potential_for_weight_gain_class'])
                                                        . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['potential_for_weight_gain_class']); ?></p>
                    <p>Common Genetic Conditions: <?php echo $row3['genetic_conditions']; ?></p>
                    <p>Common Genetic Diseases: <?php echo $row3['genetic_diseases']; ?></p>
                    <h4>Intelligence</h4>
                    <p><?php echo $row3['intelligence_desc']; ?></p>
                    <p>Overall: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['intelligence_class'])
                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['intelligence_class']); ?></p>
                    <p>Obeys instructions (%): <?php echo $row3['obey_perc'] * 100; ?>%</p>
                    <p>Repetitions required to train: <?php echo $row3['training_reps_low'] . " - " . $row3['training_reps_high']; ?></p>
                    <h4>Cost</h4>
                    <p>Initial Cost: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['average_purchase_price_class'])
                                            . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['average_purchase_price_class']); ?></p>
                    <p>Lifetime Cost: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['lifetime_cost_class'])
                                            . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['lifetime_cost_class']); ?></p>
                    <h4>Other things to consider</h4>
                    <p>Amount of shedding: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['shedding_amount_class'])
                                                . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['shedding_amount_class']); ?></p>
                    <p>Drooling potential: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['drooling_potential_class'])
                                                . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['drooling_potential_class']); ?></p>
                    <p>Ease of grooming: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['ease_of_grooming_class'])
                                                . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['ease_of_grooming_class']); ?></p>
                    <p>Makes a good watchdog: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['watchdog_class'])
                                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['watchdog_class']); ?></p>
                    <p>Suited to warm weather: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['tolerates_hot_weather_class'])
                                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['tolerates_hot_weather_class']); ?></p>
                    <p>Suited to cold weather: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['tolerates_cold_weather_class'])
                                                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\" style=\"opacity:0.4\">", 5 - $row3['tolerates_cold_weather_class']); ?></p>
                    <p>count: <?php echo $count2; ?></p>
                    <br>

                </div>


                <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
</body>

</html>