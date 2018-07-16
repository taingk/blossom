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

        element.classList.add('bg-is-pink');
        element.children[1].classList.add('is-white');
    }
    
    onSelectedMenu() {
        const aSelectedMenu = document.URL.split('/');
        const sId = aSelectedMenu[aSelectedMenu.indexOf('back') + 1].split('?')[0];

        if ( sId ) {
            this.setColor(sId);
        } else {
            this.setColor('dashboard');
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

openCustomization = () => {
    const subMenu = document.getElementById("submenu");

    if (subMenu.style.display != "inline-block") {
        subMenu.style.display = "inline-block";
        subMenu.style.textAlign = "left";
    } else {
        subMenu.style.display = "none";
    }
}
