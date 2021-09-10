/**
 * This script was built to enable the use of the Google Maps Places API to populate nearby locations.
 * The free subscription provides only 5000 RESULTS per month, so please set DO_NOT_USE_GOOGLE_MAPS_API
 *      (in constants.php) to true when not in use.
 */

let latitude;
let longitude;
let service;

let maxResults = 5; //Be sure to limit radius as well - maxResults just hides extra results, queries still take place!
let radiusVet = 5000; // metres
let radiusDogPark = 5000; // metres

// Initiate request for location permission
getCoordinates();

/**
 * Get and store the current location of the user (requests permission from browser)
 */
function getCoordinates() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(storeCoordinatesAndDisplay);
    } else {
        alert("Error: Could not get current location.")
    }
}

/**
 * Stores the current location of user as GPS coordinates and fills the table with info
 */
function storeCoordinatesAndDisplay(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    queryNearbyVets(latitude, longitude, radiusVet)
    queryNearbyDogParks(latitude, longitude, radiusDogPark)
}

/** Queries the nearby veterinary clinics (radius is in metres) */
function queryNearbyVets(latitude, longitude, radius) {
let currentLocation = new google.maps.LatLng(latitude, longitude);
let request = {
    location: currentLocation,
    radius: radius.toString(),
    type: ['veterinary_care']
    };
    service = new google.maps.places.PlacesService(document.getElementById("map"));
    service.nearbySearch(request, displayNearbyVets);
}

/** Callback function: Formats and displays the nearby vet clinics */
function displayNearbyVets(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        displayNearby(results, "vet-clinics", maxResults)
    }
}

/** Queries the nearby veterinary clinics (radius is in metres) */
function queryNearbyDogParks(latitude, longitude, radius) {
    let currentLocation = new google.maps.LatLng(latitude, longitude);
    let request = {
        location: currentLocation,
        radius: radius.toString(),
        keyword: 'dog park'
    };
    service = new google.maps.places.PlacesService(document.getElementById("map"));
    service.nearbySearch(request, displayNearbyDogParks);
}

/** Callback function: Formats and displays the nearby dog parks */
function displayNearbyDogParks(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        displayNearby(results, "dog-parks", maxResults)
    }
}

/**
 * Formats and displays locations in their correct location in the table
 * @param results Results array from service.nearbySearch() API call
 * @param tableHeaderID ID of the table header for this nearby location type
 *      (results are added as table rows beneath this row)
 * @param maxResults Maximum number of results to display - use caution here as it just limits the shown results,
 *      and not the queried results (set a small radius to avoid hitting our 5000 limit)
 */
function displayNearby(results, tableHeaderID, maxResults) {
    let nearbyTable = document.getElementById("nearby-places");
    let vetClinicsRowStart = document.getElementById(tableHeaderID).rowIndex + 1;
    for (let i = 0; i < results.length && i < maxResults; i++) {
        console.log(results[i]); // todo remove this once happy with data being shown
        let newRow = nearbyTable.insertRow(vetClinicsRowStart+i)
        let nameCell = newRow.insertCell(0);
        let locationCell = newRow.insertCell(1);
        let ratingCell = newRow.insertCell(2);
        nameCell.innerText = results[i].name;
        locationCell.innerText = results[i].vicinity;
        if (results[i].user_ratings_total != null && results[i].user_ratings_total > 0) {
            ratingCell.innerText = "⭐".repeat(results[i].rating) + " (" + results[i].user_ratings_total + ")";
        } else {
            ratingCell.innerText = "No Ratings"
        }

    }
}
