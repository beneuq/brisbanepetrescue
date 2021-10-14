<?php
    include_once "config/constants.php";
    enforce_login();
    $user_id = get_userid();
?>
<!-- Import slider script -->
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
<?php
// Create SQL Query to get the selected breed
$sql2 = "
SELECT DISTINCT
        d.name AS Dog,
        Breed,
        age,
        DATE_FORMAT(adoption_date, '%M %D, %Y') as adoption_date,
        DATE_FORMAT(dob, '%M %D') as birthday,
        gender,
        desexed,
        vaccinated,
        council_registration_id,
        path,
        d.dog_id AS dog_id,
        d.breed_id AS breed_id,
        DATEDIFF(DATE_ADD(last_worming_medication, INTERVAL worming_medication_frequency DAY), SYSDATE()) as worm_meds_due,
        DATEDIFF(DATE_ADD(last_tick_medication, INTERVAL tick_medication_frequency DAY), SYSDATE()) as tick_meds_due
        FROM dogs d
            INNER JOIN dog_breeds b ON d.breed_id = b.breed_id
            INNER JOIN breed_image bi ON d.breed_id = bi.breed_id
            LEFT JOIN favourite_dogs f ON d.dog_id = f.dog_id
        WHERE owner_id=". get_userid()."
            AND main_image  
        ORDER BY d.name
";

//Execute the Query
$res2 = mysqli_query($conn, $sql2);

//Count the Rows
$count2 = mysqli_num_rows($res2);

// Check whether data is available or not
if ($count2 <= 0) {
    // Todo make this look better
    echo "<h1>You haven't adopted any pets yet. Adopt one first then come back and check this page out!</h1>";
} else {
?>
<div class="glide glide-mypets">
    <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
            <?php
            // Data is Available
            while ($row2 = mysqli_fetch_assoc($res2)) {
            ?>
            <!-- use slider -->
            <!-- TODO Add more info: Council ID, Vaccination, Desex status, Birthday, etc. -->
            <li class="glide__slide glide__slide__mypets">
                <div class="profile-box profile-box-mypets float-container" id='dog_id=<?php echo $row2['dog_id']; ?>'>
                    <td><a href='/dog-profile.php?dog_id=<?php echo $row2['dog_id']; ?>'><img src='<?php echo SITEURL . $row2['path']; ?>' alt='dog image' width='100%'></a></td>
                    <td style="vertical-align: middle;"><a class='dog-card-name' href='/dog-profile.php?dog_id=<?php echo $row2['dog_id']; ?>'>
                                <?php echo $row2['Dog']; ?>&nbsp;&nbsp;<img src='/images/icons/<?php echo $row2['gender']; ?>.png' alt='dog gender' width='6%'>
                        </a></td>
                    <td><a href='/breed-profile.php?breed_id=<?php echo $row2['breed_id']; ?>'>
                            <?php echo $row2['age']; ?> y/o <?php echo $row2['Breed']; ?>
                        </a></td>
                    <td><p>Council Registration: <?php echo $row2['council_registration_id']; ?></p></td>
                    <td><p>
                            Desexed: <img src='/images/icons/boolean-checkbox-<?php echo $row2['desexed'];?>.png' width='8%'>
                            Vaccinated: <img src='/images/icons/boolean-checkbox-<?php echo $row2['vaccinated'];?>.png' width='8%'>
                        </p></td>
                    <td><p>Birthday: <?php echo $row2['birthday'];?></p></td>
                    <td><p>Adopted: <?php echo $row2['adoption_date'];?></p></td>
                </div>
            </li>
            <?php
            }
            }
            ?>
        </ul>

    </div>
    <div class="glide__arrows" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
    </div>
</div>
<script>
    const config = {
        type: 'slide',
        perView: 5, //TODO: Do not display duplicates!
        startAt:  <?php echo ($count2/2)-0.1;?>, // Centre on middle (or middle-left) dog
        autoplay: 0,
        breakpoints: {
            768: {
                perView: 1
            }
        },
        focusAt: 'center',
        gap:-50,
        animationDuration: 300,
    }
    new Glide('.glide', config).mount()
</script>
