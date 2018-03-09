$("img#hideBtn").click(function() {
    if ($(".backLeftMenu").hasClass("not-visible")) {
        $('.backLeftMenu').removeClass('not-visible');
        $('.backLeftMenu').addClass('visible');
        $('#backMenu').addClass("col-xs-2");
        $('#backView').removeClass("col-xs-12");
        $('#backView').addClass("col-xs-10");
    } else {
        $('.backLeftMenu').addClass('not-visible');
        $('.backLeftMenu').removeClass('visible');
        $('#backMenu').removeClass("col-xs-2");
        $('#backView').removeClass("col-xs-10");
        $('#backView').addClass("col-xs-12");
    };
})

$(window).resize( function() {
    if ( $(window).width() > 975 ) {
        $('#backMenu').removeClass("not-visible");
        $('#backMenu').addClass("visible");
        $('#backMenu').addClass("col-xs-2");
        $('#backView').removeClass("col-xs-12");
        $('#backView').addClass("col-xs-10");
    } else {
        $('#backMenu').removeClass("visible");
        $('#backMenu').addClass("not-visible");
        $('#backMenu').removeClass("col-xs-2");
        $('#backView').removeClass("col-xs-10");
        $('#backView').addClass("col-xs-12");
    }
});
