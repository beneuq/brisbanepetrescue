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
                        $sql2 = "SELECT * FROM dog_breeds WHERE breed_id=$breed_id"
                        //Execute the Query
                        $res3 = mysqli_query($conn, $sql2);
                        // Get the row (should only ever be 1)
                        $row3 = mysqli_fetch_assoc($res3);
                    ?>
                    <h3>Detailed breed information</h3>
                    <p>All breeds are given a rating from 1 to 5 (5 being high) for a number of important physical and personality traits.
                        Please note that these are general traits and may not reflect every dog of this breed. </p>
                    <h4>General</h4>
                    <p>Height: <?php echo str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-full.png\">", $row3['height_class'])
                    . str_repeat("<img src=\"https://brisbanepetrescue.me/images/icons/star-empty.png\">", 5 - $row3['height_class']);?></p>
                        <p><?php echo $row3['height_low'];?>cm - <?php echo $row3['height_high'];?>cm</p>
                    <p>Weight: <?php echo $row3['weight_low'];?>kgs - <?php echo $row3['weight_low'];?>kgs</p>

                    <h4>Family, Friends and other pets</h4>
                    <h4>Health and Lifestyle</h4>
                    <h4>Intelligence</h4>
                    <h4>Cost</h4>
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