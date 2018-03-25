// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var navbar =  document.getElementById('navBar');
    var documentation = document.getElementById('documentation');
    var whoarewe = document.getElementById('whoarewe')
    var logoBlossom = document.getElementById('logoBlossom');
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        navbar.classList.add('navSlideAnimation');
        // documentation.classList.add('blackLink');
        // whoarewe.classList.add('blackLink');
        // logoBlossom.src = "../../public/img/logo_noir.png";
        $("#imageID").attr('src', 'srcImage.jpg');
    } else {
        navbar.classList.remove('navSlideAnimation');
        // documentation.classList.remove('blackLink');
        // whoarewe.classList.remove('blackLink')
        // logoBlossom.src = "../../public/img/logo_blanc.png";
    }
}
