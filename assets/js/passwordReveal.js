/**
 * Reveal Password Function
 *
 * This function enables the user to reveal the contents of the password they have typed.
 * When the element with the class of 'viewPassword' is clicked the password input field changes its type from 'password' to 'text' and therefore revealing its contents.
 * If the element is clicked again the field will revert back to a password input.
 */
$( document).ready(function() {

    $(".viewPassword").click(function () {
        $("#password").attr("type", "text");
        $(this).addClass("hide");
        $(".hidePassword").removeClass("hide");
    });

    $(".hidePassword").click(function () {
        $("#password").attr("type", "password");
        $(this).addClass("hide");
        $(".viewPassword").removeClass("hide");
    });

});