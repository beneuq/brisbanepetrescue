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
    if (isset($_GET['dog_id'])) {
        //Category id is set and get the id
        $dog_id = $_GET['dog_id'];
        // Get the CAtegory Title Based on Category ID
        $sql = "SELECT name as title FROM dogs WHERE dog_id=$dog_id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Get the value from Database
        $row = mysqli_fetch_assoc($res);
        //Get the TItle
        $dog_title = $row['title'];
    } else {
        //CAtegory not passed
        //Redirect to Home page
        header('location:' . SITEURL);
    }
    ?>

    <section class="category-section">
        <div class="container">
            <?php

            //Create SQL Query to Get foods based on Selected CAtegory
            $sql2 = "SELECT path, alt_text FROM dog_breeds AS b, breed_image as i, dogs as d WHERE b.breed_id = i.breed_id AND b.breed_id=d.breed_id AND d.dog_id=$dog_id ORDER BY main_image DESC";

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
                                $image_name = $row2['path'];
                                $image_alt = $row2['alt_text'];
                                if ($image_name == "") {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                } else {
                                    //Image Available
                            ?>
                                    <!-- use slider for images -->
                                    <li class="glide__slide"><img src="<?php echo SITEURL.$image_name; ?>" alt="<?php echo $image_alt; ?>"></li>
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

                <!-- description if exists -->
                <div class="category-info">
                    <?php

                    //Create SQL Query to Get foods based on Selected CAtegory
                    $sql3 = "SELECT d.name as d_name, Breed, age, gender, type_of_dog, popularity_class, good_for_novice_owners, size_class, height_low, height_high, weight_low, weight_high, adult_cal_intake_low, adult_cal_intake_high, average_lifespan, b.breed_id as breed_id, s.name as s_name, address, phone, hours, email FROM dogs as d, dog_breeds as b, shelters as s WHERE d.breed_id = b.breed_id AND s.shelter_id = d.shelter_id AND d.dog_id=$dog_id";

                    //Execute the Query
                    $res3 = mysqli_query($conn, $sql3);

                    //SHould be only 1 row to grab
                    $row3 = mysqli_fetch_assoc($res3);
                    ?>
                    <!-- heading -->
                    <h2 class="category-title center-txt"><?php echo $row3['d_name']; ?>'s Adoption Profile</h2>
                    
                    <div class="dog-information-boxes">
                        <div class="dog-info-box">
                            <h4>Dog Info</h4>
                            <p>Name: <?php echo $row3['d_name']; ?></p>
                            <p>Breed: <?php echo $row3['Breed']; ?></p>
                            <p>Age: <?php echo $row3['age']; ?></p>
                            <p>Gender: <?php echo $row3['gender']; ?></p>
                        </div>
                        <!-- These will only display if they are true -->
                        <div class="dog-info-box">
                            <h4>Breed info</h4>
                            <p>Type of dog: <span style="text-transform: capitalize;"><?php echo $row3['type_of_dog']; ?></span></p>
                            <p>Popularity: <br><?php echo str_repeat("<img src='/images/icons/star-full.png'>", $row3['popularity_class'])
                                                . str_repeat("<img src='/images/icons/star-full.png' style=opacity:0.2>", 5 - $row3['popularity_class']); ?></p>
                            <p>Good first time pet: <br><?php echo str_repeat("<img src='/images/icons/star-full.png'>", $row3['good_for_novice_owners'])
                                                        . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $row3['good_for_novice_owners']); ?></p>
                            <p>Size: <br><?php echo str_repeat("<img src='/images/icons/star-full.png'>", $row3['size_class'])
                                            . str_repeat("<img src='/images/icons/star-full.png' style='opacity:0.2'>", 5 - $row3['size_class']); ?></p>
                            <p>Height: <?php echo $row3['height_low']; ?>cm - <?php echo $row3['height_high']; ?>cm</p>
                            <p>Weight: <?php echo $row3['weight_low']; ?>kgs - <?php echo $row3['weight_high']; ?>kgs</p>
                            <p>Calorie intake (when adult):
                                <?php echo $row3['adult_cal_intake_low'] . "cals - "
                                    . $row3['adult_cal_intake_high'] . "cals"; ?></p>
                            <p>Average Lifespan: <?php echo $row3['average_lifespan']; ?> years</p>
                            <p><a href="/category-breeds.php?breed_id=<?php echo $row3['breed_id']; ?>">More breed info</a></p>
                        </div>
                            <div class="dog-info-box">
                            <h4>Shelter Info</h4>
                            <p>Name: <?php echo $row3['s_name']; ?></p>
                            <p>Address: <?php echo $row3['address']; ?></p>
                            <p>Phone: <?php echo $row3['phone']; ?></p>
                            <p>Email: <a href="mailto:<?php echo $row3['email']; ?>"><?php echo $row3['email']; ?></a></p>
                            <p>Hours: <?php echo $row3['hours']; ?></p>
                            <p><a href="https://form.jotform.com/212502680325043?<?php echo str_replace(' ', '%20', "shelterName=" . $row3['s_name'] . "&shelterEmail=" . $row3['email'] . "&dogId=" . $dog_id . "&dogName=" . $row3['d_name']); ?>">Apply to Adopt</a></p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footer.php'); ?>
</body>

</html>