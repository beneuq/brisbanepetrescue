<?php
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'My Pets';
        include('partials/head.php'); 
        $active_home = 'active';
        ?>
    </head>
    <body>
        <?php
            $firstname = $_SESSION['firstname'];
            $user_id = $_SESSION['user_id']
        ?>
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

        <!-- Hero Section -->
        <section class="hero-section small-hero pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-bottom-1">My Pets</h1>
                    <h2 class="pad-bottom-2"><?php echo $firstname ?>'s Adopted K-9 Friends</h2>
                    </div>
                    <br>
                </div>
        </section>

        <!-- This code iterates through the database and adds a table row for each dog in the database -->
        <div id="sqldata">
            <table class="breeds-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Adopted</th>
                    <th>Gender</th>
                    <th>Desexed?</th>
                    <th>Vaccinated?</th>
                    <th></th>
                </tr>
                <thead>
                <tbody>
                <?php
                // Gets all dogs, as well as their shelter, and also whether the dog has been shortlisted by the logged-in user
                $res = mysqli_query($conn, "
            SELECT DISTINCT
                d.name AS Dog,
                Breed,
                age,
                DATE_FORMAT(adoption_date, '%M %D, %Y') as adoption_date,
                gender,
                desexed,
                vaccinated,
                path,
                d.dog_id AS dog_id
                FROM dogs d
                    INNER JOIN dog_breeds b ON d.breed_id = b.breed_id
                    INNER JOIN breed_image bi ON d.breed_id = bi.breed_id
                    LEFT JOIN favourite_dogs f ON d.dog_id = f.dog_id
                WHERE owner_id=". get_userid()."
                    AND main_image  
                ORDER BY d.name
        ");
                while($entry = mysqli_fetch_array($res)) {
                    echo "<tr id='dog_id=".$entry['dog_id']."'>
                    <td style='font-weight:bold; width:20%;'>" . $entry['Dog'] . "</td>
                    <td style='width:20%;'>" . $entry['Breed'] . "</td>
                    <td style='width:10%;'>" . $entry['age'] . " years</td>
                    <td style='width:10%;'>" . $entry['adoption_date'] . "</td>
                    <td style='width:10%;'><img src='/images/icons/". $entry['gender'] .".png' alt='dog image' width='20%'></td>
                    <td style='width:10%;'><img src='/images/icons/boolean-checkbox-". $entry['desexed'] .".png' alt='dog image' width='25%'></td>
                    <td style='width:10%;'><img src='/images/icons/boolean-checkbox-". $entry['vaccinated'] .".png' alt='dog image' width='25%'></td>
                    <td style='width:20%;'> <img src='". SITEURL.$entry['path'] ."' alt='dog image' width='50%'> </td>
                </tr>";
                }
                mysqli_close($conn)
                ?>
                <tbody>
            </table>
        </div>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>