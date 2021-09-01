<!DOCTYPE html>
<html lang="en">

<head>
    <!-- import generic head section -->
    <?php
    $page_title = 'Dogs';
    include('partials/head.php');
    $active_dogs = 'active';
    ?>
</head>

<body>
<div class="underneath-nav"></div>
<!-- import menu -->
<?php include('partials/menu.php'); ?>

<!-- Start main page body -->
<h1 class="breed-title">Dogs looking for a home</h1>

<!-- This code iterates through the database and adds a table row for each breed in the database -->
<div id="sqldata">
    <table class="breeds-table">
        <thead>
        <tr>
            <th></th>
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
        $res = mysqli_query($conn,"
            SELECT dogs.name as Dog, Breed, age, gender, shelters.name as Shelter, path, dog_id
            FROM dogs 
            INNER JOIN shelters ON dogs.shelter_id = shelters.shelter_id
            INNER JOIN dog_breeds ON dogs.breed_id = dog_breeds.breed_id
            INNER JOIN breed_image ON dogs.breed_id = breed_image.breed_id
            WHERE owner_id IS NULL
            AND main_image
            ORDER BY dogs.name
        ");
        while($entry = mysqli_fetch_array($res)) {
            echo "<tr>
                    <td style='width:5%;' class='text-center'><form method='POST' action='/form_submissions/favourite_dog.php'> <button type='submit' name='dog_id' value='".$entry['dog_id']."'>Shortlist</button></td></form>
                    <td style='font-weight:bold; width:20%;'>" . $entry['Dog'] . "</td>
                    <td style='width:20%;'>" . $entry['Breed'] . "</td>
                    <td style='width:10%;'>" . $entry['age'] . " years</td>
                    <td style='width:10%;'> <img src='/images/icons/". $entry['gender'] .".png' alt='dog image' width='20%'> </td>
                    <td style='width:20%;'>" . $entry['Shelter'] . "</td>
                    <td style='width:20%;'> <img src='". SITEURL.$entry['path'] ."' alt='dog image' width='50%'> </td>
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