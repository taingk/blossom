class sideMenu {
    constructor() {
        this.eLeftMenu = document.getElementsByClassName("backLeftMenu")[0];
        this.onWidth();
        window.addEventListener('resize', () => this.onWidth());
        document.getElementById('toggleMenu').addEventListener('click', () => this.onClick());
    }

    setVisible() {
        this.eLeftMenu.classList.add('visible');
        this.eLeftMenu.classList.remove('invisible');
    }

    setInvisible() {
        this.eLeftMenu.classList.remove('visible');
        this.eLeftMenu.classList.add('invisible');
    }

    onWidth() {
        if ( window.innerWidth <= 975 ) {
            this.setInvisible();
        } else {
            this.setVisible();
        }    
    }

    onClick() {
        if ( this.eLeftMenu.classList.contains('visible') ) {
            this.setInvisible();
        } else {
            this.setVisible();
        }    
    }

}

new sideMenu();