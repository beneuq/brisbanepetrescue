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
            postReq.open("POST", 'form_submissions/complete-task.php', true);
            postReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            postReq.send("task_type="+taskType+"&dog_id="+dogID);
            location.reload();
            break;
        case "council_registration_id":
            let xmlReq = new XMLHttpRequest();
            xmlReq.onload = function () {
                document.getElementById('popup-form-container').innerHTML = this.responseText;
            };
            xmlReq.open("get", "/partials/mypets-task-council.php?task_type="+taskType+"&dog_id="+dogID, true);
            xmlReq.send();
            break;
        case "worm_meds_start":
        case "tick_meds_start":
            let xmlReq2 = new XMLHttpRequest();
            xmlReq2.onload = function () {
                document.getElementById('popup-form-container').innerHTML = this.responseText;
            };
            xmlReq2.open("get", "/partials/mypets-task-medication.php?task_type="+taskType+"&dog_id="+dogID, true);
            xmlReq2.send();
            break;
        default:
    }
}

