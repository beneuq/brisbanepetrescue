<!-- Navigation bar -->
<nav id="main-menu" class="pad-top-1 pad-bottom-1">
    <!-- Top half of navigation bar -->
    <div class="container flex">
        <a class="main-logo pad-bottom-1" href=index.php>Brisbane Pet Rescue</a>
        <!-- Searchbar -->
        <div id="searchbar">
            <form action="<?php echo SITEURL; ?>search.php" method="POST" class="flex">
                <input type="text" placeholder="Search for dogs...">
                <button><img src="images/search-icon.png" alt="Search icon" width="20px" height="20px"></button>
            </form>
        </div>
        
            <!-- Account Icons -->
        <div id="user-icons">
            <button>
                <img src="images/account-icon.png" alt="Acount icon" width="40px" height="40px">
            </button>
            <button>
                <img src="images/favourites-icon.png" alt="Favourites icon" width="40px" height="40px">
            </button>
        </div>
    </div>

    <!-- Top half of navigation bar -->
    <!-- Navigation bar links -->
    <div class="container">
        <ul class="flex">
            <li class="<?php echo $active_home; ?>">
                <a href="index.php">Home</a>
            </li>
            <li class="<?php echo $active_dogs; ?>">
                <a href="dogs.php">Dogs</a>
            </li>
            <li class="<?php echo $active_about_us; ?>">
                <a href="about-us.php">About Us</a>
            </li>
            <li class="<?php echo $active_help; ?>">
                <a href="help.php">Pet Help</a>
            </li>
            <li class="<?php echo $active_contact; ?>">
                <a href="contact-us.php">Contact</a>
            </li>
        </ul>
    </div>
</nav>