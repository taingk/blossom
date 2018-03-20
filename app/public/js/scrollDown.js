// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var element =  document.getElementById('navBar');
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        element.style.transition = "opacity 2s ease-in";
        element.style.backgroundColor = "white";
    } else {
        element.style.transition = "opacity 2s ease-out";
        element.style.backgroundColor = "transparent";
    }
}

var element =  document.getElementById('navBar');
if (typeof(element) != 'undefined' && element != null)
{
  console.log("aaaa")
} else {
    console.log("bbbb");
}