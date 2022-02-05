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
                            <p class="bold">Laporan Pembelian</p>
                            <p class="cnv-danger-1" id="notf-report"></p>
                        </div>
                    </div>
                        <div class="modal-body-1">
                            <input type="text" class="inp-gen-txt-1" name="report-pricing" disabled><br>
                            <input type="text" class="inp-gen-txt-1" name="report-desc" disabled><br>
                        </div>
                        <div class="modal-footer-1">
                            <!-- none -->
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="right" id="filters-table">
                
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
                        <div id="get_list_sticky">
                            <p class="center">Menunggu Tabel . . .</p>
                        </div>
                    </div>
                </div>

                <!--filter table-->
                <div class="btnORcnv-dropdown-2">
                    <button id="nav-table-button" class="btn-dropdown-2" name="table-filter" value="table">KOLOM FILTER</button>
                    <div id="nav-table-content" class="btn-dropdown-cont-2">
                        <p class="center bold">pilih kolom table</p>
                        <div id="get_list_table">
                            <p class="center">Menunggu Tabel . . .</p>
                        </div>
                    </div>
                </div>

                <input type="text" name="search" id="search" placeholder="Inputkan pencarian tabel disini" value="">
                <button class="btn-submit-1" id="search-submit">Cari</button>
            </div>
            <table style="width:100%;" class="table-horizon-scroll block" id="buying-table">
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

                function read_buying_history(paging_num, paging, limit){
                    var firstDate = $('#tgl-awal').val();
                    var lastDate = $('#tgl-akhir').val();
                    var filterStore = $("[name='store-filter']").val();
                    var filterCategory = $("[name='category-filter']").val();
                    var filterType = $("[name='type-filter']").val();
                    var search = $('#search').val();
                    
                    if(limit == null){
                        limit = "20";
                    }
                    
                    if(paging_num == null){
                        paging_num = "1";
                    }
                    
                    if(paging == null){
                        paging = true;
                    }

                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:'read_buying_history',
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
                            
                            //jika data tabel ada maka
                            if(data['data'] !== 'none' && data['data'] !== null){
                                
                                //debug
                                //console.log(data['header']);
                                
                                var data_length = data['data'].length;

                                if(data_length > 20){
                                    data_length = 20;
                                }

                                var html = '';
                                var count = 0;
                                
                                var tableHeaderLength = data['header'].length;
                                var decrease = 0;
                                var tableHeaderData = data['header'];
                                
                                get_list_table_header(tableHeaderData, tableHeaderLength);
                                
                                //thead
                                for(count; count < (tableHeaderLength-decrease); count++){
                                    if(count == 0){
                                        html += "<tr>";
                                    }
                                    
                                    html += "<th style='width:"+(tableHeaderLength-decrease)+"%' class='-col-"+count+"'>"+tableHeaderData[count]+"</th>";
                                        
                                    if(count == (tableHeaderLength-(decrease+1))){
                                        html += "</tr>";
                                    }
                                }
                                $('#thead').html(html);
                                
                                var html = '';
                                var count = 0;
                                
                                //tbody
                                for(count; count < data_length; count++){
                                    if(count === 0){
                                        //null ,if needed
                                    }
                                    
                                    html += "<tr>";
                                    html += "<td class='-col-0'>"+data['data'][count][tableHeaderData[0]]+"</td>\n\
                                            <td class='-col-1'>"+data['data'][count][tableHeaderData[1]]+"</td>\n\
                                            <td class='-col-2'>"+data['data'][count][tableHeaderData[2]]+"</td>\n\
                                            <td class='-col-3'>"+data['data'][count][tableHeaderData[3]]+"</td>\n\
                                            <td class='-col-4'>"+data['data'][count][tableHeaderData[4]]+"</td>\n\
                                            <td class='-col-5'>"+data['data'][count][tableHeaderData[5]]+"</td>\n\
                                            <td class='-col-6'>"+data['data'][count][tableHeaderData[6]]+"</td>\n\
                                            <td class='-col-7'>"+data['data'][count][tableHeaderData[7]]+"</td>\n\
                                            <td class='-col-8'>"+data['data'][count][tableHeaderData[8]]+"</td>\n\
                                            <td class='-col-8'>"+data['data'][count][tableHeaderData[9]]+"</td>\n\
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
                    var val = $(this).val();
                    read_buying_history(null, true, val);
                });
                
                //if paging numbering on click
                $(document).on('click', '.paging, #apply-filter, #search-submit', function(){
                    if($(this).data('id') == "" || $(this).data('id') == null){
                        //do nothing if not detect paging
                        //set currpag to 1 if needed reset to filter
                        var currPaging = 1;
                    }
                    else{
                        var currPaging = $(this).data('id');
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
                    
                    //ambil limit
                    var val = $("#limit").val();
                    
                    //debug
                    //alert(currPaging);
                    
                    read_buying_history(currPaging, true, val);
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
                        get_list_table(search);
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
                        get_list_sticky(search);
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
                function get_list_table_header(data, length){
                    if(data['data'] !== 'none' && data['data'] !== null){
                        var html = '';
                        var count = 0;
                        var decrease = 0;// decrease no need table

                        for(count; count < (length-decrease); count++){
                            html += "<a class='btn-dropdown-cont-a-2 center' data-id='-col-"+count+"' data-value='"+data[count]+"' href='#"+data[count]+"'>"+data[count]+"</a>";
                        }

                        $('#get_list_table').html(html);
                        $('#get_list_sticky').html(html);
                    }
                }
                
                tableFilter();
                stickyFilter();
                read_buying_history();
                
                $(document).on("click", "#modal-btn-1", function(){
                    var descReport = $(this).data("desc");
                    var priceReport = $(this).data("value");
                    
                    $("[name='report-pricing']").val(priceReport);
                    $("[name='report-desc']").val(descReport);
                });
                
                //misi selanjutnya yaitu mengganti session js ke cookie js,
                //-membuat list header dimana nantinya bisa di disable dan enable
                //-membuat drag to scroll table beserta fixed headernya
                //-membuat limit bisa dipilih

            });
        </script>
    </body>
</html>