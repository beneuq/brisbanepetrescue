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
    <?php include('partials/menu.php'); ?>

    <!-- Start main page body -->
    <h1 class="table-title">Dogs looking for a home</h1>

    <!-- Adding the filter section -->
    <div id="filters">
        <?php
        // adding the filters section
        // filters display based on filter table choosen in db 
        // creates filter conditions for populating list
        $filterTable = "pet_filters";
        $table = "((dogs 
        INNER JOIN dog_breeds ON dogs.breed_id = dog_breeds.breed_id)
        INNER JOIN shelters ON dogs.shelter_id= shelters.shelter_id) ";
        $page = "dogs.php";
        include('partials/filter-menu.php') ?>
    </div>

    <div class="favs-filter">
        <?php
        // Adding filter by favourites button
        // If user isn't logged in (can't see favourites) then prompt them to log in
        if (logged_in()) {
            echo "<a href='" . createLink($page, $_GET, false, array("Breed" => get_breed_favourites())) . "'>Only show my favourite breeds</a>";
        } else {
            echo "<a href='/login.php?display-error'>Login to filter by favourites</a>";
        }
        ?>
    </div>
    
    <!-- This code iterates through the database and adds a table row for each dog in the database -->
    <section class="categories">
        <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">Top</button>

        <div class="container">
            <div id="sqldata">
                <?php
                $user_id_for_sql = logged_in() ? get_userid() : "NULL";
                // Gets all dogs, as well as their shelter, and also whether the dog has been shortlisted by the logged-in user
                // uses filters created in filter-menu.php to filter list
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
                        INNER JOIN (SELECT i.* FROM breed_image i INNER JOIN dogs di WHERE i.breed_id=di.breed_id ORDER BY RAND()) as bi ON d.breed_id = bi.breed_id
                        LEFT JOIN favourite_dogs f ON d.dog_id = f.dog_id
                    WHERE owner_id IS NULL 
                        AND (user_id={$user_id_for_sql} OR user_id IS NULL) $whereFilters
                        ORDER BY RAND()
            ");
                // creates each dog profile for the dogs returned based on filters
                while ($entry = mysqli_fetch_array($res)) {
                ?>
                    <div class="profile-box float-container" id='dog_id=<?php echo $entry['dog_id']; ?>'>
                        <td><a href='dog-profile.php?dog_id=<?php echo $entry['dog_id']; ?>'><img src='<?php echo SITEURL . $entry['path']; ?>' alt='dog image' width='100%'></a></td>
                        <td style="vertical-align: middle;"><a class='profile-text' id='profile-title' href='dog-profile.php?dog_id=<?php echo $entry['dog_id']; ?>'>
                                <p>
                                    <?php echo $entry['Dog']; ?>
                                    <img src='/images/icons/<?php echo $entry['gender']; ?>.png' alt='dog gender' width='5%'>
                                </p>
                            </a></td>
                        <td><a class="profile-text" href='breed-profile.php?breed_id=<?php echo $entry['breed_id']; ?>'>
                                <?php echo $entry['Breed']; ?>
                            </a></td>
                        <td></td>
                        <td>
                            <p><?php echo $entry['age']; ?> years old - <?php echo $entry['Shelter']; ?></p>
                        </td>
                        <td>
                            <form method='POST' action='/form_submissions/favourite_dog.php'>
                                <button type='submit' name='dog_id' value='<?php echo $entry['dog_id']; ?>'>
                                    <img width='10%' src='images/icons/heart-<?php echo $entry['favourite_icon']; ?>.png' onmouseover='favHover(this,"<?php echo $entry['favourite_icon']; ?>");' onmouseout='favUnhover(this,"<?php echo $entry['favourite_icon']; ?>");'>
                                </button>
                            </form>
                        </td>
                    </div>
                <?php
                }
                mysqli_close($conn)
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

    <!-- End main page body -->

    <!-- import footer -->
    <?php include('partials/footer.php'); ?>
</body>

</html>