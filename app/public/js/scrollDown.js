// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var navbar =  document.getElementById('navBar');
    var downloadBtn = document.getElementById('download');
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        navbar.classList.add('navSlideAnimation');
        downloadBtn.classList.add('importantDownloadBtn');
    } else {
        navbar.classList.remove('navSlideAnimation');
        downloadBtn.classList.remove('importantDownloadBtn');
    }
}
