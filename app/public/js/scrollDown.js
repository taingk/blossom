class scrollDown {
    constructor() {
        this.manageOffset();
        window.addEventListener('resize', () => this.manageOffset());
        window.addEventListener('scroll', () => this.scrollFunction());
    }

    scrollFunction() {
        const eHeaderBar =  document.getElementsByClassName('headerBar')[0];
        const eBtn = document.getElementById('download');

        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            eBtn.classList.add('white-download-btn');
        } else {
            eBtn.classList.remove('white-download-btn');
        }
    }

    manageOffset() {
        if ( window.innerWidth <= 768 ) {
            document.getElementById('documentation').parentElement.classList.remove('offset-4');
        } else {
            document.getElementById('documentation').parentElement.classList.add('offset-4');
        }
    }

}

new scrollDown();