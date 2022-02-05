<?php
 
namespace App\Models\Admin;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class CreateModel extends Model
{
    public function create_role($post){
        //Ambil helper yang diperlukan
        helper(['dynamicdb', 'datetime']);
        
        //Ambil session yang diperlukan
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //Ambil post data yang diperlukan
        $id = NULL;
        $name = $post['add-input-name'];
        $owner = "0";
        $delete_self = "0";
        $delete_other = "0";
        
        //Database Tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //Insert role
        $sql_header = "INSERT INTO";
        $sql_table = "`role`";
        $sql_insert = [
            ['`id`', $id],
            ['`name`', $name],
            ['`owner`', $owner],
            ['`delete_self`', $delete_self],
            ['`delete_other`', $delete_other]
        ];
        $sql_execute = [$id, $name, $owner, $delete_self, $delete_other];
        $sql_conn = $db_tenant;
        $results_input_role = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        //Cek jika operasi sukses / tidak sukses
        if($results_input_role){
            $final = array("status" => true, "notf" => "Data Jabatan sudah dimasukkan", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function create_type_product($post, $files){
        //Ambil helper yang diperlukan
        helper(['dynamicdb', 'datetime']);
        
        //Ambil session yang diperlukan
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //Ambil post data
        $id = NULL;
        $name = $post['add-input-name'];
        
        //Ambil files data untuk gambar
        $sql_location = "./img/product/";
        $sql_file = $files['add-input-image-url'];
        $sql_old_url = $post['add-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //Database Tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //Insert type product
        $sql_header = "INSERT INTO";
        $sql_table = "`type_product`";
        $sql_insert = [
            ['`id`', $id],
            ['`name`', $name],
            ['`image_url`', $image_url],
        ];
        $sql_execute = [$id, $name, $image_url];
        $sql_conn = $db_tenant;
        $results_input_type_product = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        //Cek jika operasi sukses/tidak sukses
        if($results_input_type_product){
            $final = array("status" => true, "notf" => "Data Toko sudah dimasukkan", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function create_category_product($post){
        //Ambil helper yang diperlukan
        helper(['dynamicdb', 'datetime']);
        
        //Ambil session yang diperlukan
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //Ambil post yang diperlukan
        $id = NULL;
        $name = $post['add-input-name'];
        
        //Database Tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //Insert category_product
        $sql_header = "INSERT INTO";
        $sql_table = "`category_product`";
        $sql_insert = [
            ['`id`', $id],
            ['`name`', $name]
        ];
        $sql_execute = [$id, $name];
        $sql_conn = $db_tenant;
        $results_input_category_product = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        //Cek jika proses berhasil/tidak
        if($results_input_category_product){
            $final = array("status" => true, "notf" => "Data Toko sudah dimasukkan", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function create_users($post, $files){
        //Ambil helper yang diperlukan
        helper(['dynamicdb', 'datetime']);
        
        //Ambil session yang diperlukan
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //Ambil post data yang diperlukan
        $id = NULL;
        $username = $post['add-input-username'];
        $password = password_hash($post['add-input-password'], PASSWORD_ARGON2ID);
        $email = $post['add-input-email'];
        $phone = $post['add-input-phone'];
        $role = $post['add-input-role'];
        $id_store = $post['add-input-id-store'];
        $full_name = $post['add-input-full-name'];
        $call_name = $post['add-input-call-name'];
        $status = $post['add-input-status'];
        $salary = $post['add-input-salary'];
        
        //add-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['add-input-image-url'];
        $sql_old_url = $post['add-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //create product in product table
        $sql_header = "INSERT INTO";
        $sql_table = "`users`";
        $sql_insert = [
            ['`id`', $id],
            ['`username`', $username],
            ['`password`', $password],
            ['`email`', $email],
            ['`phone`', $phone],
            ['`role`', $role],
            ['`id_store`', $id_store],
            ['`full_name`', $full_name],
            ['`call_name`', $call_name],
            ['`status`', $status],
            ['`salary`', $salary],
            ['`image_url`', $image_url]
        ];
        $sql_execute = [$id, $username, $password, $email, $phone, $role, $id_store, $full_name, $call_name, $status, $salary, $image_url];
        $sql_conn = $db_tenant;
        $results_input_users = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        if($results_input_users){
            $final = array("status" => true, "notf" => "Data Toko sudah dimasukkan", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function create_store($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //post data
        $id = NULL;
        $name = $post['add-input-name'];
        $location = $post['add-input-location'];
        $config = 0;
        $color = "#fffff";
        $logo = NULL;
        $print_logo = NULL;
        $print_msg = NULL;
        $mode = 0;
        $timezone = $post['add-input-timezone'];
        $latest_data = timeset('now', $post['add-input-timezone']);
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['add-input-image-url'];
        $sql_old_url = $post['add-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //database tenant
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //create product in product table
        $sql_header = "INSERT INTO";
        $sql_table = "`id_store`";
        $sql_insert = [
            ['`id`', $id],
            ['`name`', $name],
            ['`location`', $location],
            ['`config`', $config],
            ['`color`', $color],
            ['`logo`', $logo],
            ['`print_logo`', $print_logo],
            ['`print_msg`', $print_msg],
            ['`mode`', $mode],
            ['`timezone`', $timezone],
            ['`latest_data`', $latest_data],
            ['`image_url`', $image_url]
        ];
        $sql_execute = [$id, $name, $location, $config, $color, $logo, $print_logo, $print_msg, $mode, $timezone, $latest_data, $image_url];
        $sql_conn = $db_tenant;
        $results_input_product = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        if($results_input_product){
            $final = array("status" => true, "notf" => "Data Toko sudah dimasukkan", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function create_product($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = NULL;
        $code = strval($post['add-input-code']);
        $name = $post['add-input-name'];
        $category = $post['add-input-category'];
        $brand = $post['add-input-brand'];
        $desc = $post['add-input-description'];
        $type = $post['add-input-type'];
        $stock = $post['add-input-stock'];
        $capital = $post['add-input-capital'];
        $profit_min = $post['add-input-profit-min'];
        $profit_max = $post['add-input-profit-max'];
        $discount = $post['add-input-discount'];
        $weight = $post['add-input-weight'];
        $bundling = $post['add-input-bundling'];
        $stats = $post['add-input-stats'];
        $inputter = $username;
        $receipt = $post['add-input-receipt'];
        $latest_data = timeset('now', $post['add-input-timezone']);
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['add-input-image-url'];
        $sql_old_url = $post['add-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //id store
        $id_store = $post['add-input-id-store'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //create product in product table
        $header = "INSERT INTO";
        $table = "`product`";
        $insert =[
            ['`id`', $id],
            ['`code`', $code],
            ['`name`', $name],
            ['`category`', $category],
            ['`brand`', $brand],
            ['`desc`', $desc],
            ['`id_store`', $id_store],
            ['`type`', $type],
            ['`stock`', $stock],
            ['`capital`', $capital],
            ['`profit_min`', $profit_min],
            ['`profit_max`', $profit_max],
            ['`discount`', $discount],
            ['`weight`', $weight],
            ['`bundling`', $bundling],
            ['`stats`', $stats],
            ['`inputter`', $inputter],
            ['`receipt`', $receipt],
            ['`latest_data`', $latest_data],
            ['`image_url`', $image_url]
        ];
        $execute = [$id, $code, $name, $category, $brand, $desc, $id_store, $type, $stock, $capital, 
            $profit_min, $profit_max, $discount, $weight, $bundling, $stats, $inputter, $receipt, $latest_data, $image_url];
        $conn = $db_tenant;
        $results_input_product = db_create_builder($header, $table, $insert, $execute, $conn);
        
        if($results_input_product){
            //if success do nothing then
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        $last_id = $conn->insertID();
        
        //also insert product as buying history
        $header = "INSERT INTO";
        $table = "`buying_history`";
        $insert =[
            ['`id`', $id],
            ['`datetime`', $latest_data],
            ['`profit_min`', $profit_min],
            ['`profit_max`', $profit_max],
            ['`capital`', $capital],
            ['`amount`', $stock],
            ['`product_id`', $last_id],
            ['`teller`', $id_user]
        ];
        $execute = [$id, $latest_data, $profit_min, $profit_max, $capital, $stock, $last_id, $inputter];
        $conn = $db_tenant;
        $results_input_buying_history = db_create_builder($header, $table, $insert, $execute, $conn);
        
        if($results_input_buying_history){
            $final = array("status" => true, "notf" => "Data produk sudah di tambahkan", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
}