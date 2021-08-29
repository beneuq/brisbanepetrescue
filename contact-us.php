<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- import generic head section -->
        <?php 
        $page_title = 'Contact Us';
        include('partials/head.php'); 
        $active_contact = 'active';
        ?>
    </head>

    <body>
        <div class="underneath-nav"></div>
        <!-- import menu -->
        <?php include('partials/menu.php'); ?>

        <div id="contact-bg">
            <form id="contact" onsubmit="contactSubmit()">
                <fieldset>
                    <legend>
                        Contact Us
                    </legend>
                    <div id="contact-inf">
                        <div>
                            <label>Name:</label>
                            <input type="text" placeholder="First and last names" required>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="email" placeholder="Enter a valid email address" required>
                        </div>
                        <div>
                            <label>Message:</label>
                            <textarea placeholder="Write something.." required></textarea>
                        </div>
                        <button type="submit" value="Submit">SUBMIT</button>
                    </div>
                        
                </fieldset>

            </form>
        </div>
        <!-- FOOTER -->
        <?php include('partials/footer.php'); ?>
    </body>
    
</html>