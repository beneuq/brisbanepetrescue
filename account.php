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
                        <a href="#" class="margin-right-1 hero-btn">Available Dogs</a>
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
                <h2>Breeds I'm interested in</h2>
                <div id="sqldata">
                    <table class="breeds-table">
                        <thead>
                        <tr>
                            <th>Breed</th>
                            <th>Intelligence</th>
                            <th>Lifetime Cost</th>
                            <th>Popularity</th>
                            <th class="text-left">Size Class</th>
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
                            echo "<tr>
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
            </section>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
</html>