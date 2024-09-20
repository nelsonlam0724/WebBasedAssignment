$(document).ready(function() {
    $(".openbtn").click(function() {
        $("#mySidenav").addClass("open"); 
    });

    $(".closebtn").click(function() {
        $("#mySidenav").removeClass("open"); 
    });
});