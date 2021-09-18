<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Brisbane Pet Rescue | <?php echo $page_title; ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/style.css">
<link rel="icon" href="/images/paw-logo-2-purple.png">
<!-- Fonts Here -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Changa:wght@600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Changa:wght@600;700;800&family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">

<!-- Import Constants -->
<?php
$active_home = '';
$active_dogs = '';
$active_breeds = '';
$active_about_us = '';
$active_help = '';
$active_contact = '';
require_once 'config/constants.php';
?>

<!-- creating function for printing to console -->
<?php
function consolePrintArgs()
{
    if (func_num_args() > 0) {
        $htmlString = "<script>";
        $funcArgs = func_get_args();
        foreach (array_keys($funcArgs) as $argKey) {
            $arg = $funcArgs[$argKey];
            $htmlString .= "console.log(\"$argKey: " . strval($arg) . "\");";
            if (is_array($arg)) {
                foreach (array_keys($arg) as $key) {
                    $htmlString .= "console.log(\"$argKey: $key: " . $arg[$key] . "\");";
                }
            }
        }
        $htmlString .= "</string>";
        echo $htmlString;
    }
}
?>