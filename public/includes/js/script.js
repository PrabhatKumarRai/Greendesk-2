
//Adds Active class to the nav link of current page
$(function(){
    $('.nav-link').each(function(){
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active'); 
            // $(this).parents('li').addClass('active');
        }
    });
});


//Auto Hide Alert Box
$(document).ready (function(){
    $('.alert-dismissible').delay(3000).fadeOut();
 });


//Adding Autocomplete Off in password fields
$(".autocomplete-off").attr("autocomplete", "randomString");
