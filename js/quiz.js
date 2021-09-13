// Listen for when the buttons are clicked
questionOneAnswerA = document.getElementById('questionOneAnswerA');
questionOneAnswerB = document.getElementById('questionOneAnswerB');
questionOneAnswerC = document.getElementById('questionOneAnswerC');
questionOneAnswerD = document.getElementById('questionOneAnswerD');
questionOneAnswerE = document.getElementById('questionOneAnswerE');
questionTwoAnswerA = document.getElementById('questionTwoAnswerA');
questionTwoAnswerB = document.getElementById('questionTwoAnswerB');
questionTwoAnswerC = document.getElementById('questionTwoAnswerC');
questionTwoAnswerD = document.getElementById('questionTwoAnswerD');
questionTwoAnswerE = document.getElementById('questionTwoAnswerE');
questionThreeAnswerA = document.getElementById('questionThreeAnswerA');
questionThreeAnswerB = document.getElementById('questionThreeAnswerB');
questionThreeAnswerC = document.getElementById('questionThreeAnswerC');
questionThreeAnswerD = document.getElementById('questionThreeAnswerD');
questionThreeAnswerE = document.getElementById('questionThreeAnswerE');
questionFourAnswerA = document.getElementById('questionFourAnswerA');
questionFourAnswerB = document.getElementById('questionFourAnswerB');
questionFourAnswerC = document.getElementById('questionFourAnswerC');
questionFourAnswerD = document.getElementById('questionFourAnswerD');
questionFourAnswerE = document.getElementById('questionFourAnswerE');
questionFiveAnswerA = document.getElementById('questionFiveAnswerA');
questionFiveAnswerB = document.getElementById('questionFiveAnswerB');
questionFiveAnswerC = document.getElementById('questionFiveAnswerC');
questionFiveAnswerD = document.getElementById('questionFiveAnswerD');
questionFiveAnswerE = document.getElementById('questionFiveAnswerE');
questionSixAnswerA = document.getElementById('questionSixAnswerA');
questionSixAnswerB = document.getElementById('questionSixAnswerB');
questionSixAnswerC = document.getElementById('questionSixAnswerC');
questionSixAnswerD = document.getElementById('questionSixAnswerD');
questionSixAnswerE = document.getElementById('questionSixAnswerE');
questionSevenAnswerA = document.getElementById('questionSevenAnswerA');
questionSevenAnswerB = document.getElementById('questionSevenAnswerB');
questionSevenAnswerC = document.getElementById('questionSevenAnswerC');
questionSevenAnswerD = document.getElementById('questionSevenAnswerD');
questionSevenAnswerE = document.getElementById('questionSevenAnswerE');
questionEightAnswerA = document.getElementById('questionEightAnswerA');
questionEightAnswerB = document.getElementById('questionEightAnswerB');
questionEightAnswerC = document.getElementById('questionEightAnswerC');
questionEightAnswerD = document.getElementById('questionEightAnswerD');
questionEightAnswerE = document.getElementById('questionEightAnswerE');
questionNineAnswerA = document.getElementById('questionNineAnswerA');
questionNineAnswerB = document.getElementById('questionNineAnswerB');
questionNineAnswerC = document.getElementById('questionNineAnswerC');
questionNineAnswerD = document.getElementById('questionNineAnswerD');
questionNineAnswerE = document.getElementById('questionNineAnswerE');
questionTenAnswerA = document.getElementById('questionTenAnswerA');
questionTenAnswerB = document.getElementById('questionTenAnswerB');
questionTenAnswerC = document.getElementById('questionTenAnswerC');
questionTenAnswerD = document.getElementById('questionTenAnswerD');
questionTenAnswerE = document.getElementById('questionTenAnswerE');
submitClick = document.getElementById('submit');

