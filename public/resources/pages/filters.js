//public variable
var headerListStore = 0;
var headerListType = 0;
var headerListCategory = 0;

function storeFilter(){
    //jika diklik tombol
    $('#nav-store-button').on('click', function(event){
        event.stopPropagation();
        $('#nav-store-content').toggle('fast', function(){
            if($("#nav-store-content").is(":visible")){
                //none
            }
            else{
                //none
            }
        });
    });

    //cegah penutupan konten jika diklik
    $("#nav-store-content").on("click", function (event) {
        event.stopPropagation();
    });

    //tutup konten jika klik diluar konten
    $(document).on('click', function(){
        $('#nav-store-content').hide();
        $('#nav-store-input').val("");
        $("#nav-store-input").trigger("change");
    });

    //pencarian front end dropdown (disabled)
//        $('#nav-store-input').on("input change keyup", function(){
//            var input = $('#nav-store-input');
//            var value = input.val().toLowerCase();
//            var dropDownList = $('#nav-store-content a');
//            dropDownList.filter(function(){
//                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//            });
//        });

    //pencarian back end dropdown
    $('#searching-store').on("click", function(){
        var search = $('#nav-store-input').val();
        read_id_store(search);
    });

    //jika link di klik
    $('#nav-store-content').on('click', 'a', function(){
        var getValue = $(this).data();
        $('#nav-store-button').text(getValue['value']).val(getValue['id']);
        $('#nav-store-content').hide();
    });
}

//pemilihan kategori dan pencariannya
function categoryFilter(){
    //jika diklik tombol
    $('#nav-category-button').on('click', function(event){
        event.stopPropagation();
        $('#nav-category-content').toggle('fast', function(){
            if($("#nav-category-content").is(":visible")){
                //none
            }
            else{
                //none
            }
        });
    });

    //cegah penutupan konten jika diklik
    $("#nav-category-content").on("click", function (event) {
        event.stopPropagation();
    });

    //tutup konten jika klik diluar konten
    $(document).on('click', function(){
        $('#nav-category-content').hide();
        $('#nav-category-input').val("");
        $("#nav-category-input").trigger("change");
    });

    //pencarian front end dropdown
//        $('#nav-category-input').on("input change keyup", function(){
//            var input = $('#nav-category-input');
//            var value = input.val().toLowerCase();
//            var dropDownList = $('#nav-category-content a');
//            dropDownList.filter(function(){
//                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//            });
//        });

    //pencarian back end dropdown
    $('#searching-category').on("click", function(){
        var search = $('#nav-category-input').val();
        read_category_product(search);
    });


    //jika link di klik
    $('#nav-category-content').on('click', 'a', function(){
        var getValue = $(this).data();
        $('#nav-category-button').text(getValue['value']).val(getValue['id']);
        $('#nav-category-content').hide();
    });
}

//pemilihan kategori dan pencariannya
function productFilter(){
    //jika diklik tombol
    $('#nav-type-button').on('click', function(event){
        event.stopPropagation();
        $('#nav-type-content').toggle('fast', function(){
            if($("#nav-type-content").is(":visible")){
                //none
            }
            else{
                //none
            }
        });
    });

    //cegah penutupan konten jika diklik
    $("#nav-type-content").on("click", function (event) {
        event.stopPropagation();
    });

    //tutup konten jika klik diluar konten
    $(document).on('click', function(){
        $('#nav-type-content').hide();
        $('#nav-type-input').val("");
        $("#nav-type-input").trigger("change");
    });

    //pencarian front end dropdown
//        $('#nav-type-input').on("input change keyup", function(){
//            var input = $('#nav-type-input');
//            var value = input.val().toLowerCase();
//            var dropDownList = $('#nav-type-content a');
//            dropDownList.filter(function(){
//                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//            });
//        });

    //pencarian back end dropdown
    $('#searching-type').on("click", function(){
        var search = $('#nav-type-input').val();
        read_type_product(search);
    });


    //jika link di klik
    $('#nav-type-content').on('click', 'a', function(){
        var getValue = $(this).data();
        $('#nav-type-button').text(getValue['value']).val(getValue['id']);
        $('#nav-type-content').hide();
    });
}

storeFilter();
categoryFilter();
productFilter();

const tglAwal = document.getElementById('tgl-awal');
const datePicker = new TheDatepicker.Datepicker(tglAwal);
datePicker.options.setInputFormat("Y-n-j");
datePicker.options.onSelect(function (event, day, previousDay) {
    console.log("asd");
});
datePicker.render();

const tglAkhir = document.getElementById('tgl-akhir');
const datePicker2 = new TheDatepicker.Datepicker(tglAkhir);
datePicker2.options.setInputFormat("Y-n-j");
datePicker2.render();

