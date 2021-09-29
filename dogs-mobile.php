<!DOCTYPE html>
<html lang="en">

<head>
    <!-- import generic head section -->
    <?php
    $page_title = 'Dogs';
    include('partials/head.php');
    $active_dogs = 'active';
    ?>
    <script src="/js/script.js"></script>
</head>

<body>
<div class="underneath-nav"></div>
<!-- import menu -->
<?php include('partials/menu.php');?>

<!-- Start main page body -->
<h1 class="table-title">Dogs looking for a home</h1>

<!-- This code iterates through the database and adds a table row for each dog in the database -->
<section class="categories">
    <div class="container">
        <div id="sqldata">
            <?php
            $user_id_for_sql = logged_in() ? get_userid() : "NULL";
            // Gets all dogs, as well as their shelter, and also whether the dog has been shortlisted by the logged-in user
            $res = mysqli_query($conn, "
                SELECT DISTINCT
                    d.name AS Dog,
                    Breed,
                    age,
                    gender,
                    s.name AS Shelter,
                    path,
                    d.dog_id AS dog_id,
                    d.breed_id AS breed_id,
                    IF(user_id={$user_id_for_sql}, 'full', 'empty') as favourite_icon
                    FROM dogs d
                        INNER JOIN shelters s ON d.shelter_id = s.shelter_id
                        INNER JOIN dog_breeds b ON d.breed_id = b.breed_id
                        INNER JOIN breed_image bi ON d.breed_id = bi.breed_id
                        LEFT JOIN favourite_dogs f ON d.dog_id = f.dog_id
                    WHERE owner_id IS NULL 
                        AND main_image  
                        AND (user_id={$user_id_for_sql} OR user_id IS NULL)
                    ORDER BY d.name
            ");
            while($entry = mysqli_fetch_array($res)) {
            ?>
                <div class="profile-box float-container" id='dog_id=<?php echo $entry['dog_id'];?>'>
                    <td><img src='<?php echo SITEURL.$entry['path'];?>' alt='dog image' width='100%'></td>
                    <td><a href='category-dogs.php?dog_id=<?php echo $entry['dog_id'];?>'><?php echo $entry['Dog'];?></a></td>
                    <td><a href='category-breeds.php?breed_id=<?php echo $entry['breed_id'];?>'><?php echo $entry['Breed'];?></a></td>
                    <td><p><?php echo $entry['age'];?> years</td></p>
                    <td><img src='/images/icons/<?php echo $entry['gender'];?>.png' alt='dog gender' width='7%'></td>
                    <td><p><?php echo $entry['Shelter'];?></td></p>
                    <td>
                        <form method='POST' action='/form_submissions/favourite_dog.php'>
                            <button type='submit' name='dog_id' value='<?php echo $entry['dog_id'];?>'>
                                <img width='10%' src='images/icons/heart-<?php echo $entry['favourite_icon'];?>.png'
                                     onmouseover='favHover(this,"<?php echo $entry['favourite_icon'];?>");'
                                     onmouseout='favUnhover(this,"<?php echo $entry['favourite_icon'];?>");'
                                >
                            </button>
                        </form>
                    </td>
                </div>
            <?php
                }
                mysqli_close($conn)
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<!-- End main page body -->

<!-- import footer -->
<?php include('partials/footer.php');?>
</body>

</html>