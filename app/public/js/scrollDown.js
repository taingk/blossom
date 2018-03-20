// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var element =  document.getElementById('navBar');
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        element.style.backgroundColor = "white";
    } else {
        element.style.backgroundColor = "transparent";
    }
}

// regarde si l'élement existe - à mettre après
var element =  document.getElementById('navBar');
if (typeof(element) != 'undefined' && element != null)
{
  console.log("aaaa")
} else {
    console.log("bbbb");
}