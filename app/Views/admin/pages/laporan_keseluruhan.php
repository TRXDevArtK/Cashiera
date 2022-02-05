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
            <div class="cnv-init-1 flex-1">

                <div class="cnv-box-1 flex-grow-1">
                    <div class="cnv-box-head-1 flex-1">
                        <p class="flex-grow-1">Jumlah Penjualan : </p><p class="flex-grow-1" id="total-sales-num">Waiting Server</p>
                    </div>
                    <div class="cnv-box-body-1 flex-1">
                        <p class="center">merupakan grafik</p>
                    </div>
                    <div class="cnv-box-foot-1 flex-1">

                    </div>
                </div>

                <div class="cnv-box-1 flex-grow-1">
                    <div class="cnv-box-head-1 flex-1">
                        <p class="flex-grow-1">Total Penjualan : </p><p class="flex-grow-1" id="total-selling">Waiting Server</p>
                    </div>
                    <div class="cnv-box-body-1 flex-1">
                        <p class="center">merupakan grafik</p>
                    </div>
                    <div class="cnv-box-foot-1 flex-1">

                    </div>
                </div>

                <div class="cnv-box-1 flex-grow-1">
                    <div class="cnv-box-head-1 flex-1">
                        <p class="flex-grow-1">Modal yang dikeluarkan : </p><p class="flex-grow-1" id="total-capital">Waiting Server</p>
                    </div>
                    <div class="cnv-box-body-1 flex-1">
                        <p class="center">merupakan grafik</p>
                    </div>
                    <div class="cnv-box-foot-1 flex-1">

                    </div>
                </div>

                <div class="cnv-box-1 flex-grow-1">
                    <div class="cnv-box-head-1 flex-1">
                        <p class="flex-grow-1">Jumlah Keuntungan : </p><p class="flex-grow-1" id="total-profit">Waiting Server</p>
                    </div>
                    <div class="cnv-box-body-1 flex-1">
                        <p class="center">merupakan grafik</p>
                    </div>
                    <div class="cnv-box-foot-1 flex-1">

                    </div>
                </div>

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
        <script src="<?= base_url("resources/pages/filters.js"); ?>"></script>
        
        <!--inline per-page script-->
        <script>
            //load on document ready
            $(document).ready(function(){

                function read_overall_result(){
                    var firstDate = $('#tgl-awal').val();
                    var lastDate = $('#tgl-akhir').val();
                    var filterStore = $("[name='store-filter']").val();
                    var filterCategory = $("[name='category-filter']").val();
                    var filterType = $("[name='type-filter']").val();

                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:'read_overall_result',
                            first_date:firstDate,
                            last_date:lastDate,
                            filter_store:filterStore,
                            filter_category:filterCategory,
                            filter_type:filterType
                        },
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }

                            if(data['data'] !== 'none'){
                                $('#total-sales-num').text(data['data']['total-sales-num']);
                                $('#total-selling').text(data['data']['total-selling']);
                                $('#total-capital').text(data['data']['total-capital']);
                                $('#total-profit').text(data['data']['total-profit']);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                }

                //call
                read_overall_result();

                $("#apply-filter").on("click", function(){
                    read_overall_result();
                });

            });
        </script>
    </body>
</html>