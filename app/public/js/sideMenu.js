$("img#hideBtn").click(function() {
    if($(".backLeftMenu").hasClass("not-visible")) {
        $('.backLeftMenu').removeClass('not-visible');
        console.log("visible");
    } else {
        $('.backLeftMenu').addClass('not-visible');
        console.log("invisible");
    };
})