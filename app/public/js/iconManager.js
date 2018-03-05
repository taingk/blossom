class iconManager {
    constructor() {
        this.aClass = [];
        this.getClasses();
        this.setIcon();
    }

    getClasses() {
        const self = this;

        $('body *:not(script)').each(function () {
            let sClass = $(this).attr('class') ? $(this).attr('class').split(' ') : [];

            sClass.forEach(sValue => {
                if (self.aClass.indexOf(sValue) < 0 && sValue.substring(0, 5) === "icon_") {
                    self.aClass.push(sValue);
                }
            });
        });
    }

    setIcon() {
        this.aClass.forEach(sClass => {
            $(`.${sClass}`).css({
                "background-image": `url(/public/icon/${sClass.substr(5)}.svg)`,
                "height": "40px",
                "width": "40px"
            });
        });
    }
}

new iconManager();