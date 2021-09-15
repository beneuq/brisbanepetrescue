<!DOCTYPE html>
<html lang="en">

<head>
    <!-- import generic head section -->
    <?php
    $page_title = 'Breeds';
    include('partials/head.php');
    $active_breeds = 'active';
    ?>
</head>

<body>
    <div class="underneath-nav"></div>
    <!-- import menu -->
    <?php include('partials/menu.php');?>

    <!-- Start main page body -->
    <h1 class="table-title">Dog Information by Breed</h1>

    <div id="sqldata">
        <table class="breeds-table">
            <thead>
                <tr>
                    <th class='text-center'>Favourite</th>
                    <th>Breed</th>
                    <th>Intelligence</th>
                    <th>Lifetime Cost</th>
                    <th>Popularity</th>
                    <th class="text-left">Size Class</th>
                </tr>
            <thead>
            <tbody>    
                <?php
                $user_id_for_sql = logged_in() ? get_userid() : "NULL";
                // Gets all breeds, and also whether the breed has been favourited by the logged-in user
                $res = mysqli_query($conn, "
                    SELECT DISTINCT
                        d.breed_id,
                        Breed,
                        intelligence_desc,
                        lifetime_cost_class,
                        popularity_class,
                        size_class,
                        IF(user_id={$user_id_for_sql}, 'full', 'empty') as favourite_icon
                        FROM dog_breeds d
                            LEFT JOIN favourite_breeds f ON d.breed_id = f.breed_id
                        WHERE (user_id={$user_id_for_sql} OR user_id IS NULL)
                        ORDER BY Breed
                ");
                while($entry = mysqli_fetch_array($res)) {
                    $size_image = "images/icons/dog_size_" . $entry['size_class'];
                    ?>
                    <!-- Start Individual Breed Row -->
                    <tr id='breed_id=<?php echo $entry['breed_id'];?>'>
                        <td style='width:10%;'>
                            <form method='POST' action='/form_submissions/favourite_breed.php'>
                                <button type='submit' name='breed_id' value='<?php echo $entry['breed_id'];?>'>
                                    <img width='20%' src='images/icons/heart-<?php echo $entry['favourite_icon'];?>.png'
                                        onmouseover='favHover(this,"<?php echo $entry['favourite_icon'];?>");'
                                        onmouseout='favUnhover(this,"<?php echo $entry['favourite_icon'];?>");'
                                    >
                                </button>
                            </form>
                        </td>
                        <td style='width:20%;' class='breed-name'><a href='category-breeds.php?breed_id=<?php echo $entry['breed_id'];?>'><?php echo $entry['Breed'];?></a></td>
                        <td style='width:22%;'><?php echo $entry['intelligence_desc'];?></td>
                        <td style='width:16%;' class='text-center'><?php echo str_repeat(EMOJI_DOLLAR,$entry['lifetime_cost_class']);?></td>
                        <td style='width:10%;' class='text-left'><?php echo str_repeat(EMOJI_STAR,$entry['popularity_class']);?></td>
                        <td style='width:16%;'><img src='images/icons/dog_size_<?php echo $entry['size_class'];?>' alt='dog size chart' width='50%'></td>
                    </tr>
                    <!-- End Individual Breed Row -->
                <?php
                    }
                    mysqli_close($conn)
                ?>
            <tbody>
        </table>
    </div>
    <!-- End main page body -->

    <!-- import footer -->
    <?php include('partials/footer.php');?>
</body>

</html>