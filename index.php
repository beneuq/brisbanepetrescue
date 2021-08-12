<?php include('config/constants.php'); ?>

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

    <h1>Brisbane Pet Rescue</h1>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //Create SQL Query to Display CAtegories from Database
            $sql = "SELECT breed_id AS id, breed_name as title, image_url as image_name, alt_text as image_alt FROM tbl_breed, tbl_image WHERE breed_id=image_id AND breed_active='Yes' AND breed_featured='Yes' LIMIT 3";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //Breeds Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>

                    <a href="<?php echo SITEURL; ?>category-breeds.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //Check whether Image is available or not
                            if ($image_name == "") {
                                //Display MEssage
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>" alt="<?php echo $image_alt; ?>" class="img-responsive img-curve">
                            <?php
                            }
                            ?>


                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

            <?php
                }
            } else {
                //Breeds not Available
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