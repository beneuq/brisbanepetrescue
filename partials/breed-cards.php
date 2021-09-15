<?php
    require_once "../config/constants.php";
?>
<!DOCTYPE html>
<html lang="en">
<head><link rel="stylesheet" href="/css/style.css"></head>
<body>
<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <?php
            if (isset($_GET['breed_ids'])) {
                $breed_ids = explode(",", $_GET['breed_ids']);
                $user_id_or_null = logged_in() ? get_userid() : "NULL"; //todo deal with any vs null
                $user_id_or_any = logged_in() ? get_userid() : "'%'";
                // Create SQL Query to Display given breeds from Database
                $sql = "SELECT 
                            b.breed_id AS id, 
                            Breed as title, 
                            path, 
                            alt_text, 
                            height, 
                            width,
                            IF(user_id={$user_id_or_null}, 'full', 'empty') as favourite_icon
                        FROM dog_breeds b
                            LEFT JOIN favourite_breeds f ON b.breed_id = f.breed_id
                            LEFT JOIN breed_image i ON b.breed_id = i.breed_id 
                        WHERE main_image = 1 AND (user_id LIKE {$user_id_or_any} OR user_id IS NULL) AND(";
                for ($i = 0; $i < count($breed_ids)-1; $i++) {
                    $sql .= "b.breed_id=" . $breed_ids[$i] . " OR ";
                }
                $sql .= "b.breed_id=" . $breed_ids[$i] . ");";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['path'];
                    $image_alt = $row['alt_text'];
                    ?>

                    <a href="/category-breeds.php?breed_id=<?php echo $id; ?>">
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
                            <h3 class="breed-text"><?php echo $title;?><form method='POST' action='/form_submissions/favourite_breed.php'>
                                    <button type='submit' name='breed_id' value='<?php echo $row['id'];?>'>
                                        <img width='20%' src='images/icons/heart-<?php echo $row['favourite_icon'];?>.png'
                                             onmouseover='favHover(this,"<?php echo $row['favourite_icon'];?>");'
                                             onmouseout='favUnhover(this,"<?php echo $row['favourite_icon'];?>");'
                                        >
                                    </button>
                                </form></h3>
                        </div>
                    </a>
                    <?php
                }
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->
</body>
