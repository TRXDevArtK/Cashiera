<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
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

        <!--translate php function to js-->
        <script>
            var currentUrl = "<?= current_url() ?>";
            var baseUrl = "<?= base_url() ?>";
        </script>

        <!--js-->
        <script src="<?= base_url("resources/jquery/jquery.js") ?>"></script>

        <!--extension datepicker-->
        <link rel="stylesheet" href="<?= base_url("resources/extension/datepicker/the-datepicker.css") ?>"/>
        <script src="<?= base_url("resources/extension/datepicker/the-datepicker.min.js") ?>"></script>

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
                <input type="checkbox" name="toggle-date" id="toggle-date" value="ON" checked/>
                <input type="text" id="tgl-awal" placeholder="Tanggal Awal" class="inp-gen-date-1">
                <input type="text" id="tgl-akhir" placeholder="Tanggal Akhir" class="inp-gen-date-1">

                <div class="btnORcnv-dropdown-2">
                    <button id="nav-store-button" class="btn-dropdown-2" name="store-filter" value="null">TOKO</button>
                    <div id="nav-store-content" class="btn-dropdown-cont-2">
                        <p class="center bold">pilih toko</p>
                        <div class="flex-1">
                            <input type="text" placeholder="Search.." id="nav-store-input" class="inp-dropdown-text-1 flex-grow-1">
                            <button class="flex-grow-1 btn-dropdown-2" id="searching-store">Apply Searching</button>
                        </div>
                        <div id="read_id_store"></div>
                    </div>
                </div>

                <div class="btnORcnv-dropdown-2">
                    <button id="nav-category-button" class="btn-dropdown-2" name="category-filter" value="null">KATEGORI</button>
                    <div id="nav-category-content" class="btn-dropdown-cont-2">
                        <p class="center bold">pilih kategory</p>
                        <div class="flex-1">
                            <input type="text" placeholder="Search.." id="nav-category-input" class="inp-dropdown-text-1">
                            <button class="flex-grow-1 btn-dropdown-2" id="searching-category">Apply Searching</button>
                        </div>
                        <div id="read_category_product"></div>
                    </div>
                </div>

                <div class="btnORcnv-dropdown-2">
                    <button id="nav-type-button" class="btn-dropdown-2" name="type-filter" value="null">PRODUCT</button>
                    <div id="nav-type-content" class="btn-dropdown-cont-2">
                        <p class="center bold">pilih tipe product</p>
                        <div class="flex-1">
                            <input type="text" placeholder="Search.." id="nav-type-input" class="inp-dropdown-text-1">
                            <button class="flex-grow-1 btn-dropdown-2" id="searching-type">Apply Searching</button>
                        </div>
                        <div id="read_type_product"></div>
                    </div>
                </div>

                <button id="apply-filter" class="btn-1 btn-submit-1">Apply Filter</button>
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
                            <p class="bold">Detail Produk dan Edit</p>
                            <p class="cnv-safe-1" id="notf-report-update"></p>
                        </div>
                        <hr><br>
                        <div class="flex-1 center">
                            <button class="btn-submit-1" id="btn-lihat-produk">Lihat Produk</button>
                            <button class="btn-submit-1" id="btn-update-produk">Edit Produk</button> 
                        </div>
                    </div>
                        <form method="post" id="form-update-product">
                        <div class="modal-body-1">
                            <div id="update-input-latest-data" class="center">
                                
                            </div>
                            
                            <div class="center -store-modal" id="update-input-image-url-preview">

                            </div>
                            
                            <br>
                            <div class="center">
                                <label class='cnv-text-1' for='update-input-image-url'>INPUT GAMBAR : </label>
                                <input type='file' class='-product-modal' name='update-input-image-url' id='update-input-image-url'>
                            </div>
                            <br>
                            
                            <div class="center">
                                <select id="update-input-id-store" name="update-input-id-store" class="-product-modal">

                                </select>

                                <select id="update-input-category" name="update-input-category"  class="-product-modal">

                                </select>

                                <select id="update-input-type" name="update-input-type"  class="-product-modal">

                                </select>

                                <select id="update-input-stats" name="update-input-stats"  class="-product-modal">

                                </select>

                                <select id="update-input-receipt" name="update-input-receipt" class="-product-modal">

                                </select>
                            </div>
                            <br>

                            <label class="cnv-text-1" for="update-input-name">Nama Produk :</label>
                            <input type='text' class='inp-gen-txt-1 -product-modal' id="update-input-name" name='update-input-name'>
                            
                            <label class="cnv-text-1" for="update-input-description">Deskripsi Produk :</label>
                            <input type='text' class='inp-gen-txt-1 -product-modal' id="update-input-description" name='update-input-description'>
                            
                            <label class="cnv-text-1" for="update-input-brand">Brand Produk :</label>
                            <input type='text' class='inp-gen-txt-1 -product-modal' id="update-input-brand" name='update-input-brand'>
                             
                            <label class="cnv-text-1" for="update-input-code">QR/BAR Kode Produk :</label>
                            <input type='text' class='inp-gen-txt-1 -product-modal' id="update-input-code" name='update-input-code'>
                            
                            <label class="cnv-text-1" for="update-input-capital">Modal Produk :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-capital" name='update-input-capital'>
                            
                            <label class="cnv-text-1" for="update-input-stock">Stock Produk :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-stock" name='update-input-stock'>
                            
                            <label class="cnv-text-1" for="update-input-profit-min">Keuntungan Minimum :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-profit-min" name='update-input-profit-min'>
                            
                            <label class="cnv-text-1" for="update-input-profit-max">Keuntungan Maksimum :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-profit-max" name='update-input-profit-max'>
                            
                            <label class="cnv-text-1" for="update-input-discount">Diskon :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-discount" name='update-input-discount'>
                            
                            <label class="cnv-text-1" for="update-input-weight">Berat :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-weight" name='update-input-weight'>
                            
                            <label class="cnv-text-1" for="update-input-bundling">Kode Bundling Produk :</label>
                            <input type='number' class='inp-gen-txt-1 -product-modal' id="update-input-bundling" name='update-input-bundling'>
                            
                            <label class="cnv-text-1" for="update-input-inputter">Terakhir Menginput :</label>
                            <input type='text' class='inp-gen-txt-1' id="update-input-inputter" disabled>
                            
                            <label class="cnv-text-1" for="update-input-total-price">Total Keseluruhan Harga :</label>
                            <input type='text' class='inp-gen-txt-1' id="update-input-total-price" disabled>
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 -product-modal" id="update-product" name="update-product" value="Update Produk">
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
                            <p class="bold">Tambah Produk</p>
                            <p class="cnv-safe-1" id="notf-report-add"></p>
                        </div>
                        <hr>
                    </div>
                        <form method="post" id="form-add-product">
                        <div class="modal-body-1">
                            <div class="center -store-modal" id="add-input-image-url-preview">

                            </div>
                            
                            <br>
                            <div class="center">
                                <label class='cnv-text-1' for='add-input-image-url'>INPUT GAMBAR : </label>
                                <input type='file' name='add-input-image-url' id='add-input-image-url'>
                            </div>
                            <br>
                            
                            <div class="center">
                                <select id="add-input-id-store" name="add-input-id-store" class="">

                                </select>

                                <select id="add-input-category" name="add-input-category"  class="">

                                </select>

                                <select id="add-input-type" name="add-input-type"  class="">

                                </select>

                                <select id="add-input-stats" name="add-input-stats"  class="">

                                </select>

                                <select id="add-input-receipt" name="add-input-receipt" class="">

                                </select>
                            </div>
                            <br>

                            <label class="cnv-text-1" for="add-input-name">Nama Produk :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-name" name='add-input-name'>
                            
                            <label class="cnv-text-1" for="add-input-description">Deskripsi Produk :</label>
                            <input type='text' class='inp-gen-txt-1 ' id="add-input-description" name='add-input-description'>
                            
                            <label class="cnv-text-1" for="add-input-brand">Brand Produk :</label>
                            <input type='text' class='inp-gen-txt-1 ' id="add-input-brand" name='add-input-brand'>
                             
                            <label class="cnv-text-1" for="add-input-code">QR/BAR Kode Produk :</label>
                            <input type='text' class='inp-gen-txt-1 ' id="add-input-code" name='add-input-code'>
                            
                            <label class="cnv-text-1" for="add-input-capital">Modal Produk :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-capital" name='add-input-capital' value="1">
                            
                            <label class="cnv-text-1" for="add-input-stock">Stock Produk :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-stock" name='add-input-stock' value="1">
                            
                            <label class="cnv-text-1" for="add-input-profit-min">Keuntungan Minimum :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-profit-min" name='add-input-profit-min' value="1">
                            
                            <label class="cnv-text-1" for="add-input-profit-max">Keuntungan Maksimum :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-profit-max" name='add-input-profit-max' value="1">
                            
                            <label class="cnv-text-1" for="add-input-discount">Diskon :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-discount" name='add-input-discount' value="0">
                            
                            <label class="cnv-text-1" for="add-input-weight">Berat :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-weight" name='add-input-weight' value="1">
                            
                            <label class="cnv-text-1" for="add-input-bundling">Kode Bundling Produk :</label>
                            <input type='number' class='inp-gen-txt-1 ' id="add-input-bundling" name='add-input-bundling'>
                            
                            <label class="cnv-text-1" for="add-input-total-price">Total Keseluruhan Harga :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-total-price" disabled>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 " id="add-product" name="add-product" value="Tambah Produk">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="right" id="filters-table">
                
                <button class="btn-submit-1 -modal-btn-2">TAMBAH PRODUK</button>
                <button id="hapus-produk" class="btn-submit-1">HAPUS PRODUK</button>
                
                <!--select limit-->
                <select name="limit" id="limit">
                    <option value="1" selected>Tampilkan 1 List</option>
                    <option value="20" selected>Tampilkan 20 List</option>
                    <option value="50">Tampilkan 50 List</option>
                    <option value="100">Tampilkan 100 List</option>
                </select>
                
                <!--filter sticky-->
                <div class="btnORcnv-dropdown-2">
                    <button id="nav-sticky-button" class="btn-dropdown-2" name="sticky-filter" value="sticky">STICKY FILTER</button>
                    <div id="nav-sticky-content" class="btn-dropdown-cont-2">
                        <p class="center bold">pilih kolom sticky</p>
                        <div id="read_list_sticky">
                            <p class="center">Menunggu Tabel . . .</p>
                        </div>
                    </div>
                </div>

                <!--filter table-->
                <div class="btnORcnv-dropdown-2">
                    <button id="nav-table-button" class="btn-dropdown-2" name="table-filter" value="table">KOLOM FILTER</button>
                    <div id="nav-table-content" class="btn-dropdown-cont-2">
                        <p class="center bold">pilih kolom table</p>
                        <div id="read_list_table">
                            <p class="center">Menunggu Tabel . . .</p>
                        </div>
                    </div> 
               </div>

                <input type="text" name="search" id="search" placeholder="Inputkan pencarian tabel disini" value="">
                <button class="btn-submit-1" id="search-submit">Cari</button>
            </div>
            <table style="width:100%;" class="table-horizon-scroll block" id="product-table">
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
        
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        
        <!-- ajax loading -->
        <div class="ajaxload"></div>
        
        <!--load after dom script-->
        <script src="<?= base_url("resources/anim/loading/loading.js") ?>"></script>
        <script src="<?= base_url("resources/modal/modal.js") ?>"></script>
        <script src="<?= base_url("resources/pages/navigation.js") ?>"></script>
        <script src="<?= base_url("resources/pages/filters.js"); ?>"></script>
        
        <!--inline per-page script-->
        <script>
            //load on document ready
            $(document).ready(function(){
                
                //table data i/o
                var productData = [];
                var currPaging = 1;
                var limitPaging = 20;
                var pagingState = true;
                
                //product
                var productId = "";
                var productTimeZone = "";
                var imageUrl = "";
                
                //add/create product
                var addImageUrl = "";

                //config
                var tableHeaderLimit = 17;

                function read_product(){
                    var firstDate = $('#tgl-awal').val();
                    var lastDate = $('#tgl-akhir').val();
                    var filterStore = $("[name='store-filter']").val();
                    var filterCategory = $("[name='category-filter']").val();
                    var filterType = $("[name='type-filter']").val();
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
                            terms:'read_product',
                            first_date:firstDate,
                            last_date:lastDate,
                            filter_store:filterStore,
                            filter_category:filterCategory,
                            filter_type:filterType,
                            search:search,
                            limit:limit,
                            paging_num:paging_num
                        },
                        success:function(data){
                            if(data['redir'] != 'none'){
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
                                
                                localStorage.setItem("data", JSON.stringify(data['data']));
                                productData = data['data'];
                                
                                read_list_table_header(tableHeaderData, tableHeaderLength);
                                
                                //thead
                                for(count; count < (tableHeaderLength-tableHeaderLimit); count++){
                                    if(count == 0){
                                        html += "<tr>";
                                        html += "<th style='width:"+(tableHeaderLength-tableHeaderLimit)+"%' table-col-fixed'>CHECK</th>";
                                    }
                                    
                                    html += "<th style='width:"+(tableHeaderLength-tableHeaderLimit)+"%' class='-col-"+count+"'>"+tableHeaderData[count]+"</th>";
                                        
                                    if(count == (tableHeaderLength-(tableHeaderLimit+1))){
                                        html += "<th style='width:"+(tableHeaderLength-tableHeaderLimit)+"%' class='-col-"+(count+1)+" table-col-fixed'>Options</th>";
                                        html += "</tr>";
                                    }
                                }
                                $('#thead').html(html);
                                
                                var html = '';
                                var count = 0;
                                
                                //tbody
                                for(count; count < data_length; count++){
                                    if(count === 0){
                                        html += "<tr>";
                                    }
                                    html += "<td><input type='checkbox' class='-chk-id-product' name='-chk-id-product' value="+data['data'][count]['ID Barang']+"></td>";
                                    html += "<td class='-col-0'>"+data['data'][count][tableHeaderData[0]]+"</td>\n\
                                            <td class='-col-1'>"+data['data'][count][tableHeaderData[1]]+"</td>\n\
                                            <td class='-col-2'>"+data['data'][count][tableHeaderData[2]]+"</td>\n\
                                            <td class='-col-3'>"+data['data'][count][tableHeaderData[3]]+"</td>\n\
                                            <td class='-col-4'>"+data['data'][count][tableHeaderData[4]]+"</td>\n\
                                            <td class='-col-5'>"+data['data'][count][tableHeaderData[5]]+"</td>\n\
                                            <td class='-col-6'>"+data['data'][count][tableHeaderData[6]]+"</td>\n\
                                            <td class='-col-7'>"+data['data'][count][tableHeaderData[7]]+"</td>\n\
                                            <td class='-col-8 table-col-fixed'><button class='-modal-btn-1' data-id='"+count+"'>Detail / Edit</button></td>\n\
                                        </tr>";

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
                                    sessionStorage.setItem("paging-max", paging_length);
                                    
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
                    read_product();
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
                    var lastPaging = sessionStorage.getItem("paging-max");
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
                    
                    read_product();
                });
                
                //table order
                function tableFilter(){
                    //jika diklik tombol
                    $('#nav-table-button').on('click', function(event){
                        event.stopPropagation();
                        $('#nav-table-content').toggle('fast', function(){
                            if($("#nav-table-content").is(":visible")){
                                //none
                            }
                            else{
                                //none
                            }
                        });
                    });

                    //cegah penutupan konten jika diklik
                    $("#nav-table-content").on("click", function (event) {
                        event.stopPropagation();
                    });

                    //tutup konten jika klik diluar konten
                    $(document).on('click', function(){
                        $('#nav-table-content').hide();
                        $('#nav-table-input').val("");
                        $("#nav-table-input").trigger("change");
                    });

                    //pencarian back end dropdown
                    $('#searching-table').on("click", function(){
                        var search = $('#nav-table-input').val();
                        read_list_table(search);
                    });

                    //jika link di klik
                    $('#nav-table-content').on('click', 'a', function(){
                        var getValue = $(this).data();
                        
                        //jangan ubah button (disabled)
                        //$('#nav-table-button').text(getValue['value']).val(getValue['id']);
                        $('#nav-table-content').hide();
                        
                        $(this).toggleClass("color-disabled");
                        
                        //proses tabelnya
                        $("."+getValue['id']).toggle();
                    });
                }
                
                //sticky order
                function stickyFilter(){
                    //jika diklik tombol
                    $('#nav-sticky-button').on('click', function(event){
                        event.stopPropagation();
                        $('#nav-sticky-content').toggle('fast', function(){
                            if($("#nav-sticky-content").is(":visible")){
                                //none
                            }
                            else{
                                //none
                            }
                        });
                    });

                    //cegah penutupan konten jika diklik
                    $("#nav-sticky-content").on("click", function (event) {
                        event.stopPropagation();
                    });

                    //tutup konten jika klik diluar konten
                    $(document).on('click', function(){
                        $('#nav-sticky-content').hide();
                        $('#nav-sticky-input').val("");
                        $("#nav-sticky-input").trigger("change");
                    });

                    //pencarian back end dropdown
                    $('#searching-sticky').on("click", function(){
                        var search = $('#nav-sticky-input').val();
                        read_list_sticky(search);
                    });

                    //jika link di klik
                    $('#nav-sticky-content').on('click', 'a', function(){
                        var getValue = $(this).data();
                        
                        //jangan ubah button (disabled)
                        //$('#nav-sticky-button').text(getValue['value']).val(getValue['id']);
                        $('#nav-sticky-content').hide();
                        
                        $(this).toggleClass("color-disabled");
                        
                        //proses tabelnya
                        $("."+getValue['id']).toggleClass("table-col-fixed");
                    });
                }
                
                //both sticky and table toggle
                function read_list_table_header(data, length){
                    if(data['data'] !== 'none' && data['data'] !== null){
                        var html = '';
                        var count = 0;
                        
                        localStorage.setItem("table-header", data['data']);

                        for(count; count < (length-tableHeaderLimit); count++){
                            html += "<a class='btn-dropdown-cont-a-2 center' data-id='-col-"+count+"' data-value='"+data[count]+"' href='#"+data[count]+"'>"+data[count]+"</a>";
                        }

                        $('#read_list_table').html(html);
                        $('#read_list_sticky').html(html);
                    }
                }
                
                tableFilter();
                stickyFilter();
                read_product();
                
                $(document).on("click", ".-modal-btn-1", function(){
                    var getId = $(this).data('id');
                    var getValues = productData[getId];
                    
                    console.log(getValues);
                    
                    //hidden val *START*
                    productId = getValues['ID Barang'];
                    productTimeZone = getValues['Timezone'];
                    imageUrl = getValues['URL Gambar'];
                    //hidden val *END*
                    
                    //data is in filter global variable
                    var headerListTypeLength = headerListType.length;
                    
                    var headerListCategoryLength = headerListCategory.length;
                    
                    var headerListStoreLength = headerListStore.length;
                    
                    for(count=0; count < headerListStoreLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+headerListStore[count]['id']+">"+headerListStore[count]['name']+"</option>";
                        
                        $('#update-input-id-store').html(html);
                    }
                    $("#update-input-id-store").val(getValues['ID Toko']).change();
                    
                    for(count=0; count < headerListCategoryLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+headerListCategory[count]['id']+">"+headerListCategory[count]['name']+"</option>";
                        
                        $('#update-input-category').html(html);
                    }
                    $("#update-input-category").val(getValues['ID Kategori']).change();
                    
                    for(count=0; count < headerListTypeLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+headerListType[count]['id']+">"+headerListType[count]['name']+"</option>";
                        
                        $('#update-input-type').html(html);
                    }
                    $("#update-input-type").val(getValues['ID Tipe']).change();
                    
                    //stats option start
                    html = "";
                    html += "<option value='1'>Baru</option>";
                    html += "<option value='0'>Second</option>";
                        
                    $('#update-input-stats').html(html);
                    $("#update-input-stats").val(getValues['Status']).change();
                    //stats option end
                    
                    console.log(getValues['Status']);
                    
                    //receipt option start
                    html = "";
                    html += "<option value='1'>Gunakan Receipt</option>";
                    html += "<option value='0'>Jangan Gunakan Receipt</option>";
                        
                    $('#update-input-receipt').html(html);
                    $("#update-input-receipt").val(getValues['Struk']).change();
                    //receipt option end
                    
                    //Timezone and modified latest option start
                    $("#update-input-latest-data").text("Data Dimodif Terakhir :"+getValues['Data Terakhir']+", Dengan ZonaWaktu : "+getValues['Timezone']);
                    //Timezone and modified latest option end
                    
                    html = "";
                    if(imageUrl == "" || imageUrl == null){
                        html += "<img src='"+baseUrl+"/img/no-image.png' alt='gambar' width='135' height='135'>";
                    }
                    else{
                        html += "<img src='"+baseUrl+imageUrl+"' alt='gambar' width='135' height='135'>";
                    }
                    
                    //check and set image
                    $('#update-input-image-url-preview').html(html);
                    
                    //set value start
                    $("#update-input-name").val(getValues['Nama']);
                    $("#update-input-description").val(getValues['Deskripsi']);
                    $("#update-input-brand").val(getValues['Brand']);
                    $("#update-input-code").val(getValues['Kode']);
                    $("#update-input-capital").val(getValues['Modal']);
                    $("#update-input-stock").val(getValues['Stock']);
                    $("#update-input-profit-min").val(getValues['Untung Min']);
                    $("#update-input-profit-max").val(getValues['Untung Maks']);
                    $("#update-input-discount").val(getValues['Diskon']);
                    $("#update-input-weight").val(getValues['Berat']);
                    $("#update-input-bundling").val(getValues['ID Bundling']);
                    $("#update-input-inputter").val(getValues['Penginput']);
//                    $("#update-input-total-price").val("Min : "+(getValues['Stock']+getValues['Untung Min'])+" / Maks :"+(getValues['Stock']+getValues['Untung Maks']));
                    //set value end
                    
                    $("#btn-lihat-produk").trigger("click");
                });
                
                $("#btn-lihat-produk").on('click', function(){
                    $('.-product-modal').prop("disabled", true);
                });

                $("#btn-update-produk").on('click', function(){
                    $('.-product-modal').prop("disabled", false);
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
                
                //kalkulasi total harga untuk update product
                $(document).on("click input propertychange", "#update-input-profit-min, #update-input-profit-max, #update-input-discount, #update-input-capital, .-modal-btn-1", function(){
                    var capitalVal = parseFloat($("#update-input-capital").val());
                    if(isNaN(capitalVal) == true){
                        capitalVal = 0;
                    }
                    
                    var profitMinVal = parseFloat($("#update-input-profit-min").val());
                    if(isNaN(profitMinVal) == true){
                        profitMinVal = 0;
                    }
                    
                    var profitMaxVal = parseFloat($("#update-input-profit-max").val());
                    if(isNaN(profitMaxVal) == true){
                        profitMaxVal = 0;
                    }
                    
                    var discountVal = parseFloat($("#update-input-discount").val());
                    if(isNaN(discountVal) == true){
                        discountVal = 0;
                    }
                    
                    var minWithDisc = (capitalVal + profitMinVal) - ((capitalVal + profitMinVal) * discountVal / parseFloat(100.0));
                    var maxWithDisc = (capitalVal + profitMaxVal) - ((capitalVal + profitMaxVal) * discountVal / parseFloat(100.0));
                    
                    $("#update-input-total-price").val("Min : "+minWithDisc+" / Maks :"+maxWithDisc);
                });
                
                $("#update-product").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-update-product')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "update_product");
                    formData.append("update-input-product-id", productId);
                    formData.append("update-input-timezone", productTimeZone);
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
                            if(data['data'] == 'none' || data['data'] == null){
                                //do nothing
                            }
                            else{
                                $("#notf-report-update").text("Update berhasil");
                                
                                read_product();
                                
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
                                
                                $("#modal-1").hide();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });
                
                $(document).on("click", ".-modal-btn-2", function(){
                    
                    //add image
                    var html = "";
                    html += "<button><img src='"+baseUrl+"/img/add-image.png' alt='gambar'></button>";
                    $('#add-input-image-modal').html(html);
                    
                    //data is in filter global variable
                    var headerListTypeLength = headerListType.length;
                    
                    var headerListCategoryLength = headerListCategory.length;
                    
                    var headerListStoreLength = headerListStore.length;
                    
                    for(count=0; count < headerListStoreLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+headerListStore[count]['id']+">"+headerListStore[count]['name']+"</option>";
                        
                        $('#add-input-id-store').html(html);
                    }
                    
                    for(count=0; count < headerListCategoryLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+headerListCategory[count]['id']+">"+headerListCategory[count]['name']+"</option>";
                        
                        $('#add-input-category').html(html);
                    }
                    
                    for(count=0; count < headerListTypeLength; count++){
                        if(count === 0){
                            html = "";
                        }
                        html += "<option value="+headerListType[count]['id']+">"+headerListType[count]['name']+"</option>";
                        
                        $('#add-input-type').html(html);
                    }
                    
                    html = "";
                    html += "<img src='"+baseUrl+"/img/no-image.png' alt='gambar' width='135' height='135'>";
                    //check and set image
                    $('#add-input-image-url-preview').html(html);
                    
                    //stats option start
                    html = "";
                    html += "<option value='1'>Baru</option>";
                    html += "<option value='0'>Second</option>";
                        
                    $('#add-input-stats').html(html);
                    //stats option end
                    
                    //receipt option start
                    html = "";
                    html += "<option value='1'>Gunakan Receipt</option>";
                    html += "<option value='0'>Jangan Gunakan Receipt</option>";
                        
                    $('#add-input-receipt').html(html);
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
                
                //kalkulasi total harga untuk add product
                $("#add-input-profit-min, #add-input-profit-max, #add-input-discount, #add-input-capital").on("input propertychange", function(){
                    var capitalVal = parseFloat($("#add-input-capital").val());
                    if(isNaN(capitalVal) == true){
                        capitalVal = 0;
                    }
                    
                    var profitMinVal = parseFloat($("#add-input-profit-min").val());
                    if(isNaN(profitMinVal) == true){
                        profitMinVal = 0;
                    }
                    
                    var profitMaxVal = parseFloat($("#add-input-profit-max").val());
                    if(isNaN(profitMaxVal) == true){
                        profitMaxVal = 0;
                    }
                    
                    var discountVal = parseFloat($("#add-input-discount").val());
                    if(isNaN(discountVal) == true){
                        discountVal = 0;
                    }
                    
                    var minWithDisc = (capitalVal + profitMinVal) - ((capitalVal + profitMinVal) * discountVal / parseFloat(100.0));
                    var maxWithDisc = (capitalVal + profitMaxVal) - ((capitalVal + profitMaxVal) * discountVal / parseFloat(100.0));
                    
                    $("#add-input-total-price").val("Min : "+minWithDisc+" / Maks :"+maxWithDisc);
                });
                
                //tambah produk
                $("#add-product").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getTimeZone = $("#add-input-id-store").find(':selected').data('timezone');
                    
                    var getForm = $('#form-add-product')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "create_product");
                    formData.append("update-input-timezone", getTimeZone);
                    formData.append("update-input-image-url", addImageUrl);
                    
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
//                                $('#notf-login').removeClass('cnv-danger-1').addClass('cnv-safe-1').text(data['notf']);
                                read_product();
                                $("#modal-2").hide();
                            }
                            else{
//                                $('#notf-login').text(data['notf']);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });
                
                $("#hapus-produk").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getChkValue = $('input:checkbox:checked.-chk-id-product').map(function () {
                        return this.value;
                    }).get();
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:"delete_product",
                            id:getChkValue
                        },
                        success:function(data){
                            if(data['redir'] != 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            if(data['status'] === true){
//                                $('#notf-login').removeClass('cnv-danger-1').addClass('cnv-safe-1').text(data['notf']);
                                read_product();
                            }
                            else{
//                                $('#notf-login').text(data['notf']);
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