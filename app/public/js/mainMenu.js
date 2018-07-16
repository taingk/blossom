window.addEventListener('resize', () => {
    manageOffset();
    document.getElementById('submenu').style.display = "none";
});

manageOffset = () => {
    const search = document.getElementById("search-input");

    if ( window.innerWidth < 769 ) {
        search.classList.remove('offset-3');
    } else {
        search.classList.add('offset-3');
    }
}

openCategories = () => {
    const subMenu = document.getElementById("submenu");

    if ( window.innerWidth < 769 ) {
        if (subMenu.style.display != "block" && subMenu.style.display != "inline-block") {
            subMenu.style.display = "block";
            subMenu.style.position = "";
            subMenu.style.top = "";
            subMenu.style.left = "";
            subMenu.style.padding = "";
        } else {
            subMenu.style.display = "none";        
        }
    } else {
        if (subMenu.style.display != "inline-block" && subMenu.style.display != "block") {
            subMenu.style.display = "inline-block";
            subMenu.style.position = "absolute";
            subMenu.style.top = "100%";     
            subMenu.style.left = "15%";
            subMenu.style.padding = "0px";
        } else {
            subMenu.style.display = "none";
        }
    }
}
