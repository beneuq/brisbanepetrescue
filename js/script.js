$(document).ready(function(){

    //"JavaScript is Enabled" Body Class
    $("body").addClass("js");

    //  Menu hide on scroll
    let prevScrollpos = window.pageXOffset;
    window.onscroll = function () {

        const currentScrollpos = window.pageYOffset;
        if (prevScrollpos > currentScrollpos) {
                document.getElementById("main-menu").style.top = "0";
            } else {
                document.getElementById("main-menu").style.top = "-130px";
            }

            prevScrollpos = currentScrollpos;
        }

});