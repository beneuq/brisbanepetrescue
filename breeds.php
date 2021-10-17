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
    <?php include('partials/menu.php'); ?>

    <!-- Start main page body -->
    <h1 class="table-title">Dog Information by Breed</h1>

    <!-- Adding the filter section -->
    <div id="filters">
        <?php
        $filterTable = "breed_filters";
        $table = "dog_breeds d";
        $page = "breeds.php";
        include('partials/filter-menu.php') ?>
    </div>

    <div id="sqldata">
        <table class="breeds-table">
            <thead>
                <tr>
                    <th class='text-center desktop-only'>Favourite</th>
                    <th class='text-center mobile-only'></th>
                    <th>Breed</th>
                    <th class='desktop-only'>Intelligence</th>
                    <th class='desktop-only'>Lifetime Cost</th>
                    <th class='desktop-only'>Commonness</th>
                    <th class='mobile-only'>Common</th>
                    <th class="text-left">Size</th>
                </tr>
                <thead>
                <tbody>
                    <?php
                    $user_id_or_null = logged_in() ? get_userid() : "NULL"; //todo deal with any vs null (favourite the Affenpinscher signed in as mpowell to see)
                    $user_id_or_any = logged_in() ? get_userid() : "'%'"; //todo deal with any vs null
                    // Gets all breeds, and also whether the breed has been favourited by the logged-in user
                    $res = mysqli_query($conn, "
                    SELECT DISTINCT
                        d.breed_id,
                        Breed,
                        intelligence_desc,
                        lifetime_cost_class,
                        popularity_class,
                        size_class,
                        IF(user_id={$user_id_or_null}, 'full', 'empty') as favourite_icon
                        FROM dog_breeds d
                            LEFT JOIN favourite_breeds f ON d.breed_id = f.breed_id
                        WHERE (user_id LIKE {$user_id_or_any} OR user_id IS NULL OR (user_id LIKE '%' AND user_id NOT LIKE {$user_id_or_any})) $whereFilters
                        ORDER BY $orderFilter
                ");
                    while ($entry = mysqli_fetch_array($res)) {
                        $size_image = "images/icons/dog_size_" . $entry['size_class'];
                    ?>
                        <!-- Start Individual Breed Row -->
                        <tr id='breed_id=<?php echo $entry['breed_id']; ?>'>
                            <td style='width:10%;'>
                                <form method='POST' action='/form_submissions/favourite_breed.php'>
                                    <button type='submit' name='breed_id' value='<?php echo $entry['breed_id']; ?>'>
                                        <img width='20%' src='images/icons/heart-<?php echo $entry['favourite_icon']; ?>.png' onmouseover='favHover(this,"<?php echo $entry['favourite_icon']; ?>");' onmouseout='favUnhover(this,"<?php echo $entry['favourite_icon']; ?>");' class="zoom-on-hover">
                                    </button>
                                </form>
                            </td>
                            <td style='width:20%;' class='breed-name'><a href='breed-profile.php?breed_id=<?php echo $entry['breed_id']; ?>'><?php echo $entry['Breed']; ?></a></td>
                            <td class='desktop-only' style='width:22%;'><?php echo $entry['intelligence_desc']; ?></td>
                            <td class='desktop-only' style='width:16%;' class='text-center'><?php echo str_repeat(EMOJI_DOLLAR, $entry['lifetime_cost_class']); ?></td>
                            <td style='width:10%;' class='text-left'><?php echo str_repeat(EMOJI_STAR, $entry['popularity_class']); ?></td>
                            <td class='mobile-only' style='width:100%;'><img src='images/icons/dog_size_<?php echo $entry['size_class']; ?>' alt='dog size chart' width='50%'></td>
                            <td class='desktop-only' style='width:16%;'><img src='images/icons/dog_size_<?php echo $entry['size_class']; ?>' alt='dog size chart' width='50%'></td>    
                        </tr>
                        <!-- End Individual Breed Row -->
                    <?php
                    }
                    mysqli_close($conn);
                    ?>
            <tbody>
        </table>
    </div>
    <!-- End main page body -->

    <!-- import footer -->
    <?php include('partials/footer.php'); ?>
</body>

</html>