$(document).ready(function(){
    
    console.log("test script loaded");
            
    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });

    function get_selling_result(){
        var firstDate = $('#tgl-awal').val();
        var lastDate = $('#tgl-akhir').val();
        var filterStore = $("[name='store-filter']").val();
        var filterCategory = $("[name='category-filter']").val();
        var filterType = $("[name='type-filter']").val();
        var search = "";
        var limit = "2";
        var paging = "1";
        
        alert(firstDate);

//        $.ajax({
//            url:currentUrl,
//            method:"POST",
//            dataType: 'json',
//            cache: false,
//            data:{
//                terms:'get_selling_result',
//                first_date:firstDate,
//                last_date:lastDate,
//                filter_store:filterStore,
//                filter_category:filterCategory,
//                filter_type:filterType,
//                search:search,
//                limit:limit,
//                paging:paging
//
//            },
//            success:function(data){
//                if(data['redir'] !== 'none'){
//                    var url = data['redir'];    
//                    $(location).attr('href',url);
//                }
//
//                console.log(data['data']);
//            },
//            error: function(jqXHR, textStatus, errorThrown) {
//                console.log(JSON.stringify(jqXHR));
//                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
//            }
//        });
    }

    //call
    get_selling_result();

    $("#apply-filter").on("click", function(){
        get_selling_result();
    });
    
    console.log("test script done loaded");

});