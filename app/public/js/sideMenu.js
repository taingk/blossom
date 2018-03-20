document.getElementById('toggleMenu').addEventListener("click", () => {
    const leftMenu = document.getElementsByClassName("backLeftMenu")[0];
    const backView = document.getElementById('backView');

    if ( !leftMenu.classList.contains('visible') ) {
        leftMenu.classList.add('visible');
        leftMenu.classList.remove('not-visible');
        leftMenu.style.visibility = "visible";
        leftMenu.style.display = "block";
        if ( window.innerWidth > 975 ) {
            backView.classList.add('col-xs-10');
            backView.classList.remove('col-xs-12');
        }
    } else {
        leftMenu.classList.remove('visible');
        leftMenu.classList.add('not-visible');
        leftMenu.style.visibility = "hidden";
        leftMenu.style.display = "none";
        backView.classList.remove('col-xs-10');
        backView.classList.add('col-xs-12');
    }
});

// if ( window.innerWidth > 975 ) {
//     document.getElementById('backView').classList.remove('col-xs-12');
//     document.getElementById('backView').classList.add('col-xs-10');
// }
