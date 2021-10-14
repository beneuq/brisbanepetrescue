<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- import generic head section -->
    <?php
    $page_title = 'Breeds';
    include('partials/head.php');
    $active_dogs = 'active';
    ?>
</head>

<body class="banner">
<div id="top"></div>
<div class="underneath-nav"></div>
<!-- import menu -->
<?php include('partials/menu.php'); ?>

<div class="pg-section wrapper container">
    <fieldset id="logout-btn" class="input-card">
        <legend>You have been logged out of your account</legend>
        <div class="form-group">
            <p>Redirecting to homepage in <span id="remaining-secs">3 </span> seconds...</p>
        </div>
        <fieldset>
</div>

<script type="text/javascript">
    let remaining_secs = 3;
    setInterval(function () {
        remaining_secs--;
        document.getElementById("remaining-secs").textContent = remaining_secs.toString();
        if (remaining_secs <= 0)
            window.location.href = '/'
    }, 1000);
</script>

<!-- import footer -->
<?php include('partials/footer.php'); ?>
</body>

</html>