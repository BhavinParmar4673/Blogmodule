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
    const filter = $(this).attr('data-filter');
    if (filter == 'all') {
        $('.itembox').show('1000');
        $('#itembox-dynamic').html('');
    } else {
        $('.itembox').not('.' + filter).hide('1000');
        $('.itembox').filter('.' + filter).show('1000');

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
                    for (var i = 0; i < value['images'].length; i++) {
                        var dynamic_div = '<div class="col-lg-6 col-12">' +
                            '<div class="itembox ' + filter + '">' +
                            '<div class="portfolio-item">' +
                            '<a class="portfolio-link" href="projects/' + value['projects'][i].id + ' ">' +
                            '<div class="thumbnail">' +
                            '<img class="img-fluid" src="' + value['images'][i].image + '" alt="..." />' +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '<div class="portfolio-details mt-4">' +
                            '<h2 class="work__title">' + value['projects'][i].title + '</h2>' +
                            '<p class="text-muted">' + value['projects'][i].description + '</p>' +
                            '</div>'
                        '</div>';
                        $('#itembox-dynamic').append(dynamic_div);
                    }
                });
            },
            error: function(data) {
                console.log(data);
            }
        });

        $('#itembox-dynamic').html('');

    }
});



$(document).on('click', '.list', function() {
    $(this).addClass('active').siblings().removeClass('active');
});