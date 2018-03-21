class iconManager {
    constructor() {
        this.setIcon();
    }

    setIcon() {
        document.querySelectorAll('[data-icon]').forEach(element => {
            let sIcon = element.dataset.icon;

            element.style.backgroundImage = `url(/public/icon/${sIcon}.svg)`;
            element.style.backgroundRepeat = `no-repeat`;
            element.style.backgroundSize = `cover`;
            element.style.height = '40px';
            element.style.width = '40px';
        });
    }
}

new iconManager();