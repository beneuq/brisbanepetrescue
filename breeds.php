<!DOCTYPE html>
<html lang="en">

<head>
    <title>Brisbane Pet Rescue - Breeds</title>
    <!-- import generic head section -->
    <?php include('partials/head.php'); ?>
</head>

<body>
<!-- import menu -->
<?php include('partials/menu.php'); ?>

<!-- Start main page body -->
<h1>Dog Breeds</h1>

<!--
This code iterates through the database and adds a table row for each breed in the database
TODO: @Front-end guys - someone wanna come up with a way to format this nicely?
        I have an example of how it works below
        All DB Fields here: http://35.213.206.232/phpmyadmin/tbl_structure.php?server=1&db=pet_rescue_db&table=dog_breeds
        Maybe use some sort of visual icons for size, energy, etc. if you can do this with HTML, JS, or PHP like I have started below
        Photos will be there too eventually, so maybe leave a space for one of those.
        Doesn't have to be a table if you'd rather use something else.
-->
<div id="sqldata">
    <table class="breed-table">
        <thead>
            <tr>
                <th>Breed</th>
                <th>Intelligence</th>
                <th>Lifetime Cost</th>
                <th>Popularity</th>
                <th class="text-left">Size Class</th>
            </tr>
        <thead>
        <tbody>
            <?php
                $res = mysqli_query($conn,"SELECT * FROM dog_breeds ORDER BY Breed ");
                while($entry = mysqli_fetch_array($res)) {
                    $size_image = "images/icons/dog_size_" . $entry['size_class'];
                    echo "<tr>
                            <td>" . $entry['Breed'] . "</td>
                            <td>" . $entry['intelligence_desc'] . "</td>
                            <td class='text-center'>" . str_repeat("&#x1F4B2;",$entry['lifetime_cost_class']) . "</td>
                            <td>" . str_repeat("&#x2B50;",$entry['popularity_class']) . "</td>
                            <td> <img src='images/icons/dog_size_{$entry['size_class']}' alt='dog size chart' width='15%'> </td>
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