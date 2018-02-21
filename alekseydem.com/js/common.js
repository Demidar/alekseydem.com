$(document).ready(function() {
    $('.scroll-down').on('click', function() {
        $('html, body').animate({scrollTop: $(window).height()+1}, 500);
    });
});