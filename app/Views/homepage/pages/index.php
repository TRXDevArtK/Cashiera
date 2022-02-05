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

        <!--translate php function to js-->
        <script>
            var currentUrl = "<?= current_url() ?>";
            var login = "<?= $login ?>";
            var urlToDashboard = "<?= base_url("/dashboard/laporan-keseluruhan") ?>";
        </script>

        <!--js-->
        <script src="<?= base_url("resources/jquery/jquery.js") ?>"></script>
        <title><?= $title ?></title>
    </head>
    <body>
        
        <header>
            <a class="img-menu-lower-1" href="<?= base_url(); ?>"><img src= "<?= base_url("img/home-logo.png") ?>" ></a>
            <div class="flex-1 cnv-header-1">
                <a class="flex-grow-1 img-menu-1" href="<?= base_url(); ?>"><img src="img/home-logo.png"></a>
                <a class="flex-grow-1 btn-nav-1" href="<?= base_url()."/daftar"; ?>">Daftar</a>
                <a class="flex-grow-1 btn-nav-1" href="<?= base_url()."/agenda"; ?>">Agenda</a>
                <a class="flex-grow-1 btn-nav-1" href="<?= base_url()."/kontak"; ?>">Kontak</a>
                <a class="flex-grow-1 btn-nav-1" href="<?= base_url()."/artikel"; ?>">Artikel</a>
                <a class="flex-grow-1 btn-nav-1" href="<?= base_url()."/fasilitas"; ?>">Fasilitas</a>
                <div class="cnv-btn-1" id="cnv-btn-1">
                    <button class="flex-grow-1 btn-nav-2 -modal-btn-1">LOGIN</button>
                    <button class="flex-grow-1 btn-nav-2 -modal-btn-2">COBA GRATIS</button>
                <div>
            </div>
        </header>
        
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
                            <p class="bold">Login / Masuk</p>
                            <p class="cnv-danger-1" id="notf-login"></p>
                        </div>
                        <hr><br>
                    </div>
                        <form id="form-login">
                            <div class="modal-body-1">
                                <label class='cnv-text-1' for='username'>Username : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Username" id="username" name="username"><br>
                                
                                <label class='cnv-text-1' for='password'>Password : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Password" id="password" name="password"><br>
                                
                                <label class='cnv-text-1' for='key'>key : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Key" id="key" name="key"><br>
                                
                                <label class=""><input type="checkbox" name="save" value="1">Ingat Saya 24 Jam</label>
                            </div>
                            <div class="modal-footer-1">
                                <input type="submit" id="submit-login" class="btn-1 btn-submit-1" value="Submit">
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
                            <p class="bold">Register / Daftar</p>
                            <p class="cnv-danger-1" id="notf-register"></p>
                        </div>
                        <hr><br>
                    </div>
                        <form id="form-register">
                            <div class="modal-body-1">
                                <label class='cnv-text-1' for='username'>Username : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Username" id="username" name="username"><br>
                                
                                <label class='cnv-text-1' for='password'>Password : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Password" id="password" name="password"><br>
                                
                                <label class='cnv-text-1' for='conf-password'>Konfirmasi Password : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Konfirmasi Password" id="conf-password" name="conf-password"><br>
                                
                                <label class='cnv-text-1' for='phone'>Nomor Telp/HP : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Nomor Handphone" id="phone" name="phone"><br>
                                
                                <label class='cnv-text-1' for='email'>Email : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Email Anda" id="email" name="email"><br>
                                
                                <label class='cnv-text-1' for='key'>Key : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Key" id="key" name="key"><br>
                                
                                <label class='cnv-text-1' for='conf-key'>Konfirmasi Key : </label>
                                <input type="text" class="inp-gen-txt-1" placeholder="Input Konfirmasi Key" id="conf-key" name="conf-key"><br>
                                
                                <label class=""><input type="checkbox" name="robot-check" value="false">SAYA BUKAN ROBOT</label>
                            </div>
                            <div class="modal-footer-1">
                                <input type="submit" id="submit-register" class="btn-1 btn-submit-1" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="cnv-body-1">
                <p>Anda ingin bisnis anda menjadi mudah ?</p>
                <p>Anda ingin aplikasi POS tapi bisa offline dan hemat kuota ?</p>
                <p>Anda ingin laporan bisnis anda bisa didapatkan dengan mudah ?</p>
                <p>Anda ingin mesin kasir yang portable bisa digunakan dimana saja ?</p>
                <p>Gunakan aplikasi kami yaitu</p>
                <p class="bold">Cashiera</p>
                <hr>
            </div>
            <br>
            <div class="cnv-body-2">
                <p class="bold center">Anda ingin bisnis anda menjadi mudah ?</p>
                <div class="flex-1 cnv-init-1">
                    <div class="cnv-box-1 flex-grow-1">
                        <p>Bisa mode hybird, offline dan online</p>  
                    </div>
                    <div class="cnv-box-1 flex-grow-1">
                        <p>Manajemen bisnis menjadi lebih mudah</p>  
                    </div>
                    <div class="cnv-box-1 flex-grow-1">
                        <p>Aplikasi yang user friendly dan cepat</p>  
                    </div>
                </div>
                <hr>
            </div>
        </section>
        
        <footer>
            <div class="flex-1 cnv-footer-1">
                <div class="flex-grow-1 cnv-box-1">
                    <p>section 1</p>
                </div>
                <div class="flex-grow-1 cnv-box-1">
                    <p>section 2</p>
                </div>
                <div class="flex-grow-1 cnv-box-1">
                    <p>section 3</p>
                </div>
                <div class="flex-grow-1 cnv-box-1">
                    <p>section 4</p>
                </div>
            </div>
        </footer>
        
        <div class="ajaxload"><!-- ini loading ajax --></div>
        
        <script src="<?= base_url("resources/anim/loading/loading.js") ?>"></script>
        <script src="resources/modal/modal.js"></script>
        
        <script>
            $(document).ready(function(){
                $("#submit-login").click(function(event){
                    event.preventDefault();
                    var formLogin = $("#form-login").serializeArray();
                    formLogin.push({name: 'terms', value: 'login'});
                    $.ajax({
                        url:"<?= current_url(); ?>",
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:$.param(formLogin),
                        success:function(data){
                            if(data['status'] === true){
                                $('#notf-login').removeClass('cnv-danger-1').addClass('cnv-safe-1').text(data['notf']);
                            }
                            else{
                                $('#notf-login').text(data['notf']);
                            }

                            if(data['redir'] != 'none'){
                                var url = data['redir'];    
                                $(location).attr('href',url);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#notf-login').text("Maaf terjadi kesalahan server . . .");
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });

                $("#submit-register").click(function(event){
                    event.preventDefault();
                    var formLogin = $("#form-register").serializeArray();
                    formLogin.push({name: 'terms', value: 'register'});
                    $.ajax({
                        url:"<?= current_url(); ?>",
                        method:"POST",
                        dataType: 'json',
                        cache: false,
                        data:$.param(formLogin),
                        success:function(data){
                            if(data['status'] === true){
                                $('#notf-register').removeClass('cnv-danger-1').addClass('cnv-safe-1').text(data['notf']);
                            }
                            else{
                                $('#notf-register').text(data['notf']);
                            }

                            if(data['redir'] !== 'none'){
                                var url = data['redir'];  
                                $(location).attr('href',url);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#notf-register').text("Maaf terjadi kesalahan server . . .");
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });
                });

                //matikan semua notifikasi jika modal di tutup
                $("#modal-close-1, #modal-close-2").click(function(event){
                   $('#notf-login, #notf-register').text("");
                });
                
                function check_login(){
                    //jika sudah login
                    if(login == true){
                        var html = "";
                        html += "<a href='"+urlToDashboard+"' class='flex-grow-1 btn-nav-2'>DASHBOARD</a>";
                        $("#cnv-btn-1").html(html);
                    }
                }
                
                check_login();
            });
        </script>
    </body>
</html>

