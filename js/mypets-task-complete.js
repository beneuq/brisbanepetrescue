/** OnClick Param for task completion buttons - silently sends POST request to complete the given task */
function complete_task(taskType, dogID) {
    console.log("Completing task "+taskType+" for dog "+dogID);
    let popup;
    let timer;

    switch (taskType) {
        case "desexed":
        case "vaccinated":
        case "birthday":
        case "worm_meds_due":
        case "tick_meds_due":
            let postReq = new XMLHttpRequest();
            postReq.open("POST", '../form_submissions/complete-task.php', true);
            postReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            postReq.send("task_type="+taskType+"&dog_id="+dogID);
            location.reload();
            break;
        case "council_registration_id":
            popup = window.open("../partials/mypets-task-council.php?task_type=" + taskType + "&dog_id=" + dogID, "", "width=400,height=300");
            timer = setInterval(function () { // When popup window closes, refresh page
                if (popup.closed) {
                    clearInterval(timer);
                    location.reload();
                }
            }, 1000);
            break;
        case "worm_meds_start":
        case "tick_meds_start":
            popup = window.open("../partials/mypets-task-medication.php?task_type=" + taskType + "&dog_id=" + dogID, "", "width=400,height=300");
            timer = setInterval(function () { // When popup window closes, refresh page
                if (popup.closed) {
                    clearInterval(timer);
                    location.reload();
                }
            }, 1000);
            break;
        default:
    }
}

