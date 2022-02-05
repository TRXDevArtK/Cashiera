//menu navigasi pertama
function navLaporanMenu(){
    $('#nav-laporan-button').on('click', function(event){
        event.stopPropagation();
        $('#nav-laporan-content').toggle('fast', function(){
            if($("#nav-laporan-content").is(":visible")){
                //none
            }
            else{
                //none
            }
        });
    });

    //cegah penutupan konten jika diklik
    $("#nav-laporan-content").on("click", function (event) {
        event.stopPropagation();
    });

    //tutup konten jika klik diluar
    $(document).on('click', function(){
        $("#nav-laporan-content").hide();
    });
}

//menu navigasi kedua
function navDatabaseMenu(){
    $('#nav-database-button').on('click', function(event){
        event.stopPropagation();
        $('#nav-database-content').toggle('fast', function(){
            if($("#nav-database-content").is(":visible")){
                //none
            }
            else{
                //none
            }
        });
    });

    //cegah penutupan konten jika diklik
    $("#nav-database-content").on("click", function (event) {
        event.stopPropagation();
    });

    //tutup konten jika klik diluar
    $(document).on('click', function(){
        $("#nav-database-content").hide();
    });
}

//menu navigasi pertama
function dashboardMenu(){
    //jika diklik tombol
    $('#dashboard-button').on('click', function(event){
        event.stopPropagation();
        $('#dashboard-content').toggle('fast', function(){
            if($("#dashboard-content").is(":visible")){
                //none
            }
            else{
                //none
            }
        });
    });

    //cegah penutupan konten jika diklik
    $("#dashboard-content").on("click", function (event) {
        event.stopPropagation();
    });

    //tutup konten jika klik diluar
    $(document).on('click', function(){
        $("#dashboard-content").hide();
    });
}

navLaporanMenu();
navDatabaseMenu();
dashboardMenu();