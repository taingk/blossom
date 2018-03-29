class scrollDown {
    constructor() {
        window.addEventListener('scroll', () => this.scrollFunction());
    }

    scrollFunction() {  
        const eHeaderBar =  document.getElementsByClassName('headerBar')[0];
        const eBtn = document.getElementById('download');
        
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            eHeaderBar.classList.add('slide-animation');
            eBtn.classList.add('white-download-btn');
        } else {
            eHeaderBar.classList.remove('slide-animation');
            eBtn.classList.remove('white-download-btn');
        }
    }

}

new scrollDown();