class sideMenu {
    constructor() {
        this.eLeftMenu = document.getElementsByClassName('backLeftMenu')[0];

        this.onSelectedMenu();
        this.onWidth();
        window.addEventListener('resize', () => this.onWidth());
        document.getElementById('toggleMenu').addEventListener('click', () => this.onClick());
    }

    setColor(sId) {
        const element = document.getElementById(sId);

        element.classList.add('rose-bg');
        element.children[0].classList.add('blanc');
    }
    
    onSelectedMenu() {
        const aSelectedMenu = document.URL.split('/');
        const sId = aSelectedMenu[aSelectedMenu.indexOf('back') + 1];

        if ( sId !== 'back' && sId ) {
            this.setColor(sId);
        } else {
            this.setColor('back');
        }
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