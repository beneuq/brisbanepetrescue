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
        <section id="main-hero" class="hero-section pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content bg-img">
                    <h1 class="pad-top-2 pad-bottom-1">Looking to adopt?</h1>
                    <h2 class="pad-bottom-1">Brisbane Pet Rescue Has You Covered</h2>
                    <p class="pad-bottom-2">Here, we understand the struggles of finding the perfect K-9 companion. Browse through the availabe dogs straight away or do a short quiz to find the perfect pet for you.</p>

                    <div class="btn-group pad-bottom-2">
                        <a href="dogs.php" class="margin-right-1 hero-btn">Available Dogs</a>
                        <a href="personality-quiz.php" class="hero-btn hero-btn-alt">Personality Quiz</a>
                    </div>
                </div>
                <!-- <img class="home-hero-img margin-top-2" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down"> -->
            </div>

        </section>
        <!-- Section 2 -->
        <section id="about-us-cta" class="pg-section small-pg-section flex" style="background-color: lightgrey;">
        <div class="container">
            <div class="fleX pad-top-1">
                <h1 class="margin-bottom-1">Brisbane Pet Rescure - Who are we?</h1>
                <p class="pad-bottom-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur laudantium explicabo impedit nam odio quas, eum hic, perspiciatis delectus dolore natus nemo assumenda magnam. Totam?</p>
            </div>
            <div class="btn-group">
                <a href="about-us.php" class="hero-btn hero-btn-alt">Learn more</a>
            </div>
        </div>
        </section>
        <!-- Section 3 -->
        <section id="pet-help-hero" class="pg-section bg-img">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-top-2 pad-bottom-1">Looking for help with your pet?</h1>
                    <h2 class="pad-bottom-1">Well, you're in the right place</h2>
                    <p class="pad-bottom-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus possimus eveniet quo totam blanditiis placeat asperiores sed beatae vel voluptate alias explicabo iure, corporis quam.</p>

                    <div class="btn-group pad-bottom-2">
                        <a href="help.php" class="margin-right-1 hero-btn">Pet Help</a>
                        <a href="contact-us.php" class="hero-btn hero-btn-alt">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section Starts Here -->
        <section class="categories">
            <div class="container">
                <h2 class="breed-title">Explore Breeds</h2>

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
                                    <img src="https://brisbanepetrescue.me<?php echo $image_name; ?>" alt="<?php echo $image_alt; ?>" class="img-responsive">
                                <?php
                                }
                                ?>


                                <h3 class="breed-text"><?php echo $title; ?></h3>
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