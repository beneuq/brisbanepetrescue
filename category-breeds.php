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
                <div class="food-menu-img">
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
                    </div>
                </div>

                <!-- heading -->
                <h2 class="text-center"><?php echo $breed_title ?></h2>

                <!-- description if exists -->
                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                        Add doggy details
                    </p>
                    <br>

                </div>


                <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
</body>

</html>