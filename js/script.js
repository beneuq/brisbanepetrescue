$(document).ready(function(){

    //"JavaScript is Enabled" Body Class
    $("body").addClass("js");

    //  Menu hide on scroll
    let prevScrollpos = window.pageXOffset;
    window.onscroll = function () {

        const currentScrollpos = window.pageYOffset;
        if (currentScrollpos >= 100) {
            if (prevScrollpos > currentScrollpos) {
                document.getElementById("main-menu").style.top = "0";
            } else {
                document.getElementById("main-menu").style.top = "-130px";
            }
        } 
       
            prevScrollpos = currentScrollpos;
        }

});

/** Inverts favourite button */
function favHover(element, currentVal) {
    let newVal = currentVal === "full" ? "empty" : "full";
    element.setAttribute('src', "images/icons/heart-" + newVal + ".png");
}

/** Sets favourite button to currentVal */
function favUnhover(element, currentVal) {
    element.setAttribute('src', "images/icons/heart-" + currentVal + ".png");
}