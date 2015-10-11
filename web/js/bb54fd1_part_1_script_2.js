$(document).ready(function() {

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $("#advanceSearch").hide();
    $("#showAdvanceSearch").click(function() {
        $("#advanceSearch").toggle();
    });

});
