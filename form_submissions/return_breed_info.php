<?php
require_once "../config/constants.php";

// Returns breed information (values of the supplied lookup_field, eg. "size_class" and the matching breed_ids)
if (isset($_GET['lookup_field'])) {
    $lookup_field = $_GET['lookup_field'];

    // Return a list of values and their associated breed_ids
    $response = [];
    $res = mysqli_query($conn, "SELECT breed_id, {$lookup_field} FROM dog_breeds ORDER BY {$lookup_field}");
    while($entry = mysqli_fetch_array($res)) {
        $response[$entry['breed_id']] = $entry[$lookup_field];
    }
    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($response);
}
