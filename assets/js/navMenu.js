

//$( document).ready(function() {
    $('#mobileMenuButton').click(function () {
        if ($(this).hasClass('navActive')) {
            $("#main").removeClass("mobileTransition");
            $('#mobileMenuButton').removeClass("navActive");
            $(this).html('<a><i class="fa fa-bars fa-fw"></i>&nbsp;Menu</a>');
            $('#mobileNav').removeClass('activeMobileNav');
        } else {
            $("#main").addClass("mobileTransition");
            $(this).addClass("navActive");
            $(this).html('<a><i class="fa fa-times fa-fw"></i>&nbsp;Close</a>');
            $('#mobileNav').addClass('activeMobileNav');
        }
    });
//});


