// navbar js
var nav_offset_top = $('header').height() + 50;
/*-------------------------------------------------------------------------------
  Navbar
-------------------------------------------------------------------------------*/

//* Navbar Fixed
function navbarFixed() {
    if ($('.header_menu').length) {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= nav_offset_top) {
                $('.header_menu').addClass('navbar_fixed');
            } else {
                $('.header_menu').removeClass('navbar_fixed');
            }
        });
    }
}
navbarFixed();

$(".owl-carousel").owlCarousel({
    loop: true,
    center: true,
    dots: false,
    margin: 5,
    responsiveClass: true,
    nav: false,
    responsive: {
        0: {
            items: 2,
            nav: false
        },
        680: {
            items: 3,
            nav: false,
        },
        1000: {
            items: 5,
            nav: false,
        }
    }
});

$(document).on('click', '.list', function() {
    var tagid = $(this).attr('data-id');
    var filterurl = $('#filter').data('url');
    $.ajax({
        url: filterurl,
        method: 'get',
        dataType: 'json',
        data: {
            id: tagid,
        },
        success: function(data) {
            $.each(data, function(key, value) {
                $("#itembox-dynamic-new").fadeOut('slow', function() {
                    $(this).html(data.html);
                    $(this).fadeIn('slow');
                  });
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});

$(document).on('click', '.list', function() {
    $(this).addClass('active').siblings().removeClass('active');
});
