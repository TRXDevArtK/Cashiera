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
            
            <div class="center">
                <p id="notf-update"></p>
            </div>
        </header>
        <br>
        
        <section>
            <form method="post" id="form-update-user">
                <button class="clps-1">Lihat / Update Profile :</button>
                <div class="clps-content-1">
                    <div class="center" id="update-input-image-url-preview">

                    </div>

                    <br>
                    <div class="center">
                        <label class='cnv-text-1' for='update-input-image-url'>INPUT GAMBAR : </label>
                        <input type='file' class='-user-modal' name='update-input-image-url' id='update-input-image-url'>
                    </div>
                    <br>

                    <label class="cnv-text-1" for="update-input-full-name">Nama Lengkap :</label>
                    <input type='text' class='inp-gen-txt-1 -user-modal' id="update-input-full-name" name='update-input-full-name'>

                    <label class="cnv-text-1" for="update-input-call-name">Nama Panggilan :</label>
                    <input type='text' class='inp-gen-txt-1 -user-modal' id="update-input-call-name" name='update-input-call-name'>
                    
                    <label class="cnv-text-1" for="update-input-email">Email :</label>
                    <input type='text' class='inp-gen-txt-1 -user-modal' id="update-input-email" name='update-input-email'>

                    <label class="cnv-text-1" for="update-input-phone">Nomor HP/Telp :</label>
                    <input type='number' class='inp-gen-txt-1 -user-modal' id="update-input-phone" name='update-input-phone'>
                    
                    <p id="id-store"></p>
                    <p id="role"></p>
                    <p id="status"></p>
                    <p id="salary"></p>
                    
                    <div class="center">
                        <input type="submit" class="btn-submit-1 -update-user" name="update-user" value="Update Profil">
                    </div>
                </div>
                
                <button class="clps-1">Update Username :</button>
                <div class="clps-content-1">
                    <p class="cnv-safe-1" id="old-username"></p><br>
                    <label for="update-input-new-username">Username Baru :</label>
                    <input type='text' class='inp-gen-txt-1' id="update-input-new-username" name='update-input-new-username'>
                    <label for="update-input-conf-username">Konfirmasi Username :</label>
                    <input type='text' class='inp-gen-txt-1' id="update-input-conf-username" name='update-input-conf-username'>
                    <div class="center">
                        <input type="submit" class="btn-submit-1 -update-user" name="update-user" value="Update Username">
                    </div>
                </div>
                
                <button class="clps-1">Update Password :</button>
                <div class="clps-content-1">
                    <label for="update-input-password">Password Baru :</label>
                    <p class="cnv-warning-1" id="old-password">MOHON MAAF PASSWORD TIDAK BISA DI TAMPILKAN</p><br>
                    <input type='text' class='inp-gen-txt-1' id="update-input-new-password" name='update-input-new-password'>
                    <label for="update-input-conf-password">Konfirmasi Password :</label>
                    <input type='text' class='inp-gen-txt-1' id="update-input-conf-password" name='update-input-conf-password'>
                    <div class="center">
                        <input type="submit" class="btn-submit-1 -update-user" name="update-user" value="Update Password">
                    </div>
                </div>
                
                <button class="clps-1">Pengaturan Key :</button>
                <div class="clps-content-1">
                    <p class="cnv-warning-1">Key adalah akses umum ke dalam database / toko anda, jangan sampai lupa atau diberi tahu ke yang bukan berkepentingan</p>
                    <p class="cnv-safe-1" id="old-key"></p><br>
                    <label for="update-input-new-key">Key Baru :</label>
                    <input type='text' class='inp-gen-txt-1' id="update-input-new-key" name='update-input-new-key'>
                    <label for="update-input-conf-key">Konfirmasi Key :</label>
                    <input type='text' class='inp-gen-txt-1' id="update-input-conf-key" name='update-input-conf-key'>
                    <div class="center">
                        <input type="submit" class="btn-submit-1 -update-user" name="update-user" value="Update Key">
                    </div>
                </div>
                
                </form>
                
                <button class="clps-1">Pengaturan Lanjutan :</button>
                <div class="clps-content-1">
                    <p class="cnv-warning-1">Perhatian jika anda menghapus akun, maka seluruh data akan dihapus, termasuk data produk dan karyawan anda</p>
                    <div class="center">
                        <label for="update-input-conf-key">Hapus Akun :</label>
                        <input type="submit" class="btn-submit-1 -update-user" id="delete-user" name="delete-user" value="Delete User">
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
        <script src="<?= base_url("resources/collapsible/collapsible.js") ?>"></script>
        
        <!--inline per-page script-->
        <script>
            //load on document ready
            $(document).ready(function(){
                
                //user login
                var userId = "";
                var imageUrl = "";
                var logoUrl = "";
                var tempPass = "";
                var oldUsername = "";
                var oldPassword = "";
                var oldKey = "";
                var getRole = "";

                //config
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

                function read_user(){
                    var search = $('#search').val();

                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:'read_user_login'
                        },
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
                                var html = "";
                                if(data['data']['image_url'] == "" || data['data']['image_url'] == null || data['data']['image_url'] == "null"){
                                    html += "<img src='"+baseUrl+"/img/no-image.png' alt='gambar' width='135' height='135'>";
                                }
                                else{
                                    html += "<img src='"+baseUrl+data['data']['image_url']+"' alt='gambar' width='135' height='135'>";
                                };
                                //check and set image
                                $('#update-input-image-url-preview').html(html);
                    
                                if(data['data']['id_store'] == 0){
                                    
                                }
                                else{
                                    $("#id-store").text("Bekerja di : "+data['data']['store_name']);
                                }
                                
                                $("#role").text("Jabatan Sebagai : "+data['data']['role_name']);
                                
                                if(data['data']['status'] == 2){
                                    $("#status").text("Status : Non-Aktif");
                                }
                                else if(data['data']['status'] == 1){
                                    $("#status").text("Status : Aktif");
                                }
                                else if(data['data']['status'] == 2){
                                    $("#status").text("Status : Dipecat");
                                }
                                
                                $("#salary").text("Gaji : "+data['data']['salary']);
                                
                                $("#update-input-full-name").val(data['data']['full_name']);
                                $("#update-input-call-name").val(data['data']['call_name']);
                                $("#update-input-email").val(data['data']['email']);
                                $("#update-input-phone").val(data['data']['phone']);
                                $("#old-key").text("KEY ANDA : "+data['data']['key']);
                                $("#old-username").text("USERNAME ANDA : "+data['data']['username']);
                                
                                imageUrl = data['data']['image_url'];
                                oldUsername = data['data']['username'];
                                oldPassword = data['data']['password'];
                                oldKey = data['data']['key'];
                                getRole = data['data']['role'];
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                }
                
                read_user();

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
                
                $(".-update-user").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var getForm = $('#form-update-user')[0];
                    var formData = new FormData(getForm);
                    formData.append("terms", "update_user_login");
                    formData.append("update-input-image-url", imageUrl);
                    formData.append("update-input-old-username", oldUsername);
                    formData.append("update-input-old-password", oldPassword);
                    formData.append("update-input-old-key", oldKey);
                    formData.append("update-input-role", getRole);
                    
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
                                read_user();
                                $("#form-update-user").trigger('reset');
                                $('#notf-update').removeClass('cnv-warning-1').addClass('cnv-safe-1').text(data['notf']);
                            }
                            else{
                                $('#notf-update').removeClass('cnv-safe-1').addClass('cnv-safe-1').text(data['notf']);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });
                
                $("#delete-user").on('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                    
                    $.ajax({
                        url:currentUrl,
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:{
                            terms:"delete_user_login"
                        },
                        success:function(data){
                            //jika data tabel kosong
                            if(data['status'] === true){
                                $("#form-update-user").trigger('reset');
                                $('#notf-update').removeClass('cnv-warning-1').addClass('cnv-safe-1').text(data['notf']);
                            }
                            else{
                                $('#notf-update').removeClass('cnv-safe-1').addClass('cnv-safe-1').text(data['notf']);
                            }
                            
                            if(data['redir'] !== 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
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