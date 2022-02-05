$(document).on("click", ".-modal-btn-1, #modal-btn-1", function() {
    $("#modal-1").show();
});

$(document).on("click", "#modal-close-1", function() {
    $("#modal-1").hide();
    $("#modal-content-1 form").trigger('reset');
    $("#modal-content-1 img").remove();
});

$(document).mouseup(function(e){
    if (!$("#modal-content-1").is(e.target) && $("#modal-content-1").has(e.target).length === 0) 
    {
        $("#modal-1").hide();
        $("#modal-content-1 form").trigger('reset');
        $("#modal-content-1 img").remove();
    }
});

/////////////////////////////////////////

//THIS IS MODAL TYPE 2//////////////////

$(document).on("click", ".-modal-btn-2, #modal-btn-2", function() {
    $("#modal-2").show();
});

$(document).on("click", "#modal-close-2", function() {
    $("#modal-2").hide();
    $("#modal-content-2 form").trigger('reset');
    $("#modal-content-2 img").remove();
});

$(document).mouseup(function(e){
    if (!$("#modal-content-2").is(e.target) && $("#modal-content-2").has(e.target).length === 0) 
    {
        $("#modal-2").hide();
        $("#modal-content-2 form").trigger('reset');
        $("#modal-content-2 img").remove();
    }
});

//MODAL 3

$(document).on("click", ".-modal-btn-3, #modal-btn-3", function() {
    $("#modal-3").show();
});

$(document).on("click", "#modal-close-3", function() {
    $("#modal-3").hide();
    $("#modal-content-3 form").trigger('reset');
    $("#modal-content-3 img").remove();
});

$(document).mouseup(function(e){
    if (!$("#modal-content-3").is(e.target) && $("#modal-content-3").has(e.target).length === 0) 
    {
        $("#modal-3").hide();
        $("#modal-content-3 form").trigger('reset');
        $("#modal-content-3 img").remove();
    }
});