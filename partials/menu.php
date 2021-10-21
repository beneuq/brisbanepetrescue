<?php require_once "config/constants.php"; ?>
<!-- Navigation bar -->
<div id="main-menu">

    <nav role="navigation"> 
        <div id="menuToggle-2">
            

            <input type="checkbox" id="check1"/>
            
            <img src="/images/account-icon.png" alt="Account icon" width="33px" height="33px" id="mobileLogin">
            
            <span></span>
            <span></span>
            <span></span>

           
            <ul id="menu-2">
                <?php
                    $account_page = logged_in() ? "/account.php" : "/login.php";
                    $favourites_page = logged_in() ? "/favourites.php" : "/login.php";
                    $mypets_page = logged_in() ? "/mypets.php" : "/login.php";
                    $login_caption = logged_in() ? $_SESSION['firstname'] : "Login";
                    $account_caption = logged_in() ? "Account" : "Login";
                ?>
                <li>
                    <button onclick="location.href = '<?php echo $account_page ?>'">
                        
                        <a><?php echo $account_caption?></a>
                
                    </button>
                </li>
                <li>
                    <button onclick="location.href = '<?php echo $favourites_page ?>'">
                        <a>Favourites</a>
                    </button>
                </li>
                <li>
                    <button onclick="location.href = '<?php echo $mypets_page ?>'">
                        <a>My Pets</a>
                    </button>
                </li>
                <?php if (logged_in()) { ?>
                    <li>
                        <button onclick="location.href = '/logout.php'">
                            <a>Logout</a>
                        </button>
                    </li>
                <?php } ?>
                
            </ul>
        </div>
    </nav>
   
    <!-- Top half of navigation bar -->
    <div class="container flex" id="top-nav">
        <a href="/index.php">
            <div class="main-logo">
                <img src="/images/paw-logo-2-white.png" alt="BPR logo" height="26px">
                <span>Brisbane Pet Rescue</span>
            </div>
        </a>
        <!-- Searchbar -->
        <div id="searchbar">
            <form action="/search.php" method="POST" class="flex">
                <input type="text" placeholder="Search for dogs...">
                <button><img src="/images/search-icon.png" alt="Search icon" width="20px" height="20px"></button>
            </form>
        </div>

        <!-- Account Icons -->
        <div id="user-icons" class="sm-d-none">
            <button onclick="location.href = '<?php echo $account_page ?>'">
                <figure>
                    <img src="/images/account-icon.png" alt="Account icon" width="40px" height="40px">
                    <p><?php echo $login_caption?></p>
                </figure>
            </button>
            <button onclick="location.href = '<?php echo $favourites_page ?>'">
                <figure>
                    <img src="/images/favourites-icon.png" alt="Favourites icon" width="40px" height="40px">
                    <p>Saved</p>
                </figure>
            </button>
            <button onclick="location.href = '<?php echo $mypets_page ?>'">
                <figure>
                    <img src="/images/icons/kennel.png" alt="Favourites icon" width="40px" height="40px">
                    <p>My Pets</p>
                </figure>
            </button>


        </div>
    </div>

    <nav role="navigation"> 
        <div id="menuToggle">
            
            <input type="checkbox" id="check2"/>

            <span></span>
            <span></span>
            <span></span>  


            <ul id="menu">
                <li class="<?php echo $active_home; ?>">
                    <a href="/index.php">Home</a>
                </li>
                <li class="<?php echo $active_dogs; ?>">
                    <a href="/dogs.php">Dogs</a>
                </li>
                <li class="<?php echo $active_breeds; ?>">
                    <a href="/breeds.php">Breeds</a>
                </li>
                <li class="<?php echo $active_about_us; ?>">
                    <a href="/about-us.php">About Us</a>
                </li>
                <li class="<?php echo $active_pet_help; ?>">
                    <a href="/help.php">Pet Help</a>
                </li>
                <li class="<?php echo $active_contact; ?>">
                    <a href="/contact-us.php">Contact</a>
                </li>
            </ul>

        </div>
    </nav>

    <!-- Bottom half of navigation bar -->
    <!-- Navigation bar links -->
    <div id="bottom-nav" class="container sm-v-hidden">
        <ul class="flex">
            <li class="<?php echo $active_home; ?>">
                <a href="/index.php">Home</a>
            </li>
            <li class="<?php echo $active_dogs; ?>">
                <a href="/dogs.php">Dogs</a>
            </li>
            <li class="<?php echo $active_breeds; ?>">
                <a href="/breeds.php">Breeds</a>
            </li>
            <li class="<?php echo $active_about_us; ?>">
                <a href="/about-us.php">About Us</a>
            </li>
            <li class="<?php echo $active_pet_help; ?>">
                <a href="/help.php">Pet Help</a>
            </li>
            <li class="<?php echo $active_contact; ?>">
                <a href="/contact-us.php">Contact</a>
            </li>
        </ul>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/uncheck.js"></script>
</div>