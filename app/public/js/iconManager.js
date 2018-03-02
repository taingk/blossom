let aClass = [];

function getClasses() {
    let aClass = [];

    $('body *:not(script)').each(function () {
        sClass = $(this).attr('class') ? $(this).attr('class').split(' ') : [];

        sClass.forEach(sValue => {
            if (aClass.indexOf(sValue) < 0 && sValue.substring(0, 5) === "icon_") {
                aClass.push(sValue)
            }
        });
    });

    return aClass;
}

getClasses().forEach(sClass => {
    $(`.${sClass}`).css({
        "background-image": `url(/public/icon/${sClass.substr(5)}.svg)`,
        "height": "40px",
        "width": "40px"
    });
});