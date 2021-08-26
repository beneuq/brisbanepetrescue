<?php
    //Start Session
    session_start();

    // Set to true if running test server locally, some features will not work.
    const SKIP_DB_CONNECTION = false;

    //Create Constants to Store Non Repeating Values
    const SITEURL = 'https://brisbanepetrescue.me/';
    const LOCALHOST = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'PL6VCaRJ978WB4';
    const DB_NAME = 'pet_rescue_db';

    if (!SKIP_DB_CONNECTION) {
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME); //Database Connection
        if (!$conn) {
            die("Could not connect to db" . mysqli_connect_error());
        }
    }
