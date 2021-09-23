// Number of compatible breeds to show
const NUM_RESULTS_TO_SHOW = 6;

// Current answers and N/A will be stored in this array
let answersSelected = {};
let currentNA = {};

// Iterate through all sliders and update them per the below
let answerSliders = document.getElementsByClassName("quizAnswer");
let answerNA = document.getElementsByClassName("N/A");
console.log(answerNA);
for (let i = 0; i < answerSliders.length; i++) {
    // Default values (to avoid repetition in HTML)
    answerSliders[i].min = 1;
    answerSliders[i].max = 5;
    answerSliders[i].value = 3;
    // Different default for toggle button
    if (answerSliders[i].classList.contains("quizToggle")) {
        answerSliders[i].step = 4;
        answerSliders[i].value = 1;
    }
    // Assign function to update scores if slider is moved
    answerSliders[i].oninput = function () {
        updateScores(answerSliders[i]);
        autoScroll(i+1);
    };

    // Set scores to the current default value (i.e. 3 for sliders, 1 for toggles)
    updateScores(answerSliders[i], answerNA[i]);
}

// Update the breed compatibility scores based on the given slider
function updateScores(slider, answerNA) {
    let question = slider.id.split("-")[1]; // eg. id="quiz-size_class", so question="size_class"
    let answer = slider.value;
    let previousAnswer = answersSelected[question];

    // Get the current N/A values
    let currentNA = answerNA.value;
    console.log(currentNA);

    // Now update the breed_scores cookie to add scores to compatible breeds


    // Get all breeds and associated class result from SQL
    let xmlReq = new XMLHttpRequest();
    xmlReq.onload = function() {
        let results = JSON.parse(this.response);
        for (let breed_id in results) {
            // Get the cookie
            let breed_scores = JSON.parse(getCookie("breed_scores"));
            // Add following to score: 5-ABS(answer-question_class_for_breed)
            //      eg. If user selects 4 for size_class answer:
            //              # breeds with size_class=1 get +2
            //              # breeds with size_class=2 get +3
            //              # breeds with size_class=3 get +4
            //              # breeds with size_class=4 get +5
            //              # breeds with size_class=5 get +4
            // TODO Also have a "not important to me" checkbox, that doesn't add any score!
            // TODO Add weightings instead of just adding 1-5 (Size probably more important than playfulness, etc.)

            // Whether the slider is inverted to the actual sql data (5<->1, 4<->2)
            const inverted_slider =  slider.classList.contains("quizInvert");
            if (inverted_slider) { // If the slider is inverted to the actual sql data (5<->1, 4<->2)
                breed_scores[breed_id] += Math.abs(answer - results[breed_id]) + 1;
            } else {
                breed_scores[breed_id] += (5 - Math.abs(answer - results[breed_id]));
            }
            // Also revert the score changes made by the last selected answer
            if (previousAnswer) { //todo remove false
                if (inverted_slider) { // If the slider is inverted to the actual sql data (5<->1, 4<->2)
                    breed_scores[breed_id] -= (Math.abs(previousAnswer - results[breed_id]) + 1);
                } else {
                    breed_scores[breed_id] -= (5 - Math.abs(previousAnswer - results[breed_id]));
                }
            }
            // Update the cookie
            setCookie("breed_scores", JSON.stringify(breed_scores), 1);
        }
        // console.log("New Breed Weightings after setting "+question+"="+answer+":");
        // console.log(JSON.parse(getCookie("breed_scores")));

        // Also update the result images
        updateBreedResults();

        // update the answerSelected dictionary with the new answer
        answersSelected[question] = answer;
    };
    xmlReq.open("get", "/form_submissions/return_breed_info.php?lookup_field="+question, true);
    xmlReq.send();
}

function updateBreedResults() {
    let scores_json = JSON.parse(getCookie("breed_scores"));

    // Sort and get breed_ids with top (NUM_RESULTS_TO_SHOW) scores
    let scores = []
    for (let score in scores_json) {
        scores.push([score,scores_json[score]]);
    }
    scores.sort(function(a,b){return b[1] - a[1]});
    let top_arr = (scores.slice(0,NUM_RESULTS_TO_SHOW));
    let top = [];
    for (let top_breed in top_arr) {
        top.push(top_arr[top_breed][0]);
    }
    // console.log("Top "+NUM_RESULTS_TO_SHOW+": "+top.join(", "));
    // console.log("");

    let xmlReq2 = new XMLHttpRequest();
    xmlReq2.onload = function () {
        document.getElementById("compatibleBreeds").innerHTML = this.responseText;
    };
    xmlReq2.open("get", "/partials/breed-cards.php?breed_ids=" + top.join("%2C"), true);
    xmlReq2.send();
}

//After a user input, auto-scrolls to the next question
function autoScroll(questionNum){
    //If we are on the last question, there is no question to scoll to next
    if (questionNum == 11) {
        return;
    }
    let nextquestionNum = questionNum + 1;
    let nextQuestionID =  "p-quiz-q" + nextquestionNum;
    document.getElementById(nextQuestionID).scrollIntoView({behavior: "smooth"});
}

 
function displayResults() {
    let results = document.getElementById("personality-quiz-results");
    results.style.display = "block";
}

// This function here was an adjustment I made to try and count when the submit button is clicked
// pretty much just changes answer when the submit button is clicked. I have checked the console and this
// does work. Pretty much works by checking if the flag has been changed.
let submitClick = document.getElementById('submit');
submitClick.addEventListener('click', submitClicked.bind(null, 1));

//Checks whether the quiz has been submitted before. If so, displays the results after relaoding, rather than 
// hiding them (which is the default)
let results = document.getElementById("personality-quiz-results");
if (sessionStorage.getItem("loadedEarlier")) {
    results.style.display = "block";
    // No clue why this won't work
    // window.addEventListener('DOMContentLoaded', scrollToResults);
    console.log("Quiz submitted");
} else {
    console.log("Quiz not submitted");
    results.style.display = "none";
}

// function scrollToResults() {
//     if (sessionStorage.getItem("loadedEarlier")) {
//         results.scrollIntoView({behavaior: 'smooth'});
//     } 
// }

let ifSubmitClicked = false;
/* Check if the submit button has been clicked */
function submitClicked(change) {
    if (!ifSubmitClicked && !change) {
        return 0;
    } else {
        ifSubmitClicked = true;
        console.log("was clicked");
        
         // puts the results into session storage, ensuring the page loads (after submission button is clicked)
        // with the results showing
        sessionStorage.setItem("loadedEarlier", "yes");
        
        // Reveal results
        displayResults();
        return 1;
    }
}