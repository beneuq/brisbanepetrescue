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

// For scroll to top Button

//Get the button:
scrollToTopBtn = document.getElementById("scrollToTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
if(scrollToTopBtn) {
  console.log("Btn loaded");
  window.addEventListener("scroll", scrollFunction);
}

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    console.log("Display as block");
    scrollToTopBtn.style.display = "block";
  } else {
    console.log("Hide btn");
    scrollToTopBtn.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function scrollToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// let scrollToTopBtn = document.getElementById("scrollToTopBtn")
// scrollToTopBtn.addEventListener("scroll", showSTTBtn);

// function showSTTBtn() {
//     console.log("Entered 'showSTTBtn'");
//     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//         scrollToTopBtn.style.display = "block";
//         console.log("Display STT button");
//       } else {
//         scrollToTopBtn.style.display = "none";
//         console.log("Hide STT button");
//       }
// }

// function scrollToTop(){
//     document.body.scrollTop = 0; // For Safari
//     document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
// }

/** Inverts favourite button */
function favHover(element, currentVal) {
    let newVal = currentVal === "full" ? "empty" : "full";
    element.setAttribute('src', "images/icons/heart-" + newVal + ".png");
}

/** Sets favourite button to currentVal */
function favUnhover(element, currentVal) {
    element.setAttribute('src', "images/icons/heart-" + currentVal + ".png");
}