$(document).ready(function(){

    //"JavaScript is Enabled" Body Class
    $("body").addClass("js");

    //  Menu hide on scroll
    var prevScrollpos = window.pageXOffset;
        window.onscroll = function () {

            var currentScrollpos = window.pageYOffset;
            if (prevScrollpos > currentScrollpos) {
                document.getElementById("main-menu").style.top = "0";
            } else {
                document.getElementById("main-menu").style.top = "-130px";
            }

            prevScrollpos = currentScrollpos;
        }

});