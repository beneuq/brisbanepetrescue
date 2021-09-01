<?php
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'My Account';
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
        <section class="hero-section pos-relative">
            <div class="flex container">
                <div class="flex f-col hero-content">
                    <h1 class="pad-bottom-1">My Account</h1>
                    <h2 class="pad-bottom-1">Welcome back, <?php echo $firstname ?>!</h2>
                    <p class="pad-bottom-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat id earum iste minus sed libero alias nam illo aut nemo deserunt, temporibus necessitatibus ad, magnam est facere? Cumque adipisci quis aliquam.</p>

                    <div class="pad-bottom-2">
                        <a href="dogs.php" class="margin-right-1 hero-btn">Available Dogs</a>
                        <a href="#" class="hero-btn hero-btn-alt">Personality Quiz</a>
                    </div>
                    <br>
                    <div class="pad-bottom-2">
                        <a href="logout.php" class="hero-btn hero-btn-alt">Logout</a>
                    </div>
                </div>
                <img class="hero-img" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down">
            </div>

            <!-- Section 3 -->
            <section class="pg-section" style="background-color: grey;">
                <h2 class="center-txt">Breeds I'm interested in</h2>
                <div id="sqldata">
                    <table class="breeds-table">
                        <thead>
                        <tr>
                            <th>Breed</th>
                            <th>Intelligence</th>
                            <th>Lifetime Cost</th>
                            <th>Popularity</th>
                            <th class="text-left">Size Class</th>
                            <th></th>
                        </tr>
                        <thead>
                        <tbody style="color: black">
                        <?php
                        $res = mysqli_query($conn,"
                        SELECT * 
                        FROM dog_breeds 
                        INNER JOIN favourite_breeds on dog_breeds.breed_id = favourite_breeds.breed_id
                        WHERE favourite_breeds.user_id = ".$user_id."
                        ORDER BY Breed
                        ");
                        while($entry = mysqli_fetch_array($res)) {
                            $size_image = "images/icons/dog_size_" . $entry['size_class'];
                            echo "<tr id='breed_id=".$entry['breed_id']."'>
                                <td style='font-weight:bold; width:20%;'>" . $entry['Breed'] . "</td>
                                <td style='width:25%;'>" . $entry['intelligence_desc'] . "</td>
                                <td class='text-center' style='width:10%;'>" . str_repeat("&#x1F4B2;",$entry['lifetime_cost_class']) . "</td>
                                <td class='text-left' style='width:10%;'>" . str_repeat("&#x2B50;",$entry['popularity_class']) . "</td>
                                <td style='width:10%;'> <img src='images/icons/dog_size_{$entry['size_class']}' alt='dog size chart' width='50%'> </td>
                                <td style='width:5%;'><form method='POST' action='/form_submissions/favourite_breed.php'> <button type='submit' name='breed_id' value='".$entry['breed_id']."'><img width='20% alt='Remove from favourites' src='images/icons/x-icon.png'></button></form></td>
                            </tr>";
                        }
                        ?>
                        <tbody>
                    </table>
                </div>
            </section>

            <!-- Section 4 -->
            <section class="pg-section" style="background-color: white;">
                <h2 class="center-txt" style="color: black">Dogs I'm considering adopting</h2>
                <div id="sqldata">
                    <table class="breeds-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Breed</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Shelter</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <thead>
                        <tbody style="color: black">
                        <?php
                        $res = mysqli_query($conn,"
                            SELECT dogs.name as Dog, Breed, age, gender, shelters.name as Shelter, path, dogs.dog_id
                            FROM dogs 
                            INNER JOIN shelters ON dogs.shelter_id = shelters.shelter_id
                            INNER JOIN dog_breeds ON dogs.breed_id = dog_breeds.breed_id
                            INNER JOIN breed_image ON dogs.breed_id = breed_image.breed_id
                            INNER JOIN favourite_dogs on dogs.dog_id = favourite_dogs.dog_id
                            WHERE owner_id IS NULL
                            AND main_image
                            AND user_id = ".$user_id."
                            ORDER BY dogs.name
                        ");
                        while($entry = mysqli_fetch_array($res)) {
                            echo "<tr id='dog_id=".$entry['dog_id']."'>
                                <td style='font-weight:bold; width:15%;'>" . $entry['Dog'] . "</td>
                                <td style='width:20%;'>" . $entry['Breed'] . "</td>
                                <td style='width:10%;'>" . $entry['age'] . " years</td>
                                <td style='width:5%;'> <img src='/images/icons/". $entry['gender'] .".png' alt='dog image' width='20%'> </td>
                                <td style='width:20%;'>" . $entry['Shelter'] . "</td>
                                <td style='width:15%;'> <img src='". SITEURL.$entry['path'] ."' alt='dog image' width='33%'> </td>
                                <td style='width:5%;'><form method='POST' action='/form_submissions/favourite_dog.php'> <button type='submit' name='dog_id' value='".$entry['dog_id']."'><img width='25%' alt='Remove from favourites' src='images/icons/x-icon.png'></button></form></td>
                            </tr>";
                        }
                        mysqli_close($conn);
                        ?>
                        <tbody>
                    </table>
                </div>
            </section>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>