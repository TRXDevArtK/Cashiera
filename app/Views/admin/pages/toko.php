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
                            <p class="bold">Detail Toko dan Edit</p>
                            <p class="cnv-safe-1" id="notf-report-update"></p>
                        </div>
                        <hr><br>
                        <div class="flex-1 center">
                            <button class="btn-submit-1" id="btn-lihat-toko">Lihat Toko</button>
                            <button class="btn-submit-1" id="btn-update-toko">Edit Toko</button> 
                        </div>
                    </div>
                        <form method="post" id="form-update-store">
                        <div class="modal-body-1">
                            <div id="update-input-latest-data" class="center">
                                
                            </div>
                            
                            <div class="center -store-modal" id="update-input-image-url-preview">

                            </div>
                            
                            <br>
                            <div class="center">
                                <label class='cnv-text-1' for='update-input-image-url'>INPUT GAMBAR : </label>
                                <input type='file' class='-store-modal' name='update-input-image-url' id='update-input-image-url'>
                            </div>
                            <br>
                            
                            <div class="center">
                                <label class="cnv-text-1" for="update-input-timezone">Zona Waktu :</label>
                                <select name="update-input-timezone" class="-store-modal" id="update-input-timezone">
                                    <option value="UTC">UTC</option>
                                    <option value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                                    <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                    <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                    <option value="US/Alaska">(GMT-09:00) Alaska</option>
                                    <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                                    <option value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option>
                                    <option value="US/Arizona">(GMT-07:00) Arizona</option>
                                    <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                    <option value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</option>
                                    <option value="America/Managua">(GMT-06:00) Central America</option>
                                    <option value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                                    <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                    <option value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                    <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                    <option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                                    <option value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                                    <option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                                    <option value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                                    <option value="America/Manaus">(GMT-04:00) Manaus</option>
                                    <option value="America/Santiago">(GMT-04:00) Santiago</option>
                                    <option value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                                    <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                    <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires, Georgetown</option>
                                    <option value="America/Godthab">(GMT-03:00) Greenland</option>
                                    <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                    <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                    <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                    <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                    <option value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                    <option value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                    <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                    <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                    <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                    <option value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                    <option value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                                    <option value="Asia/Amman">(GMT+02:00) Amman</option>
                                    <option value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                    <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                    <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                    <option value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                                    <option value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                    <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                    <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                    <option value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                                    <option value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                    <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                    <option value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                                    <option value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                                    <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                    <option value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                                    <option value="Asia/Baku">(GMT+04:00) Baku</option>
                                    <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                    <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                    <option value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                                    <option value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                    <option value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                    <option value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                                    <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                    <option value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                                    <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                    <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                    <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi</option>
                                    <option value="Asia/Jakarta">(GMT+07:00 / UTC+7) Jakarta</option>
                                    <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                    <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                    <option value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                    <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                    <option value="Australia/Perth">(GMT+08:00) Perth</option>
                                    <option value="Asia/Taipei">(GMT+08:00) Taipei</option>
                                    <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                    <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                    <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                    <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                    <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                    <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                    <option value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                    <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                    <option value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                                    <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                    <option value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                    <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                    <option value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                    <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                </select>
                            </div>

                            <label class="cnv-text-1" for="update-input-name">Nama Toko :</label>
                            <input type='text' class='inp-gen-txt-1 -store-modal' id="update-input-name" name='update-input-name'>
                            
                            <label class="cnv-text-1" for="update-input-location">Lokasi Toko :</label>
                            <input type='text' class='inp-gen-txt-1 -store-modal' id="update-input-location" name='update-input-location'>
                            
                            <button class="clps-1">Pilih Warna Aplikasi :</button>
                            <div class="clps-content-1">
                                <label for="update-input-color">Warna Umum / Keseluruhan:</label>
                                <input type="color" class="-store-modal" id="update-input-color" name="update-input-color" value="#ffffff">
                            </div>
                            
                            <button class="clps-1">Logo Aplikasi :</button>
                            <div class="clps-content-1">
                                <div id="update-image-logo-preview" class="center">
                                    
                                </div>
                                <label for="update-input-logo">Logo (64kb) :</label>
                                <input type="file" class="-store-modal" name="update-input-logo" id="update-input-logo">
                            </div>
                            
                            <button class="clps-1">Pengaturan Struk :</button>
                            <div class="clps-content-1">
                                <div id="update-image-receipt-preview" class="center">
                                    
                                </div>
                                <br>
                                <label for="update-input-logo-receipt">Logo (64kb) :</label>
                                <input type="file" class="-store-modal" name="update-input-print-logo" id="update-input-logo-receipt">
                                
                                <br>
                                <label class="cnv-text-1" for="update-input-print-msg">Deskripsi di Struk :</label>
                                <input type='text' class='inp-gen-txt-1 -store-modal' id="update-input-print-msg" name='update-input-print-msg'>
                            </div>
                            
                            <button class="clps-1">Pengaturan Mode Aplikasi :</button>
                            <div class="clps-content-1">
                                <label class="cnv-text-1 -store-modal" for="update-input-mode">Mode Aplikasi :</label>
                                <select name="update-input-mode" class="-store-modal" id="update-input-mode">
                                    <option value="0">Hybird</option>
                                    <option value="1">Dynamic</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 -store-modal" id="update-store" name="update-store" value="Update Toko">
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
                            <p class="bold">Tambah Toko</p>
                            <p class="cnv-safe-1" id="notf-report-add"></p>
                        </div>
                        <hr>
                    </div>
                        <form method="post" id="form-add-store">
                        <div class="modal-body-1">
                            <div class="center" id="add-input-image-url-preview">

                            </div>
                            
                            <br>
                            <div class="center">
                                <label class='cnv-text-1' for='add-input-image-url'>INPUT GAMBAR : </label>
                                <input type='file' name='add-input-image-url' id='add-input-image-url'>
                            </div>
                            <br>
                            
                            <div class="center">
                                <label class="cnv-text-1" for="add-input-timezone">Zona Waktu :</label>
                                <select name="add-input-timezone">
                                    <option value="UTC">UTC</option>
                                    <option value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                                    <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                    <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                    <option value="US/Alaska">(GMT-09:00) Alaska</option>
                                    <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                                    <option value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option>
                                    <option value="US/Arizona">(GMT-07:00) Arizona</option>
                                    <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                    <option value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</option>
                                    <option value="America/Managua">(GMT-06:00) Central America</option>
                                    <option value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                                    <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                    <option value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                    <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                    <option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                                    <option value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                                    <option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                                    <option value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                                    <option value="America/Manaus">(GMT-04:00) Manaus</option>
                                    <option value="America/Santiago">(GMT-04:00) Santiago</option>
                                    <option value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                                    <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                    <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires, Georgetown</option>
                                    <option value="America/Godthab">(GMT-03:00) Greenland</option>
                                    <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                    <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                    <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                    <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                    <option value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                    <option value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                    <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                    <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                    <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                    <option value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                    <option value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                                    <option value="Asia/Amman">(GMT+02:00) Amman</option>
                                    <option value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                    <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                    <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                    <option value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                                    <option value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                    <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                    <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                    <option value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                                    <option value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                    <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                    <option value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                                    <option value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                                    <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                    <option value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                                    <option value="Asia/Baku">(GMT+04:00) Baku</option>
                                    <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                    <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                    <option value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                                    <option value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                    <option value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                    <option value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                                    <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                    <option value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                                    <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                    <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                    <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi</option>
                                    <option value="Asia/Jakarta">(GMT+07:00 / UTC+7) Jakarta</option>
                                    <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                    <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                    <option value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                    <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                    <option value="Australia/Perth">(GMT+08:00) Perth</option>
                                    <option value="Asia/Taipei">(GMT+08:00) Taipei</option>
                                    <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                    <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                    <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                    <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                    <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                    <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                    <option value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                    <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                    <option value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                                    <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                    <option value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                    <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                    <option value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                    <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                </select>
                            </div>

                            <label class="cnv-text-1" for="add-input-name">Nama Toko :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-name" name='add-input-name'>
                            
                            <label class="cnv-text-1" for="add-input-location">Lokasi Toko :</label>
                            <input type='text' class='inp-gen-txt-1' id="add-input-location" name='add-input-location'>
                            
                        </div>
                        <div class="modal-footer-1">
                            <div class="center">
                                <input type="submit" class="btn-submit-1 " id="add-store" name="add-store" value="Tambah Toko">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="left" id="filters-table">
                
                <button id="modal-btn-2" class="btn-submit-1">TAMBAH TOKO</button>
                <button id="delete-store" class="btn-submit-1">HAPUS TOKO</button>
                
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
            
            <!--box mode per store-->
            <div class="cnv-body-1 flex-1" id="list-store">
                
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
                var storeData = [];
                var currPaging = 1;
                var limitPaging = 20;
                var pagingMax = 0;
                var pagingState = true;
                
                //store
                var storeId = "";
                var storeTimeZone = "";
                var imageUrl = "";
                var logoUrl = "";
                var printLogoUrl = "";
                
                //add/create store
                var addImageUrl = "";

                //config
                var tableHeaderLimit = 5;

                function read_store(){
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
                            terms:'read_store',
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
                                $('#list-store').html(html);
                                
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
                                storeData = data['data'];
                                
                                var html = '';
                                var count = 0;
                                
                                //box
                                for(count; count < data_length; count++){
                                    if(count === 0){
                                        
                                    }
                                    
                                    html += "<div class='cnv-box-1 flex-grow-1'>";
                                    html += "   <div>";
                                    html += "       <input type='checkbox' class='check-top-left -chk-id-store' name='chk-id-store' value="+data['data'][count][tableHeaderData[4]]+">";
                                    if(data['data'][count][tableHeaderData[5]] === "" || data['data'][count][tableHeaderData[5]] === null){
                                        html += "   <img src='"+baseUrl+"/img/no-image.png' alt="+data['data'][count][tableHeaderData[0]]+" width='135' height='135'>";
                                    }
                                    else{
                                        html += "   <img src="+baseUrl+data['data'][count][tableHeaderData[5]]+" alt="+data['data'][count][tableHeaderData[0]]+" width='135' height='135'>";
                                    }
                                    html += "   </div>";
                                    html += "   <div>";
                                    html += "       <p>"+data['data'][count][tableHeaderData[0]]+"</p>";
                                    html += "   </div>";
                                    html += "   <div>";
                                    html += "       <button class='-modal-btn-1' data-id="+count+">Detail & Konfigurasi</button>";
                                    html += "   </div>";
                                    html += "</div>";

                                    if(count === 20){
                                        //null ,if needed
                                    }
                                }
                                $('#list-store').html(html);
                                
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
                    read_store();
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
                    
                    read_store();
                });
                
                read_store();
                
                //detail/edit
                $(document).on("click", ".-modal-btn-1", function(){
                    var getId = $(this).data('id');
                    var getValues = storeData[getId];
                    var html = "";
                    
                    //hidden val *START*
                    storeId = getValues['id'];
                    storeTimeZone = getValues['timezone'];
                    imageUrl = getValues['image_url'];
                    logoUrl = getValues['logo'];
                    printLogoUrl = getValues['print_logo'];
                    //hidden val *END*
                    
                    //Timezone and modified latest option start
                    $("#update-input-latest-data").text("Data Dimodif Terakhir :"+getValues['latest_data']+", Dengan ZonaWaktu : "+getValues['timezone']);
                    //Timezone and modified latest option end
                    
                    //set value start
                    $("#update-input-name").val(getValues['name']);
                    $("#update-input-location").val(getValues['location']);
                    $("#update-input-timezone").val(storeTimeZone).change();
                    $("#update-input-color").val(getValues['color']).change();
                    
                    if(getValues['logo'] == null || getValues['logo'] === ""){
                        //do nothing
                    }
                    else{
                        html += "<img src='"+baseUrl+getValues['logo']+"' alt='preview-image' width='250' height='200'>";
                        $('#update-image-logo-preview').html(html);
                    }
                    
                    html = "";
                    
                    if(getValues['print_logo'] == null || getValues['print_logo'] === ""){
                        //do nothing
                    }
                    else{
                        html += "<img src='"+baseUrl+getValues['print_logo']+"' alt='preview-image' width='250' height='200'>";
                        $('#update-image-receipt-preview').html(html);
                    }
                    
                    html = "";
                    if(imageUrl === "" || imageUrl === null){
                        html += "<img src='"+baseUrl+"/img/no-image.png' alt='gambar' width='135' height='135'>";
                    }
                    else{
                        html += "<img src='"+baseUrl+imageUrl+"' alt='gambar' width='135' height='135'>";
                    };

                    //check and set image
                    $('#update-input-image-url-preview').html(html);
                    
                    $("#btn-lihat-toko").trigger("click");
                });
                
                //update image-url when click see detail store
                $("#btn-lihat-toko").on('click', function(){
                    $('.-store-modal').prop("disabled", true);
                });

                //update image-url when click edit detail store
                $("#btn-update-toko").on('click', function(){
                    $('.-store-modal').prop("disabled", false);
                });
                
                //update preview on input
                $("#update-input-logo").on('input', function(){
                    var input = $(this).prop('files')[0];
                    html = "";

                    if(input){
                        var reader = new FileReader();
                        reader.readAsDataURL(input);

                        reader.onload = function (e) {
                            html += "<img src='"+e.target.result+"' alt='preview-image' width='250' height='200'>";
                            $('#update-image-logo-preview').html(html);
                        }
                    }
                });

                //update preview on input
                $("#update-input-logo-receipt").on('input', function(){
                    var input = $(this).prop('files')[0];
                    html = "";

                    if(input){
                        var reader = new FileReader();
                        reader.readAsDataURL(input);

                        reader.onload = function (e) {
                            html += "<img src='"+e.target.result+"' alt='preview-image-receipt' width='250' height='200'>";
                            $('#update-image-receipt-preview').html(html);
                        }
                    }
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
                
                $("#update-store").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-update-store')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "update_store");
                    formData.append("update-input-id", storeId);
                    formData.append("update-input-image-url", imageUrl);
                    formData.append("update-input-logo", logoUrl);
                    formData.append("update-input-print-logo", printLogoUrl);
                    
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
                                read_store();
                                
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
                
                //tambah toko
                $("#add-store").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getTimeZone = $("#add-input-id-store").find(':selected').data('timezone');
                    
                    var getForm = $('#form-add-store')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "create_store");
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
                                read_store();
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
                
                $("#delete-store").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getChkValue = $('input:checkbox:checked.-chk-id-store').map(function () {
                        return this.value;
                    }).get();
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:"delete_store",
                            id:getChkValue
                        },
                        success:function(data){
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                            
                            if(data['status'] === true){
                                read_store();
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