<?php
//Start Session
session_start();

// Debug Flags:
// Set to true if running test server locally, some features will not work.
const SKIP_DB_CONNECTION = false;
// Set to false to avoid using up our maximum free 5000 results/month, only set to true when ready to test
const USE_GOOGLE_MAPS_API = true;

// Create Constants to Store Non Repeating Values
const SITEURL = 'https://brisbanepetrescue.me/';
const LOCALHOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'PL6VCaRJ978WB4';
const DB_NAME = 'pet_rescue_db';
const GOOGLE_MAPS_API_KEY = USE_GOOGLE_MAPS_API ? 'AIzaSyD008QAqbvBSWA-fQ0CUkDFkcuEzime1yQ' : 'avoiding-using-free-credits';

// Emojis
const EMOJI_DOLLAR = "&#x1F4B2;";
const EMOJI_STAR = "&#x2B50;";

// creates database connection if one doesn't exist
if (!SKIP_DB_CONNECTION) {
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME); //Database Connection
    if (!$conn) {
        die("Could not connect to db" . mysqli_connect_error());
    }
}

require_once "helper_functions.php";
