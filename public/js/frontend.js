
// navbar animate while scrolling

$(document).ready(function() {
    var nav = $('#header');
    var scrolled = false;

    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            if (!scrolled) {
                nav.addClass('sticky');
                nav.find('.navbar-brand').css("font-size", "1rem");
                nav.find('.navbar-nav .nav-link').css("font-size", "0.9rem");
                scrolled = true;
            }
        } else {
            if (scrolled) {
                nav.removeClass('sticky');
                nav.find('.navbar-brand').css("font-size", "");
                nav.find('.navbar-nav .nav-link').css("font-size", "");
                scrolled = false;
            }
        }
    });
});
