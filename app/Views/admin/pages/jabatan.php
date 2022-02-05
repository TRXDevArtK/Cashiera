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
                            <p class="bold">Detail Role dan Edit</p>
                            <p class="cnv-safe-1" id="notf-report-update"></p>
                        </div>
                        <hr><br>
                        <div class="flex-1 center">
                            <button class="btn-submit-1" id="btn-lihat-role">Lihat Role</button>
                            <button class="btn-submit-1" id="btn-update-role">Edit Role</button> 
                        </div>
                    </div>
                        <form method="post" id="form-update-role">
                        <div class="modal-body-1">

                            <label class="cnv-text-1" for="update-input-name">Nama :</label>
                            <input type='text' class='inp-gen-txt-1 -role-modal' id="update-input-name" name='update-input-name'>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 -role-modal" id="update-role" name="update-role" value="Update Role">
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
                            <p class="bold">Tambah Role</p>
                            <p class="cnv-safe-1" id="notf-report-add"></p>
                        </div>
                        <hr>
                    </div>
                        <form method="post" id="form-add-role">
                        <div class="modal-body-1">
                            
                            <label class="cnv-text-1" for="add-input-name">Nama :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-name" name='add-input-name'>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 " id="add-role" name="add-role" value="Tambah Role">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="left" id="filters-table">
                
                <button id="modal-btn-2" class="btn-submit-1">TAMBAH JABATAN</button>
                <button id="delete-role" class="btn-submit-1">HAPUS JABATAN</button>
                
                <!--select limit-->
                <select name="limit" id="limit">
                    <option value="1" selected>Tampilkan 1 List</option>
                    <option value="20" selected>Tampilkan 20 List</option>
                    <option value="50">Tampilkan 50 List</option>
                </select>

            </div>
            
            <table style="width:100%;" class="table-horizon-scroll block" id="role-table">
                <thead id="thead">
                </thead>
                <tbody id="tbody">
                    <!--table data-->
                </tbody>
            </table>
            
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
                var RoleData = [];
                var currPaging = 1;
                var limitPaging = 20;
                var pagingMax = 0;
                var pagingState = true;
                
                //role
                var RoleId = "";
                var imageUrl = "";
                var logoUrl = "";
                var printLogoUrl = "";
                var tempPass = "";
                
                //add/create role
                var addImageUrl = "";

                //config
                var tableHeaderLimit = 0;
                var search = "";
                
                //other table
                var listIdStore = [];
                var listRole = [];

                function read_role(){
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
                            terms:'read_role',
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
                                $('#thead').html(html);
                                
                                //refresh tbody
                                html = '';
                                $('#tbody').html(html);
                                
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
                                RoleData = data['data'];
                                
                                var html = '';
                                var count = 0;
                                
                                //thead static / manual
                                html += "<tr>";
                                html += "<th style='width:35%' table-col-fixed'>CHECK</th>";
                                html += "<th style='width:35%' class='-col-"+count+"'>Nama</th>";
                                html += "<th style='width:35%' class='-col-"+(count+1)+" table-col-fixed'>Options</th>";
                                html += "</tr>";
                                $('#thead').html(html);
                                
                                var html = '';
                                var count = 0;
                                
                                //tbody
                                for(count; count < data_length; count++){
                                    if(count === 0){
                                        html += "<tr>";
                                    }
                                    html += "<td><input type='checkbox' class='-chk-id-role' name='-chk-id-role' value="+data['data'][count][tableHeaderData[0]]+"></td>";
                                    html += "<td class='-col-0'>"+data['data'][count][tableHeaderData[1]]+"</td>";
                                    html += "<td class='-col-1 table-col-fixed'><button class='-modal-btn-1' data-id='"+count+"'>Detail / Edit</button></td>";
                                    html += "</tr>";

                                    if(count === 20){
                                        //null ,if needed
                                    }
                                }
                                $('#tbody').html(html);
                                
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
                    read_role();
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
                    
                    read_role();
                });
                
                read_role();
                
                //detail/edit
                $(document).on("click", ".-modal-btn-1", function(){
                    //this id actually for get data from public variable
                    //not from id from database
                    var getId = $(this).data('id');
                    var getValues = RoleData[getId];
                    
                    var html = "";
                    
                    //hidden val *START*
                    RoleId = getValues['id'];
                    //hidden val *END*
                    
                    //set value start
                    $("#update-input-name").val(getValues['name']);
                    $("#btn-lihat-role").trigger("click");
                });
                
                //update image-url when click see detail role
                $("#btn-lihat-role").on('click', function(){
                    $('.-role-modal').prop("disabled", true);
                });

                //update image-url when click edit detail role
                $("#btn-update-role").on('click', function(){
                    $('.-role-modal').prop("disabled", false);
                });
                
                $("#update-role").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-update-role')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "update_role");
                    formData.append("update-input-id", RoleId);
                    
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
                                read_role();
                                
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
                
                //tambah role
                $("#add-role").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-add-role')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "create_role");
                    
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
                                read_role();
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
                
                $("#delete-role").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getChkValue = $('input:checkbox:checked.-chk-id-role').map(function () {
                        return this.value;
                    }).get();
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:"delete_role",
                            id:getChkValue
                        },
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            if(data['status'] === true){
                                read_role();
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