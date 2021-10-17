<?php
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'My Favourites';
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
                <div class="flex f-col hero-content hero-content-full-width">
                    <h1 class="pad-bottom-1">Favourites</h1>
                    <h2><?php echo $firstname ?>'s Saved Pets</h2>
                    <p class="pad-bottom-1">You can keep remember your favourite breeds or shortlist dogs by clicking the heart next to them. <br>You can find some that match your personality or explore your options here: </p>

                    <div class="btn-group pad-bottom-2">
                        <a href="quiz.php" class="margin-right-1 hero-btn">Personality quiz</a>
                        <a href="breeds.php" class="margin-right-1 hero-btn hero-btn-alt">Explore breeds</a>
                        <a href="dogs.php" class="hero-btn hero-btn-alt">Explore available dogs</a>
                    </div>
                    <br>
                </div>
<!--                <img class="hero-img" src="images/cute-puppy.png" alt="Cute brown and white puppy sitting down" style="size: 20%">-->
            </div>

            <!-- Favourite Breeds Section -->
            <section id="fav-breeds" class="pg-section min-pg-section" style="background-color: grey;">
                <h2 class="center-txt">Breeds I'm interested in</h2>
                <div id="sqldata">
                    <table class="breeds-table">
                        <thead>
                        <tr>
                            <th>Breed</th>
                            <th>Intelligence</th>
                            <th class='desktop-only'>Lifetime Cost</th>
                            <th class='desktop-only'>Popularity</th>
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
                        WHERE favourite_breeds.user_id = {$user_id}
                        ORDER BY Breed
                        ");
                        while($entry = mysqli_fetch_array($res)) {
                            $size_image = "images/icons/dog_size_" . $entry['size_class'];
                            ?>
                            <!-- Start Individual Breed Row -->
                            <tr id='breed_id=<?php echo $entry['breed_id'];?>'>
                                <td style='font-weight:bold; width:20%;' class='breed-name'>
                                    <a href='breed-profile.php?breed_id=<?php echo $entry['breed_id'];?>' style='color:black'><?php echo $entry['Breed'];?></a>
                                </td>
                                <td class='desktop-only' style='width:22%;'><?php echo $entry['intelligence_desc'];?></td>
                                <td class='desktop-only' class='text-center' style='width:10%;'><?php echo str_repeat(EMOJI_DOLLAR,$entry['lifetime_cost_class']);?></td>
                                <td class='text-left' style='width:10%;'><?php echo str_repeat(EMOJI_STAR,$entry['popularity_class']);?></td>
                                <td class='desktop-only' style='width:16%;'> <img src='images/icons/dog_size_<?php echo $entry['size_class'];?>' alt='dog size chart' width='50%'> </td>
                                <td class='mobile-only' style='width:16%;'> <img src='images/icons/dog_size_<?php echo $entry['size_class'];?>' alt='dog size chart' width='100%'> </td>
                                <td>
                                    <form method='POST' action='/form_submissions/favourite_breed.php'>
                                        <button type='submit' name='breed_id' value='<?php echo $entry['breed_id'];?>'>
                                            <img width='25%' alt='Remove from favourites' src='images/icons/x-icon.png' class="zoom-on-hover">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- End Individual Breed Row -->
                        <?php
                            }
                        ?>
                        <tbody>
                    </table>
                </div>
            </section>

            <!-- Favourite Dogs Section -->
            <section id="fav-dogs" class="pg-section min-pg-section" style="background-color: white;">
                <h2 class="center-txt" style="color: black">Dogs I'm considering adopting</h2>
                <div id="sqldata">
                    <table class="breeds-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Breed</th>
                            <th class='desktop-only'>Age</th>
                            <th class='desktop-only'>Gender</th>
                            <th>Shelter</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <thead>
                        <tbody style="color: black">
                        <?php
                        $res = mysqli_query($conn,"
                            SELECT dogs.name as Dog, Breed, age, gender, shelters.name as Shelter, path, dogs.dog_id, dogs.breed_id as breed_id
                            FROM dogs 
                            INNER JOIN shelters ON dogs.shelter_id = shelters.shelter_id
                            INNER JOIN dog_breeds ON dogs.breed_id = dog_breeds.breed_id
                            INNER JOIN breed_image ON dogs.breed_id = breed_image.breed_id
                            INNER JOIN favourite_dogs on dogs.dog_id = favourite_dogs.dog_id
                            WHERE owner_id IS NULL
                            AND main_image
                            AND user_id = {$user_id}
                            ORDER BY dogs.name
                        ");
                        while($entry = mysqli_fetch_array($res)) {
                            ?>
                            <!-- Start Individual Dog Row -->
                            <tr id='dog_id=<?php echo $entry['dog_id'];?>'>
                                <td style='width:15%;' class='dog-name'><a href='dog-profile.php?dog_id=<?php echo $entry['dog_id'];?>'><?php echo $entry['Dog'];?></a></td>
                                <td style='width:20%;' class='breed-name'><a href='breed-profile.php?breed_id=<?php echo $entry['breed_id'];?>'><?php echo $entry['Breed'];?></a></td>
                                <td class='desktop-only' style='width:10%;'><?php echo $entry['age'];?> years</td>
                                <td class='desktop-only' style='width:5%;'><img src='/images/icons/<?php echo $entry['gender'];?>.png' alt='dog image' width='20%' class="zoom-on-hover"></td>
                                <td style='width:20%;'><?php echo $entry['Shelter'];?></td>
                                <td class='desktop-only' style='width:15%;'><img src='<?php echo SITEURL.$entry['path'];?>' alt='dog image' width='33%'></td>
                                <td>
                                    <form method='POST' action='/form_submissions/favourite_dog.php'>
                                        <button type='submit' name='dog_id' value='<?php echo $entry['dog_id'];?>'>
                                            <img width='25%' alt='Remove from favourites' src='images/icons/x-icon.png' class="zoom-on-hover">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- End Individual Dog Row -->
                        <?php
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