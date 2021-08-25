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
        <section class="hero-section pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-bottom-1">Brisbane Pet Rescue</h1>
                    <h2 class="pad-bottom-1">Find the Perfect Dog for You!</h2>
                    <p class="pad-bottom-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt, temporibus necessitatibus ad, magnam est facere? Cumque adipisci quis aliquam.</p>

                    <div class="pad-bottom-2">
                        <a href="#" class="margin-right-1 hero-btn">Available Dogs</a>
                        <a href="#" class="hero-btn hero-btn-alt">Personality Quiz</a>
                    </div>
                </div>
                <img class="hero-img" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down">
            </div>

        </section>
        <!-- Section 2 -->
        <section class="pg-section">

        </section>
        <!-- Section 3 -->
        <section class="pg-section" style="background-color: grey;">
            
        </section>
        <!-- Section 4 -->
        <section class="pg-section">
            
        </section>

        <!-- Categories Section Starts Here -->
        <section class="categories">
            <div class="container">
                <h2 class="text-center">Explore Breeds</h2>

                <?php
                // Create SQL Query to Display Categories from Database
                $sql = "SELECT b.breed_id AS id, Breed as title, path, alt_text, height, width FROM dog_breeds AS b, breed_image as i WHERE b.breed_id = i.breed_id AND main_image = 1 AND b.popularity_class = 5 LIMIT 32";
                // Execute the Query
                $res = mysqli_query($conn, $sql);
                // Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    // Breeds Available
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['path'];
                        $image_alt = $row['alt_text'];
                ?>

                        <a href="category-breeds.php?breed_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                //Check whether Image is available or not
                                if ($image_name == "") {
                                    // Display Message
                                    echo "<div class='error'>Image not Available</div>";
                                } else {
                                    // Image Available
                                ?>
                                    <img src="https://brisbanepetrescue.me<?php echo $image_name; ?>" alt="<?php echo $image_alt; ?>" class="img-responsive img-curve">
                                <?php
                                }
                                ?>


                                <h3 class="float-text"><?php echo $title; ?></h3>
                            </div>
                        </a>

                <?php
                    }
                } else {
                    // Breeds not Available
                    echo "<div class='error'>Breeds not Added.</div>";
                }
                ?>


                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Categories Section Ends Here -->

        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>