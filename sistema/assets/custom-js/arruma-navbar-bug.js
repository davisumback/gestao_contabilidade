
$(document).ready(function arrumaBugNavbar(){

    if($('body').hasClass('open')){
        $("#navbar-bug").removeClass("corrige-bug-navbar");
    } else {
        $("#navbar-bug").addClass("corrige-bug-navbar");
    }

});