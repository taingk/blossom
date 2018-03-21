class iconManager {
    constructor() {
        this.setIcon();
    }

    setIcon() {
        document.querySelectorAll('[data-icon]').forEach(eElement => {
            let sIcon = eElement.dataset.icon;

            eElement.style.backgroundImage = `url(/public/icon/${sIcon}.svg)`;
            eElement.style.backgroundRepeat = `no-repeat`;
            eElement.style.backgroundSize = `cover`;
            eElement.style.height = '40px';
            eElement.style.width = '40px';
        });
    }
}

new iconManager();