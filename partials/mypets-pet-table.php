<?php
    include_once "config/constants.php";
/**
 * This file is designed to be called from mypets.php.
 * It is the logic and HTML for the dog overview table.
 */
?>
<table class="breeds-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Birthday</th>
            <th>Adopted</th>
            <th>Gender</th>
            <th>Desexed</th>
            <th>Vaccinated</th>
            <th>Worming Tablet</th>
            <th>Tick Medication</th>
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
                DATE_FORMAT(dob, '%M %D') as birthday,
                gender,
                desexed,
                vaccinated,
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
        ");

        while($entry = mysqli_fetch_array($res)) {
            // Hide countdown or set to red if null or overdue
            if (is_null($entry['worm_meds_due'])) {
                $add_style_worm = 'font-size:0';
            } else if ($entry['worm_meds_due'] <= 0) {
                $add_style_worm = 'color:red';
            } else {
                $add_style_worm = '';
            }
            if (is_null($entry['tick_meds_due'])) {
                $add_style_tick = 'font-size:0';
            } else if ($entry['tick_meds_due'] <= 0) {
                $add_style_tick = 'color:red';
            } else {
                $add_style_tick = '';
            }
            ?>
            <tr id='dog_id=<?php echo $entry['dog_id'];?>'>
            <td style='width:5%;' class='dog-name'><a href='category-dogs.php?dog_id=<?php echo $entry['dog_id'];?>'><?php echo $entry['Dog'];?></a></td>
            <td style='width:10%;' class='breed-name'><a href='category-breeds.php?breed_id=<?php echo $entry['breed_id'];?>'><?php echo $entry['Breed'];?></a></td>
            <td style='width:5%;'><?php echo $entry['age'];?></td>
            <td style='width:5%;'><?php echo $entry['birthday'];?></td>
            <td style='width:10%;'><?php echo $entry['adoption_date'];?></td>
            <td style='width:5%;'><img src='/images/icons/<?php echo $entry['gender'];?>.png' alt='dog image' width='20%'></td>
            <td style='width:5%;'><img src='/images/icons/boolean-checkbox-<?php echo $entry['desexed'];?>.png' alt='dog image' width='25%'></td>
            <td style='width:5%;'><img src='/images/icons/boolean-checkbox-<?php echo $entry['vaccinated'];?>.png' alt='dog image' width='25%'></td>
            <td style='width:5%;<?php echo $add_style_worm;?>'><?php echo $entry['worm_meds_due'];?> days</td>
            <td style='width:5%;<?php echo $add_style_tick;?>'><?php echo $entry['tick_meds_due'];?> days</td>
            <td style='width:10%;'> <img src='<?php echo SITEURL.$entry['path'];?>' alt='dog image' width='50%'> </td>
        </tr>
        <?php
            }
            mysqli_close($conn);
        ?>
    <tbody>
</table>