function date_now(){
    var date = new Date();
    var dd = date.getDate(); //yields day
    var MM = date.getMonth(); //yields month
    var yyyy = date.getFullYear(); //yields year
    var currentDate= yyyy + "-" +( MM+1) + "-" + dd;

    return currentDate;
}

function default_date_filter(){
    var dateNow = date_now();
    $('#tgl-awal').val(dateNow);
    $('#tgl-akhir').val(dateNow);
    $('#tgl-awal').trigger('change');
    $('#tgl-akhir').trigger('change');
}

function read_id_store(search){
    $.ajax({
        url:currentUrl,
        method:"POST",
        dataType: 'json',
        data:{
            terms:'read_id_store',
            search:search
        },
        success:function(data){
            if(data['redir'] !== 'none'){
                var url = data['redir'];    
                $(location).attr('href',url);
            }

            if(data['data'] !== 'none' && data['data'] !== null){
                var data_length = data['data'].length;

                if(data_length > 20){
                    data_length = 20;
                }

                var html = '';
                var count = 0;

                headerListStore = data['data'];

                for(count; count < data_length; count++){
                    //set default value
                    if(count === 0){
                        $('#nav-store-button').text("SEMUA TOKO").val("null");
                        html += '<a class="btn-dropdown-cont-a-2" data-id="null" data-value="SEMUA TOKO" href="#all">SEMUA TOKO</a>';
                    }

                    html += '<a class="btn-dropdown-cont-a-2" data-id="'+data['data'][count]['id']+'" data-value="'+data['data'][count]['name']+'" href="#'+data['data'][count]['name']+'">'+data['data'][count]['name']+'</a>';

                    if(count === 20){
                        html += '<p class="center">hasil terlalu banyak, silahkan lakukan pencarian</p>';
                    }
                }

                $('#read_id_store').html(html);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}

function read_category_product(search){
    $.ajax({
        url:currentUrl,
        method:"POST",
        dataType: 'json',
        data:{
            terms:'read_category_product',
            search:search
        },
        success:function(data){
            if(data['redir'] !== 'none'){
                var url = data['redir'];    
                $(location).attr('href',url);
            }

            if(data['data'] !== 'none' && data['data'] !== null){
                var data_length = data['data'].length;
                var html = '';
                var count = 0;

                headerListCategory = data['data'];

                if(data_length > 20){
                    data_length = 20;
                }

                for(count; count < data_length; count++){
                    if(count === 0){
                        $('#nav-category-button').text("SEMUA KATEGORI").val("null");
                        html += '<a class="btn-dropdown-cont-a-2" data-id="null" data-value="SEMUA KATEGORI" href="#all">SEMUA KATEGORI</a>';
                    }

                    html += '<a class="btn-dropdown-cont-a-2" data-id="'+data['data'][count]['id']+'" data-value="'+data['data'][count]['name']+'" href="#'+data['data'][count]['name']+'">'+data['data'][count]['name']+'</a>';

                    if(count === 20){
                        html += '<p class="center">hasil terlalu banyak, silahkan lakukan pencarian</p>';
                    }
                }

                $('#read_category_product').html(html);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}

function read_type_product(search){
    $.ajax({
        url:currentUrl,
        method:"POST",
        dataType: 'json',
        data:{
            terms:'read_type_product',
            search:search
        },
        success:function(data){
            if(data['redir'] !== 'none'){
                var url = data['redir'];    
                $(location).attr('href',url);
            }

            if(data['data'] !== 'none' && data['data'] !== null){
                var data_length = data['data'].length;
                var html = '';
                var count = 0;

                headerListType = data['data'];

                if(data_length > 20){
                    data_length = 20;
                }

                for(count; count < data_length; count++){
                    if(count === 0){
                        $('#nav-type-button').text("SEMUA TIPE").val("null");
                        html += '<a class="btn-dropdown-cont-a-2" data-id="null" data-value="SEMUA TIPE" href="#all">SEMUA TIPE</a>';
                    }

                    html += '<a class="btn-dropdown-cont-a-2" data-id="'+data['data'][count]['id']+'" data-value="'+data['data'][count]['name']+'" href="#'+data['data'][count]['name']+'">'+data['data'][count]['name']+'</a>';

                    if(count === 20){
                        html += '<p class="center">hasil terlalu banyak, silahkan lakukan pencarian</p>';
                    }
                }

                $('#read_type_product').html(html);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}

read_id_store();
read_category_product();
read_type_product();
default_date_filter();

$('#toggle-date').change(function(){
    if(this.checked){
        $('#tgl-awal, #tgl-akhir').val("");
        $("#tgl-awal, #tgl-akhir").prop( "disabled", true );
    } else {
        default_date_filter();
        $("#tgl-awal, #tgl-akhir").prop( "disabled", false );
    }
});

if($('#toggle-date').is(':checked')){
    $('#tgl-awal, #tgl-akhir').val("");
    $("#tgl-awal, #tgl-akhir").prop( "disabled", true );
}

