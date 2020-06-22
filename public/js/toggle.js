$(document).ready(function() {
    $('#navbarDropdown').click(function(){
        console.log("clicked");
        $('#navbar-dropdown-items').toggleClass('show');
    });
});