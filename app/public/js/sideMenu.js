function makeVisible() {
    $('.backLeftMenu').removeClass("not-visible");
    $('.backLeftMenu').addClass("visible col-xs-2");
    $('#backView').removeClass("col-xs-12");
    $('#backView').addClass("col-xs-10");
    $('.backLeftMenu').removeClass("col-xs-5");
    $('.backLeftMenu').addClass("col-xs-2");
    $('.backLeftMenu').removeClass("fixed");
}

function makeInvisible() {
    $('.backLeftMenu').removeClass("visible");
    $('.backLeftMenu').addClass("not-visible");
    $('.backLeftMenu').removeClass("col-xs-2");
    $('#backView').removeClass("col-xs-10");
    $('#backView').addClass("col-xs-12");
}

function btnLeft() {
    $('.hideBtn').removeClass('right');
    $('.hideBtn').addClass('left');
    // $('.redHeader').addClass('uHeader');
    // $('.redHeader').removeClass('dHeader');
}

function btnRight() {
    $('.hideBtn').removeClass('left');
    $('.hideBtn').addClass('right');
    // $('.redHeader').addClass('dHeader');
    // $('.redHeader').removeClass('uHeader');
}

$(".hideBtn").click(function() {
    if ($(".backLeftMenu").hasClass("not-visible")) {
        makeVisible();
        if ( $(window).width() < 975 ) {
            $('.backLeftMenu').addClass("col-xs-5");
            $('.backLeftMenu').removeClass("col-xs-2");
            $('.backLeftMenu').addClass("fixed");
            $('#backView').removeClass("col-xs-10");
            $('#backView').addClass("col-xs-12");
        }
    } else {
        makeInvisible();
    };
})

$(window).resize( function() {
    if ( $(window).width() > 975 ) {
        makeVisible();
        btnLeft();
    } else {
        makeInvisible();
        btnRight();
    }
});

if ( $(window).width() > 975 ) {
    makeVisible();
    btnLeft()
} else {
    makeInvisible();
    btnRight()
}