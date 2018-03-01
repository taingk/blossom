var aClass = [];

$('body *:not(script)').each(function () {
    sClass = $(this).attr('class') ? $(this).attr('class').split(' ') : []

    sClass.forEach( sValue => {
        if (aClass.indexOf(sValue) < 0) {
            aClass.push(sValue)
        }
    });
});

fetch('/module/Iconmanager')
    .then(
        function (response) {
            response.json().then(function (data) {

                aClass.forEach( sClass => {
                    if ( data.includes(`${sClass}.svg`) ) {

                        $(`.${sClass}`).css({
                            "background-image": `url(/public/icon/${sClass}.svg)`,
                            "height": "50px",
                            "width": "50px"
                        });
                    }
                });
            });
        }
    )