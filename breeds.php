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
    <h1 class="breed-title">Dog Information by Breed</h1>

    <!--
    This code iterates through the database and adds a table row for each breed in the database
    TODO: @Front-end guys - Make favourite button look better
    TODO: @Myself (Matt) - Maybe make favourite button go away or switch to 'unfavourite' once clicked (will require an IF logged-in though)
    -->
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
                        IF(user_id=".$user_id_for_sql.", 'full', 'empty') as favourite_icon
                        FROM dog_breeds d
                            LEFT JOIN favourite_breeds f ON d.breed_id = f.breed_id
                        WHERE (user_id=".$user_id_for_sql." OR user_id IS NULL)
                        ORDER BY Breed
                ");
                    while($entry = mysqli_fetch_array($res)) {
                        $size_image = "images/icons/dog_size_" . $entry['size_class'];
                        echo "<tr>
                                <td style='width:5%;'><form method='POST' action='/form_submissions/favourite_breed.php'> <button type='submit' name='breed_id' value='".$entry['breed_id']."'><img width='33%' src='images/icons/heart-".$entry['favourite_icon'].".png'></button></form></td>
                                <td style='font-weight:bold; width:25%;'>" . $entry['Breed'] . "</td>
                                <td style='width:25%;'>" . $entry['intelligence_desc'] . "</td>
                                <td class='text-center' style='width:15%;'>" . str_repeat("&#x1F4B2;",$entry['lifetime_cost_class']) . "</td>
                                <td class='text-left' style='width:15%;'>" . str_repeat("&#x2B50;",$entry['popularity_class']) . "</td>
                                <td style='width:20%;'> <img src='images/icons/dog_size_{$entry['size_class']}' alt='dog size chart' width='50%'> </td>
                            </tr>";
                    }
                    mysqli_close($conn)
                ?>
            <tbody>
        </table>
    </div>
    <!-- End main page body -->

    <!-- import footer -->
    <?php include('partials/footer.php'); ?>
</body>

</html>