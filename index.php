<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brisbane Pet Rescue</title>
    <!-- import generic head section -->
    <?php include('partials/head.php'); ?>
</head>

<body>
    <!-- import menu -->
    <?php include('partials/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Pets..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Breeds</h2>

            <?php
            // Create SQL Query to Display Categories from Database
            $sql = "SELECT breed_id AS id, Breed as title FROM dog_breeds LIMIT 3";
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
                    $image_name = "";
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
                                <img src="images/<?php echo $image_name; ?>" alt="<?php echo $image_alt; ?>" class="img-responsive img-curve">
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

    <!-- import footer -->
    <?php include('partials/footer.php'); ?>
</body>

</html>