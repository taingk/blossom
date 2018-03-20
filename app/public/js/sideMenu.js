class sideMenu {
    constructor() {
        this.leftMenu = document.getElementsByClassName("backLeftMenu")[0];
        this.onWidth();
    }

    onWidth() {
        if ( window.innerWidth <= 975 ) {
            this.leftMenu.classList.remove('visible');
            this.leftMenu.classList.add('not-visible');
        } else {
            this.leftMenu.classList.add('visible');
            this.leftMenu.classList.remove('not-visible');        
        }    
    }

    onClick() {
        if ( !this.leftMenu.classList.contains('visible') ) {
            this.leftMenu.classList.add('visible');
            this.leftMenu.classList.remove('not-visible');
        } else {
            this.leftMenu.classList.remove('visible');
            this.leftMenu.classList.add('not-visible');
        }    
    }

}

const oSideMenu = new sideMenu();

window.addEventListener('resize', () => oSideMenu.onWidth());
document.getElementById('toggleMenu').addEventListener('click', () => oSideMenu.onClick());
