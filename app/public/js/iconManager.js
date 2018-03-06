class iconManager {
    constructor() {
        this.setIcon();
    }

    setIcon() {
        document.querySelectorAll('[data-icon]').forEach(oElement => {
            let sIcon = oElement.dataset.icon;

            oElement.style.backgroundImage = `url(/public/icon/${sIcon}.svg)`;
            oElement.style.height = '40px';
            oElement.style.width = '40px';
        });
    }
}

new iconManager();