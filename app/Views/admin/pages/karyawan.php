<html>
    <html lang="en">
    <head>
        <!--Metadata-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--general settings-->
        <link rel="stylesheet" href="<?= base_url("resources/general/settings.css") ?>" />

        <!--module-->
        <link rel="stylesheet" href="<?= base_url("resources/button/button.css") ?>" />
        <link rel="stylesheet" href="<?= base_url("resources/flexbox/flexbox.css") ?>" />
        <link rel="stylesheet" href="<?= base_url("resources/image/image.css") ?>" />
        <link rel="stylesheet" href="<?= base_url("resources/input/input.css") ?>" />
        <link rel="stylesheet" href="<?= base_url("resources/checkbox/checkbox.css") ?>" />
        <link rel="stylesheet" href="<?= base_url("resources/modal/modal.css") ?>"/>
        <link rel="stylesheet" href="<?= base_url("resources/canvas/canvas.css") ?>"/>
        <link rel="stylesheet" href="<?= base_url("resources/anim/loading/loading.css") ?>"/>
        <link rel="stylesheet" href="<?= base_url("resources/table/table.css") ?>"/>
        <link rel="stylesheet" href="<?= base_url("resources/collapsible/collapsible.css") ?>"/>

        <!--translate php function to js-->
        <script>
            var currentUrl = "<?= current_url() ?>";
            var baseUrl = "<?= base_url() ?>";
        </script>

        <!--js-->
        <script src="<?= base_url("resources/jquery/jquery.js") ?>"></script>

        <!--extension datatables-->
        <link rel="stylesheet" href="<?= base_url("resources/extension/datatables/datatables.min.css"); ?>"/>
        <script src="<?= base_url("resources/extension/datatables/datatables.min.js"); ?>"></script>
        
        <!--extension dragnscroll jquery-->
        <script src="<?= base_url("resources/extension/dragnscroll/jquery.dragscroll.min.js"); ?>"></script>

        <title><?= $title ?></title>
    </head>
    
    <body class="cnv-body-3">
        
        <aside>
            <div class="cnv-sidebar-1">
                <p class="bold ignore_marpad">Cashiera</p>
                <br>
                <div class="btnORcnv-dropdown-2">
                    <button id="dashboard-button" class="btn-dropdown-2"><?= $_SESSION['username']; ?> : Konfigurasi</button>
                    <div id="dashboard-content" class="btn-dropdown-cont-2">
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/pengaturan-akun") ?>">Pengaturan Akun</a>
                        <a class="btn-dropdown-cont-a-2" href="https://drive.google.com/file/d/1dTdoMcla79q4EyAMtRhW3u-sqSQtPmJs/view?usp=sharing">Download Aplikasi</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/logout") ?>">Logout</a>
                    </div>
                </div>
                <br><br>
                <hr>
                <p> Dashboard settings </p>
                <a class="bold btn-profile-1">Basic</a>
                <hr>
                <div class="btnORcnv-dropdown-2">
                    <button id="nav-laporan-button" class="btn-dropdown-2">Laporan</button>
                    <div id="nav-laporan-content" class="btn-dropdown-cont-2">
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/laporan-keseluruhan") ?>">Laporan Keseluruhan</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/laporan-penjualan") ?>">Riwayat Penjualan</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/laporan-pembelian") ?>">Riwayat Pembelian</a>
                    </div>
                </div>
                <br><br>
                <div class="btnORcnv-dropdown-2">
                    <button id="nav-database-button" class="btn-dropdown-2">Database</button>
                    <div id="nav-database-content" class="btn-dropdown-cont-2">
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/produk") ?>">Produk</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/toko") ?>">Toko</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/karyawan") ?>">Karyawan</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/kategori-produk") ?>">Kategori Produk</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/tipe-produk") ?>">Tipe Produk</a>
                        <a class="btn-dropdown-cont-a-2" href="<?= base_url("/dashboard/jabatan") ?>">Jabatan</a>
                    </div>
                </div>
                <br><br>
            </div>
        </aside>
        
        <header>
            <div>
                <p class="bold"><?= $title ?></p>
                <hr>
            </div>
            <div style="background-color: red">
                <input type="text" name="search" id="search" placeholder="Inputkan pencarian tabel disini" value="">
                <button class="btn-submit-1" id="search-submit">Cari</button>
            </div>
        </header>
        <br>
        
        <section>
            
            <!--trigger modal-->
            <div id="modal-1" class="modal-1">

            <!--isi modal-->
                <div class="modal-content-1" id="modal-content-1">
                <div class="section">
                    <div class="modal-header-1">
                        <div class="right">
                            <span id="modal-close-1" class="btn-modal-close-1">&times;</span>
                        </div>
                        <!--notifikasi-->
                        <div class="center">
                            <p class="bold">Detail Karyawan dan Edit</p>
                            <p class="cnv-safe-1" id="notf-report-update"></p>
                        </div>
                        <hr><br>
                        <div class="flex-1 center">
                            <button class="btn-submit-1" id="btn-lihat-karyawan">Lihat Karyawan</button>
                            <button class="btn-submit-1" id="btn-update-karyawan">Edit Karyawan</button> 
                        </div>
                    </div>
                        <form method="post" id="form-update-employee">
                        <div class="modal-body-1">
                            <div class="center -employee-modal" id="update-input-image-url-preview">

                            </div>
                            
                            <br>
                            <div class="center">
                                <label class='cnv-text-1' for='update-input-image-url'>INPUT GAMBAR : </label>
                                <input type='file' class='-employee-modal' name='update-input-image-url' id='update-input-image-url'>
                            </div>
                            <br>

                            <label class="cnv-text-1" for="update-input-full-name">Nama Lengkap :</label>
                            <input type='text' class='inp-gen-txt-1 -employee-modal' id="update-input-full-name" name='update-input-full-name'>
                            
                            <label class="cnv-text-1" for="update-input-call-name">Nama Panggilan :</label>
                            <input type='text' class='inp-gen-txt-1 -employee-modal' id="update-input-call-name" name='update-input-call-name'>
                            
                            <label class="cnv-text-1" for="update-input-username">Username :</label>
                            <input type='text' class='inp-gen-txt-1 -employee-modal' id="update-input-username" name='update-input-username'>
                            
                            <label class="cnv-text-1" for="update-input-password">Password (ubah jika ingin mengubah password lama) :</label>
                            <input type='text' class='inp-gen-txt-1 -employee-modal' id="update-input-password" name='update-input-password'>
                            
                            <label class="cnv-text-1" for="update-input-email">Email :</label>
                            <input type='text' class='inp-gen-txt-1 -employee-modal' id="update-input-email" name='update-input-email'>
                            
                            <label class="cnv-text-1" for="update-input-phone">Nomor HP/Telp :</label>
                            <input type='number' class='inp-gen-txt-1 -employee-modal' id="update-input-phone" name='update-input-phone'>
                            
                            <label class="cnv-text-1" for="update-input-salary">Gaji :</label>
                            <input type='number' class='inp-gen-txt-1 -employee-modal' id="update-input-salary" name='update-input-salary'>
                            
                            <br>
                            <div class="center">
                                <label class="cnv-text-1 -employee-modal" for="update-input-role">Jabatan :</label>
                                <select name="update-input-role" class="-employee-modal" id="update-input-role">
                                    <!--option by javascript-->
                                </select>
                                
                                <label class="cnv-text-1 -employee-modal" for="update-input-status">Status :</label>
                                <select name="update-input-status" class="-employee-modal" id="update-input-status">
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Dipecat</option>
                                </select>
                                
                                <label class="cnv-text-1 -employee-modal" for="update-input-id-store">Bekerja Di ? :</label>
                                <select name="update-input-id-store" class="-employee-modal" id="update-input-id-store">
                                    <!--option by javascript-->
                                </select>
                            </div>
                            <br>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 -employee-modal" id="update-employee" name="update-employee" value="Update Karyawan">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!--trigger modal-->
            <div id="modal-2" class="modal-1">

            <!--isi modal-->
                <div class="modal-content-1" id="modal-content-2">
                <div class="section">
                    <div class="modal-header-1">
                        <div class="right">
                            <span id="modal-close-2" class="btn-modal-close-1">&times;</span>
                        </div>
                        <!--notifikasi-->
                        <div class="center">
                            <p class="bold">Tambah Karyawan</p>
                            <p class="cnv-safe-1" id="notf-report-add"></p>
                        </div>
                        <hr>
                    </div>
                        <form method="post" id="form-add-employee">
                        <div class="modal-body-1">
                            <div class="center " id="add-input-image-url-preview">

                            </div>
                            
                            <br>
                            <div class="center">
                                <label class='cnv-text-1' for='add-input-image-url'>INPUT GAMBAR : </label>
                                <input type='file'  name='add-input-image-url' id='add-input-image-url'>
                            </div>
                            <br>

                            <label class="cnv-text-1" for="add-input-full-name">Nama Lengkap :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-full-name" name='add-input-full-name'>
                            
                            <label class="cnv-text-1" for="add-input-call-name">Nama Panggilan :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-call-name" name='add-input-call-name'>
                            
                            <label class="cnv-text-1" for="add-input-username">Username :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-username" name='add-input-username'>
                            
                            <label class="cnv-text-1" for="add-input-password">Password :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-password" name='add-input-password'>
                            
                            <label class="cnv-text-1" for="add-input-email">Email :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-email" name='add-input-email'>
                            
                            <label class="cnv-text-1" for="add-input-phone">Nomor HP/Telp :</label>
                            <input type='number' class='inp-gen-txt-1' id="add-input-phone" name='add-input-phone'>
                            
                            <label class="cnv-text-1" for="add-input-salary">Gaji :</label>
                            <input type='number' class='inp-gen-txt-1' id="add-input-salary" name='add-input-salary'>
                            
                            <br>
                            <div class="center">
                                <label class="cnv-text-1" for="add-input-role">Jabatan :</label>
                                <select name="add-input-role" id="add-input-role">
                                    <!--option by javascript-->
                                </select>
                                
                                <label class="cnv-text-1" for="add-input-status">Status :</label>
                                <select name="add-input-status" id="add-input-status">
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Dipecat</option>
                                </select>
                                
                                <label class="cnv-text-1" for="add-input-id-store">Bekerja Di ? :</label>
                                <select name="add-input-id-store" id="add-input-id-store">
                                    <!--option by javascript-->
                                </select>
                            </div>
                            <br>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 " id="add-employee" name="add-employee" value="Tambah Karyawan">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="left" id="filters-table">
                
                <button id="modal-btn-2" class="btn-submit-1">TAMBAH KARYAWAN</button>
                <button id="delete-employee" class="btn-submit-1">HAPUS KARYAWAN</button>
                
                <!--select limit-->
                <select name="limit" id="limit">
                    <option value="1" selected>Tampilkan 1 List</option>
                    <option value="20" selected>Tampilkan 20 List</option>
                    <option value="50">Tampilkan 50 List</option>
                </select>

            </div>
            
            <!--notification-->
            <div class="center" id="data-notf">
                
            </div>
            
            <!--box mode per employee-->
            <div class="cnv-body-1 flex-1" id="list-employee">
                
            </div>
            
            <div id="pagination" class="center flex-1">
                <!--table data-->
            </div>
        </section>
        
        <footer>
            <!--null-->
        </footer>
        
        <!-- ajax loading -->
        <div class="ajaxload"></div>
        
        <!--load after dom script-->
        <script src="<?= base_url("resources/anim/loading/loading.js") ?>"></script>
        <script src="<?= base_url("resources/modal/modal.js") ?>"></script>
        <script src="<?= base_url("resources/pages/navigation.js") ?>"></script>
        <script src="<?= base_url("resources/collapsible/collapsible.js") ?>"></script>
        
        <!--inline per-page script-->
        <script>
            //load on document ready
            $(document).ready(function(){
                
                //table data i/o
                var employeeData = [];
                var currPaging = 1;
                var limitPaging = 20;
                var pagingMax = 0;
                var pagingState = true;
                
                //employee
                var employeeId = "";
                var employeeTimeZone = "";
                var imageUrl = "";
                var logoUrl = "";
                var printLogoUrl = "";
                var tempPass = "";
                
                //add/create employee
                var addImageUrl = "";

                //config
                var tableHeaderLimit = 5;
                var search = "";
                
                //other table
                var listIdStore = [];
                var listRole = [];
                
                function read_id_store(){
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

                            if(data['data'] === 'none' && data['data'] === null){
                                // do nothing
                            }
                            else{
                                listIdStore = data['data'];
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                }
                
                function read_role(){
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        data:{
                            terms:'read_role',
                            search:search
                        },
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }

                            if(data['data'] === 'none' && data['data'] === null){
                                // do nothing
                            }
                            else{
                                listRole = data['data'];
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                }
                
                read_id_store();
                read_role();

                function read_employee(){
                    var search = $('#search').val();
                    
                    paging_num = currPaging;
                    paging = pagingState;
                    limit = limitPaging;

                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:'read_users',
                            search:search,
                            limit:limit,
                            paging_num:paging_num
                        },
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            //jika data tabel kosong
                            if(data['data'] == 'none' || data['data'] == null){
                                var html = '';
                                
                                //refresh thead
                                html += "<p class='cnv-warning-1'>Data kosong silahkan di filter</p>"
                                $('#data-notf').html(html);
                                
                                //refresh tbody
                                html = '';
                                $('#list-employee').html(html);
                                
                                //refresh pagination
                                html = '';
                                $('#pagination').html(html);
                            }
                            else{
                                //debug
                                //console.log(data['header']);
                                
                                var data_length = data['data'].length;

                                if(data_length > 20){
                                    data_length = 20;
                                }

                                var html = '';
                                var count = 0;
                                
                                var tableHeaderLength = data['header'].length;
                                var tableHeaderData = data['header'];
                                employeeData = data['data'];
                                
                                var html = '';
                                var count = 0;
                                
                                //box
                                for(count; count < data_length; count++){
                                    if(count === 0){
                                        
                                    }
                                    
                                    html += "<div class='cnv-box-1 flex-grow-1'>";
                                    html += "   <div>";
                                    html += "       <input type='checkbox' class='check-top-left -chk-id-employee' name='chk-id-employee' value="+data['data'][count]['id']+">";
                                    if(data['data'][count]['image_url'] === "" || data['data'][count]['image_url'] === null){
                                        html += "   <img src='"+baseUrl+"/img/no-image.png' alt='img-employee"+data['data'][count]['id']+"' width='135' height='135'>";
                                    }
                                    else{
                                        html += "   <img src="+baseUrl+data['data'][count]['image_url']+" alt='img-employee"+data['data'][count][tableHeaderData[0]]+"' width='135' height='135'>";
                                    }
                                    html += "   </div>";
                                    html += "   <div>";
                                    html += "       <p>"+data['data'][count]['full_name']+"</p>";
                                    html += "   </div>";
                                    html += "   <div>";
                                    html += "       <button class='-modal-btn-1' data-id="+count+">Detail & Konfigurasi</button>";
                                    html += "   </div>";
                                    html += "</div>";

                                    if(count === 20){
                                        //null ,if needed
                                    }
                                }
                                $('#list-employee').html(html);
                                
                                //inisialisasi pertama kali untuk paginationnya
                                if(paging == true){
                                    
                                    //debug
                                    //alert("paging true");
                                    var paging_length = data['paging']['total-paging'];
                                    var paging_record = data['paging']['total-record'];
                                    var start_from= data['paging']['start-from'];

                                    //set max paging to session
                                    pagingMax = paging_length;
                                    
                                    //debug
                                    //alert("paging length :"+paging_length);
                                    //alert("paging record :"+paging_record);
                                    //alert("start_from :"+start_from);

                                    var html = '';
                                    var count = 1;

                                    //list paging
                                    if(paging_length > 1){
                                        html += "<a href='#paging-"+(count+1)+"' class='btn-nav-1 paging' id='paging-next' data-id='"+(count+1)+"'>Next</a>";
                                        for(count; count <= paging_length; count++){
                                            html += "<a href='#paging-"+count+"' class='btn-nav-1 paging' data-id='"+count+"'>"+count+"</a>";
                                        }
                                        html += "<a href='#paging-"+(paging_length-1)+"' class='btn-nav-1 paging' id='paging-prev' data-id='"+(paging_length-1)+"'>Previous</a>";
                                    }
                                    else{
                                        html = "";
                                    }

                                    $('#pagination').html(html);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                }
                
                //if limit on change
                $("#limit").on("change", function(){
                    limitPaging = $(this).val();
                    read_employee();
                });
                
                //if paging numbering on click
                $(document).on('click', '.paging, #apply-filter, #search-submit', function(){
                    if($(this).data('id') == "" || $(this).data('id') == null){
                        //do nothing if not detect paging
                        //set currpag to 1 if needed reset to filter
                    }
                    else{
                        currPaging = $(this).data('id');
                    }
                    
                    var firstPaging = 1;
                    var lastPaging = pagingMax;
                    var plusPaging = currPaging+1;
                    var minPaging = currPaging-1;
                    
                    if(plusPaging > lastPaging){
                        //debug
                        //alert("pagingnext lebih dari max paging :"+plusPaging+" > "+lastPaging+"");
                        plusPaging = lastPaging;
                    }
                    
                    if(minPaging <= 0){
                        minPaging = firstPaging;
                    }
                    
                    $('#paging-next').data('id', plusPaging);
                    $("#paging-next").attr("href", "#paging-"+plusPaging);

                    $('#paging-prev').data('id', minPaging);
                    $("#paging-prev").attr("href", "#paging-"+minPaging);
                    
                    //debug
                    //alert(currPaging);
                    
                    read_employee();
                });
                
                read_employee();
                
                //detail/edit
                $(document).on("click", ".-modal-btn-1", function(){
                    var getId = $(this).data('id');
                    var getValues = employeeData[getId];
                    var html = "";
                    
                    console.log(getValues);
                    
                    //hidden val *START*
                    employeeId = getValues['id'];
                    imageUrl = getValues['image_url']; // this as url, not image
                    tempPass = getValues['password'];
                    //hidden val *END*
                    
                    //set value start
                    $("#update-input-full-name").val(getValues['full_name']);
                    $("#update-input-call-name").val(getValues['call_name']);
                    $("#update-input-username").val(getValues['username']);
                    $("#update-input-password").val("*hidden*");
                    $("#update-input-email").val(getValues['email']);
                    $("#update-input-phone").val(getValues['phone']);
                    $("#update-input-salary").val(getValues['salary']);
                    
                    if(getValues['image_url'] == null || getValues['image_url'] === ""){
                        html += "<img src='"+baseUrl+"/img/no-image.png' alt='gambar' width='135' height='135'>";
                    }
                    else{
                        html += "<img src='"+baseUrl+getValues['image_url']+"' alt='preview-image' width='250' height='200'>";
                    }
                    
                    $('#update-input-image-url-preview').html(html);
                    
                    var headerStoreLength = listIdStore.length;
                    for(count=0; count < headerStoreLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+listIdStore[count]['id']+">"+listIdStore[count]['name']+"</option>";
                        
                        $('#update-input-id-store').html(html);
                    }
                    $("#update-input-id-store").val(getValues['id_store']).change();
                    
                    var headerRoleLength = listRole.length;
                    for(count=0; count < headerRoleLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+listRole[count]['id']+">"+listRole[count]['name']+"</option>";
                        
                        $('#update-input-role').html(html);
                    }
                    $("#update-input-role").val(getValues['role']).change();
                    
                    $("#update-input-status").val(getValues['status']).change();
                    
                    $("#btn-lihat-karyawan").trigger("click");
                });
                
                //update image-url when click see detail employee
                $("#btn-lihat-karyawan").on('click', function(){
                    $('.-employee-modal').prop("disabled", true);
                });

                //update image-url when click edit detail employee
                $("#btn-update-karyawan").on('click', function(){
                    $('.-employee-modal').prop("disabled", false);
                });

                //update preview on input
                $("#update-input-image-url").on("input", function(){
                    var input = $(this).prop('files')[0];
                    html = "";

                    if(input){
                        var reader = new FileReader();
                        reader.readAsDataURL(input);

                        reader.onload = function (e) {
                            html += "<img src='"+e.target.result+"' alt='preview-image-url' width='250' height='200'>";
                            $('#update-input-image-url-preview').html(html);
                        }
                    }
                });
                
                $("#update-employee").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-update-employee')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "update_users");
                    formData.append("update-input-id", employeeId);
                    formData.append("update-input-image-url", imageUrl);
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data:formData,
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            //jika data tabel kosong
                            if(data['status'] === true){
                                read_employee();
                                
                                $("#modal-1").hide();
                            }
                            else{
                                $("#notf-report-update").text(data['notf']);
                                
                                //remove notification on close
                                $(document).on("click", "#modal-close-1", function() {
                                    $("#notf-report-update").text("");
                                });

                                $(document).mouseup(function(e){
                                    if (!$("#modal-content-1").is(e.target) && $("#modal-content-1").has(e.target).length === 0) 
                                    {
                                        $("#notf-report-update").text("");
                                    }
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });
                
                $(document).on("click", "#modal-btn-2", function(){
                    //add image
                    var html = "";
                    html += "<img src='"+baseUrl+"/img/add-image.png' alt='gambar'>";
                    $('#add-input-image-url-preview').html(html);
                    
                    var headerStoreLength = listIdStore.length;
                    for(count=0; count < headerStoreLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+listIdStore[count]['id']+">"+listIdStore[count]['name']+"</option>";
                        
                        $('#add-input-id-store').html(html);
                    }
                    
                    var headerRoleLength = listRole.length;
                    for(count=0; count < headerRoleLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+listRole[count]['id']+">"+listRole[count]['name']+"</option>";
                        
                        $('#add-input-role').html(html);
                    }
                });
                
                //update preview on input
                $("#add-input-image-url").on("input", function(){
                    var input = $(this).prop('files')[0];
                    html = "";

                    if(input){
                        var reader = new FileReader();
                        reader.readAsDataURL(input);

                        reader.onload = function (e) {
                            html += "<img src='"+e.target.result+"' alt='preview-image-url' width='250' height='200'>";
                            $('#add-input-image-url-preview').html(html);
                        }
                    }
                });
                
                //tambah karyawan
                $("#add-employee").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-add-employee')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "create_users");
                    formData.append("add-input-image-url", addImageUrl);
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data:formData,
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            if(data['status'] === true){
                                read_employee();
                                $("#modal-2").hide();
                            }
                            else{
                                $("#notf-report-add").text(data['notf']);
                                
                                //remove notification on close
                                $(document).on("click", "#modal-close-2", function() {
                                    $("#notf-report-add").text("");
                                });

                                $(document).mouseup(function(e){
                                    if (!$("#modal-content-2").is(e.target) && $("#modal-content-2").has(e.target).length === 0) 
                                    {
                                        $("#notf-report-add").text("");
                                    }
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });
                
                $("#delete-employee").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getChkValue = $('input:checkbox:checked.-chk-id-employee').map(function () {
                        return this.value;
                    }).get();
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:"delete_users",
                            id:getChkValue
                        },
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            if(data['status'] === true){
                                read_employee();
                            }
                            else{
                                //do nothing
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });
            });
        </script>
    </body>
</html>