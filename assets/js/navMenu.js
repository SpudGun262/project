/**
 * Mobile Navigation Menu
 *
 * This function adds and removes classes when the mobile menu button is pressed.
 * It uses an if statement to check what classes are applied to an elements and functions accordingly
 *
 */
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

/**
 * This is a secondary function to the one above.
 * If the mobile nav menu is active and the body is presses, the menu will close
 */
$('#main').click(function () {
    if ($('#mobileMenuButton').hasClass('navActive')){
        $("#main").removeClass("mobileTransition");
        $('#mobileMenuButton').removeClass("navActive").html('<a><i class="fa fa-bars fa-fw"></i>&nbsp;Menu</a>');
        $('#mobileNav').removeClass('activeMobileNav');
    }
});