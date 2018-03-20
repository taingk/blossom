document.getElementById('toggleMenu').addEventListener("click", () => {
    const leftMenu = document.getElementsByClassName("backLeftMenu")[0];
    const backView = document.getElementById('backView');

    if ( !leftMenu.classList.contains('visible') ) {
        leftMenu.classList.add('visible');
        leftMenu.classList.remove('not-visible');
        leftMenu.style.visibility = "visible";
        if ( window.innerWidth > 975 ) {
            leftMenu.style.display = "block";
            backView.classList.add('col-xs-10');
            backView.classList.remove('col-xs-12');
        }
    } else {
        leftMenu.classList.remove('visible');
        leftMenu.classList.add('not-visible');
        leftMenu.style.visibility = "hidden";
        // if ( window.innerWidth > 975 ) {
        //     leftMenu.style.display = "none";
        //     backView.classList.remove('col-xs-10');
        //     backView.classList.add('col-xs-12');
        // } else {
            leftMenu.style.display = "none";
            backView.classList.remove('col-xs-10');
            backView.classList.add('col-xs-12');
        // }
    }
});