questionOneAnswerA.addEventListener('click', onClick.bind(null, 1, "A"));
questionOneAnswerB.addEventListener('click', onClick.bind(null, 1, "B"));
questionOneAnswerC.addEventListener('click', onClick.bind(null, 1, "C"));
questionOneAnswerD.addEventListener('click', onClick.bind(null, 1, "D"));
questionOneAnswerE.addEventListener('click', onClick.bind(null, 1, "E"));
questionTwoAnswerA.addEventListener('click', onClick.bind(null, 2, "A"));
questionTwoAnswerB.addEventListener('click', onClick.bind(null, 2, "B"));
questionTwoAnswerC.addEventListener('click', onClick.bind(null, 2, "C"));
questionTwoAnswerD.addEventListener('click', onClick.bind(null, 2, "D"));
questionTwoAnswerE.addEventListener('click', onClick.bind(null, 2, "E"));
questionThreeAnswerA.addEventListener('click', onClick.bind(null, 3, "A"));
questionThreeAnswerB.addEventListener('click', onClick.bind(null, 3, "B"));
questionThreeAnswerC.addEventListener('click', onClick.bind(null, 3, "C"));
questionThreeAnswerD.addEventListener('click', onClick.bind(null, 3, "D"));
questionThreeAnswerE.addEventListener('click', onClick.bind(null, 3, "E"));
questionFourAnswerA.addEventListener('click', onClick.bind(null, 4, "A"));
questionFourAnswerB.addEventListener('click', onClick.bind(null, 4, "B"));
questionFourAnswerC.addEventListener('click', onClick.bind(null, 4, "C"));
questionFourAnswerD.addEventListener('click', onClick.bind(null, 4, "D"));
questionFourAnswerE.addEventListener('click', onClick.bind(null, 4, "E"));
questionFiveAnswerA.addEventListener('click', onClick.bind(null, 5, "A"));
questionFiveAnswerB.addEventListener('click', onClick.bind(null, 5, "B"));
questionFiveAnswerC.addEventListener('click', onClick.bind(null, 5, "C"));
questionFiveAnswerD.addEventListener('click', onClick.bind(null, 5, "D"));
questionFiveAnswerE.addEventListener('click', onClick.bind(null, 5, "E"));
questionSixAnswerA.addEventListener('click', onClick.bind(null, 6, "A"));
questionSixAnswerB.addEventListener('click', onClick.bind(null, 6, "B"));
questionSixAnswerC.addEventListener('click', onClick.bind(null, 6, "C"));
questionSixAnswerD.addEventListener('click', onClick.bind(null, 6, "D"));
questionSixAnswerE.addEventListener('click', onClick.bind(null, 6, "E"));
questionSevenAnswerA.addEventListener('click', onClick.bind(null, 7, "A"));
questionSevenAnswerB.addEventListener('click', onClick.bind(null, 7, "B"));
questionSevenAnswerC.addEventListener('click', onClick.bind(null, 7, "C"));
questionSevenAnswerD.addEventListener('click', onClick.bind(null, 7, "D"));
questionSevenAnswerE.addEventListener('click', onClick.bind(null, 7, "E"));
questionEightAnswerA.addEventListener('click', onClick.bind(null, 8, "A"));
questionEightAnswerB.addEventListener('click', onClick.bind(null, 8, "B"));
questionEightAnswerC.addEventListener('click', onClick.bind(null, 8, "C"));
questionEightAnswerD.addEventListener('click', onClick.bind(null, 8, "D"));
questionEightAnswerE.addEventListener('click', onClick.bind(null, 8, "E"));
questionNineAnswerA.addEventListener('click', onClick.bind(null, 9, "A"));
questionNineAnswerB.addEventListener('click', onClick.bind(null, 9, "B"));
questionNineAnswerC.addEventListener('click', onClick.bind(null, 9, "C"));
questionNineAnswerD.addEventListener('click', onClick.bind(null, 9, "D"));
questionNineAnswerE.addEventListener('click', onClick.bind(null, 9, "E"));
questionTenAnswerA.addEventListener('click', onClick.bind(null, 10, "A"));
questionTenAnswerB.addEventListener('click', onClick.bind(null, 10, "B"));
questionTenAnswerC.addEventListener('click', onClick.bind(null, 10, "C"));
questionTenAnswerD.addEventListener('click', onClick.bind(null, 10, "D"));
questionTenAnswerE.addEventListener('click', onClick.bind(null, 10, "E"));
submit.addEventListener('click', submitClicked.bind(null, 1));

// Current answers will be stored in this array
let answersSelected = {
    1: "None",
    2: "None",
    3: "None",
    4: "None",
    5: "None",
    6: "None",
    7: "None",
    8: "None",
    9: "None",
    10: "None"
};

// Dog's and their associated scores
let dogScores = {};

// Bit of context here. This function was originally going to be the function that queried the database 
// but I half repurposed it to be a counter. Can explain more in messenger
/* This function will add the answer to the answer array and the list of 
current dogs */
function onClick(question, answer) {
    // First, let's check if the answer has been changed and set a flag if appropriate
    answerWasChanged = 0;
    let oldAnswer;
    if (answersSelected[question] != "None" && answerSelected[question] != answer) {
        // Flag has been set and set oldAnswer
        answerWasChanged = 1;
        oldAnswer = answersSelected[question];
    }
    
    // update the answerSelected dictionary with the new information
    answersSelected[question] = answer;

    answerWasChanged = 1;
    // Before we add values to the dog and their scores, we need to remove scores if
    // the answer was changed
    // if (answerWasChanged == 1) {
        // Here was me attempting to query the database in javascript

        // -1 to all the dogs that returned from the result
        // Gets all breeds, and also whether the breed has been favourited by the logged-in user
        //console.log(1);
        //
        // let res = mysqli_query(conn, 
        //     "SELECT DISTINCT Breed \
        //     FROM dog_breeds d \
        //     WHERE height_class=2");
        //     console.log(1);
        // let fetch = mysqli_fetch_array(res);
        // console.log(fetch);
        // 
        // for (let i = 0; i < fetch.length; i++) {
            
        //     if (!(fetch in dogScores)) {
        //         dogScores.push({
        //             key: fetch,
        //             value: 1
        //         });
        //     } else {
        //         dogScores[fetch] = dogScores[fetch] + 1;
        //     }

        //     if (fetch == null) {
        //         isLoop = 0;
        //     }

        // }
            
        // mysqli_close($conn);
    //}

    // Now, let's query the database and extract the animals (also adding to the score)

    // Add scores to the dogScores

    // console.log(dogScores);
    // console.log(1);
}

// This function here was an adjustment I made to try and count when the submit button is clicked
// pretty much just changes answer when the submit button is clicked. I have checked the console and this
// does work. Pretty much works by checking if the flag has been changed.
let ifSubmitClicked = 0;
/* Check if the submit button has been clicked */
function submitClicked(change) {
    if (ifSubmitClicked == 0 && change == 0) {
        return 0;
    } else {
        ifSubmitClicked = 1;
        console.log("was clicked");
        return 1;
    }
}
