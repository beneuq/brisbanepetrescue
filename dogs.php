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
<div id="sqldata">
    <table class="breeds-table">
        <thead>
        <tr>
            <th>Shortlist</th>
            <th>Name</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Shelter</th>
            <th></th>
        </tr>
        <thead>
        <tbody>
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
            <!-- Start Individual Dog Row -->
            <tr id='dog_id=<?php echo $entry['dog_id'];?>'>
                <td style='width:10%;'>
                    <form method='POST' action='/form_submissions/favourite_dog.php'>
                        <button type='submit' name='dog_id' value='<?php echo $entry['dog_id'];?>'>
                            <img width='20%' src='images/icons/heart-<?php echo $entry['favourite_icon'];?>.png'
                                 onmouseover='favHover(this,"<?php echo $entry['favourite_icon'];?>");'
                                 onmouseout='favUnhover(this,"<?php echo $entry['favourite_icon'];?>");'
                            >
                        </button>
                    </form>
                </td>
                <td style='width:14%;' class='dog-name'><a href='category-dogs.php?dog_id=<?php echo $entry['dog_id'];?>'><?php echo $entry['Dog'];?></a></td>
                <td style='width:14%;' class='breed-name'><a href='category-breeds.php?breed_id=<?php echo $entry['breed_id'];?>'><?php echo $entry['Breed'];?></a></td>
                <td style='width:14%;'><?php echo $entry['age'];?> years</td>
                <td style='width:10%;'><img src='/images/icons/<?php echo $entry['gender'];?>.png' alt='dog image' width='20%'></td>
                <td style='width:18%;'><?php echo $entry['Shelter'];?></td>
                <td style='width:22%;'><img src='<?php echo SITEURL.$entry['path'];?>' alt='dog image' width='50%'></td>
            </tr>
            <!-- End Individual Dog Row -->
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