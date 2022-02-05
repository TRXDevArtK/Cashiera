//load before document
function page_loading(){
    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });  
}

page_loading();