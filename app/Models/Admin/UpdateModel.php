<?php
 
namespace App\Models\Admin;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class UpdateModel extends Model
{
    public function update_role($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //post data
        $id = $post['update-input-id'];
        $name = $post['update-input-name'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //update sql start
        $sql_header = "UPDATE";
        $sql_table = "role";
        $sql_set = [
            [$name,"`name` = ?"]
        ];
        $sql_where = [
            [$id, "AND `role`.`id` = ?"]
        ];
        $sql_execute = [$name, $id];
        $sql_conn = $db_tenant;
        $results_update_role = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);
        
        if($results_update_role){
            $final = array("status" => true, "notf" => "success", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "failed", "redir" => "none");
            return json_encode($final);
        }
    }
    
    function update_user_login($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime', 'auth']);
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_id = $_SESSION['d_id'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //post data
        $old_username = $post['update-input-old-username'];
        $new_username = $post['update-input-new-username'];
        $conf_username = $post['update-input-conf-username'];
        $config_for = 'default';
        $username = check_similarity($old_username, $new_username, $conf_username, $config_for);
        $username_config = $username['config'];
        $username_data = $username['data'];
        if($username['status'] === false){
            return json_encode($username);
        }
        
        $old_password = $post['update-input-old-password'];
        $new_password = $post['update-input-new-password'];
        $conf_password = $post['update-input-conf-password'];
        $config_for = 'hashed';
        $password = check_similarity($old_password, $new_password, $conf_password, $config_for);
        $password_config = $password['config'];
        $password_data = $password['data'];
        if($password['status'] === false){
            return json_encode($password);
        }
        
        $old_key = $post['update-input-old-key'];
        $new_key = $post['update-input-new-key'];
        $conf_key = $post['update-input-conf-key'];
        $config_for = 'default';
        $key = check_similarity($old_key, $new_key, $conf_key, $config_for);
        $key_config = $key['config'];
        $key_data = $key['data'];
        if($key['status'] === false){
            return json_encode($key);
        }
        
        $email = $post['update-input-email'];
        $phone = $post['update-input-phone'];
        $full_name = $post['update-input-full-name'];
        $call_name = $post['update-input-call-name'];
        $role = $post['update-input-role'];
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-image-url'];
        $sql_old_url = $post['update-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        $db_server = \Config\Database::connect(db_dynamic('cashiera_server', 'localhost', 'root', ''));
        
        //update sql start
        $sql_header = "UPDATE";
        $sql_table = "users";
        $sql_set = [
            [$username_data,"`username` = ?", $username_config],
            [$password_data,"`password` = ?", $password_config],
            [$email,"`email` = ?"],
            [$phone,"`phone` = ?"],
            [$full_name,"`full_name` = ?"],
            [$call_name,"`call_name` = ?"],
            [$image_url,"`image_url` = ?"],
        ];
        $sql_where = [
            [$id_user, "AND `users`.`id` = ?"]
        ];
        $sql_execute = [$username_data, $password_data, $email, $phone, $full_name, $call_name, $image_url, $id_user];
        $sql_conn = $db_tenant;
        $results_update_user_login = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);
        
        if($results_update_user_login){
            //do nothing
        }
        else{
            $final = array("status" => false, "notf" => "Data gagal update", "redir" => "none");
            return json_encode($final);
        }
//        
        //update key
        $sql_header = "UPDATE";
        $sql_table = "id_auth ia";
        $sql_set = [
            [$key_data,"`ia`.`key` = ?", $key_config]
        ];
        $sql_where = [
            [$db_id, "AND `ia`.`id` = ?"]
        ];
        $sql_execute = [$key_data, $db_id];
        $sql_conn = $db_server;
        $results_update_user_login = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);

        if($results_update_user_login){
            $_SESSION['username'] = $call_name;
            $final = array("status" => true, "notf" => "Data berhasil di update", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Data gagal update", "redir" => "none");
            return json_encode($final);
        }
    }
    
    function update_type_product($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //post data
        $id = $post['update-input-id'];
        $name = $post['update-input-name'];
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-image-url'];
        $sql_old_url = $post['update-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //update sql start
        $sql_header = "UPDATE";
        $sql_table = "type_product";
        $sql_set = [
            [$name,"`name` = ?"],
            [$image_url, "`image_url` = ?"]
        ];
        $sql_where = [
            [$id, "AND `type_product`.`id` = ?"]
        ];
        $sql_execute = [$name, $image_url, $id];
        $sql_conn = $db_tenant;
        $results_update_type_product = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);
        
        if($results_update_type_product){
            $final = array("status" => true, "notf" => "success", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "failed", "redir" => "none");
            return json_encode($final);
        }
    }
    
    function update_category_product($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //post data
        $id = $post['update-input-id'];
        $name = $post['update-input-name'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //update sql start
        $sql_header = "UPDATE";
        $sql_table = "category_product";
        $sql_set = [
            [$name,"`name` = ?"]
        ];
        $sql_where = [
            [$id, "AND `category_product`.`id` = ?"]
        ];
        $sql_execute = [$name, $id];
        $sql_conn = $db_tenant;
        $results_update_category_product = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);
        
        if($results_update_category_product){
            $final = array("status" => true, "notf" => "success", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "failed", "redir" => "none");
            return json_encode($final);
        }
    }
    
    function update_users($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //should not read admin
        $not_admin = "AND r.id != 1";
        
        //post data
        $id = $post['update-input-id'];
        $username = $post['update-input-username'];
        $password = $post['update-input-password'];
        
        //check if input change
        if($password == "*hidden*"){
            $password = "@*ignore*@";
            $password_config = "ignore";
        }
        else{
            $password = password_hash($post['update-input-password'], PASSWORD_ARGON2ID);
        }
        
        $email = $post['update-input-email'];
        $phone = $post['update-input-phone'];
        $role = $post['update-input-role'];
        $id_store = $post['update-input-id-store'];
        $full_name = $post['update-input-full-name'];
        $call_name = $post['update-input-call-name'];
        $status = $post['update-input-status'];
        $salary = $post['update-input-salary'];
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-image-url'];
        $sql_old_url = $post['update-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //update sql start
        $sql_header = "UPDATE";
        $sql_table = "users";
        $sql_set = [
            [$username,"`username` = ?"],
            [$password,"`password` = ?", $password_config],
            [$email,"`email` = ?"],
            [$phone,"`phone` = ?"],
            [$role,"`role` = ?"],
            [$id_store,"`id_store` = ?"],
            [$full_name,"`full_name` = ?"],
            [$call_name,"`call_name` = ?"],
            [$status,"`status` = ?"],
            [$salary,"`salary` = ?"],
            [$image_url,"`image_url` = ?"],
        ];
        $sql_where = [
            [$id, "AND `users`.`id` = ?"]
        ];
        $sql_execute = [$username, $password, $email, $phone, $role, $id_store, $full_name, $call_name, $status, $salary, $image_url, $id];
        $sql_conn = $db_tenant;
        $results_update_users = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);
        
        if($results_update_users){
            $final = array("status" => true, "notf" => "success", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "failed", "redir" => "none");
            return json_encode($final);
        }
    }
    
    function update_store($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //post data
        $id = $post['update-input-id'];
        $name = $post['update-input-name'];
        $location = $post['update-input-location'];
        $config = 0;
        $color = $post['update-input-color'];
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-image-url'];
        $sql_old_url = $post['update-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //update-input-logo
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-logo'];
        $sql_old_url = $post['update-input-logo'];
        $logo = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //update-input-print-logo
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-print-logo'];
        $sql_old_url = $post['update-input-print-logo'];
        $print_logo = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        $print_msg = $post['update-input-print-msg'];
        $mode = $post['update-input-mode'];
        $timezone = $post['update-input-timezone'];
        $latest_data = timeset('now', $post['update-input-timezone']);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //update sql start
        $sql_header = "UPDATE";
        $sql_table = "id_store";
        $sql_set = [
            [$name,"`name` = ?"],
            [$location,"`location` = ?"],
            [$color,"`color` = ?"],
            [$logo,"`logo` = ?"],
            [$print_logo,"`print_logo` = ?"],
            [$print_msg,"`print_msg` = ?"],
            [$mode,"`mode` = ?"],
            [$timezone,"`timezone` = ?"],
            [$latest_data,"`latest_data` = ?"],
            [$image_url,"`image_url` = ?"]
        ];
        $sql_where = [
            [$id, "AND `id_store`.`id` = ?"]
        ];
        $sql_execute = [$name, $location, $color, $logo, $print_logo, $print_msg, $mode, $timezone, $latest_data, $image_url, $id];
        $sql_conn = $db_tenant;
        $results_update_store = db_update_builder($sql_header, $sql_table, $sql_set, $sql_where, $sql_execute, $sql_conn);
        
        if($results_update_store){
            $final = array("status" => true, "notf" => "success", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "failed", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function update_product($post, $files){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['update-input-product-id'];
        $code = strval($post['update-input-code']);
        $name = $post['update-input-name'];
        $category = $post['update-input-category'];
        $brand = $post['update-input-brand'];
        $desc = $post['update-input-description'];
        $type = $post['update-input-type'];
        $stock = $post['update-input-stock'];
        $id_store = $post['update-input-id-store'];
        $capital = $post['update-input-capital'];
        $profit_min = $post['update-input-profit-min'];
        $profit_max = $post['update-input-profit-max'];
        $discount = $post['update-input-discount'];
        $weight = $post['update-input-weight'];
        $bundling = $post['update-input-bundling'];
        $stats = $post['update-input-stats'];
        $inputter = $username;
        $receipt = $post['update-input-receipt'];
        $latest_data = timeset('now', $post['update-input-timezone']);
        
        //update-input-image-url
        $sql_location = "./img/product/";
        $sql_file = $files['update-input-image-url'];
        $sql_old_url = $post['update-input-image-url'];
        $image_url = db_upload_builder($sql_location, $sql_file, $sql_old_url);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //update sql start
        $header = "UPDATE";
        $table = "product";
        $set = [
            [$code,"`code` = ?"],
            [$name,"`name` = ?"],
            [$category,"`category` = ?"],
            [$brand,"`brand` = ?"],
            [$desc,"`desc` = ?"],
            [$type,"`type` = ?"],
            [$stock,"`stock` = ?"],
            [$id_store, "`id_store` = ?"],
            [$capital,"`capital` = ?"],
            [$profit_min,"`profit_min` = ?"],
            [$profit_max,"`profit_max` = ?"],
            [$discount,"`discount` = ?"],
            [$weight,"`weight` = ?"],
            [$bundling,"`bundling` = ?"],
            [$stats,"`stats` = ?"],
            [$inputter,"`inputter` = ?"],
            [$receipt,"`receipt` = ?"],
            [$latest_data,"`latest_data` = ?"],
            [$image_url,"`image_url` = ?"],
        ];
        $sql_where = [
            [$id, "AND `product`.`id` = ?"]
        ];
        $execute = [$code,$name,$category,$brand,$desc,$type,$stock,$id_store,$capital,$profit_min,$profit_max,
            $discount,$weight,$bundling,$stats,$inputter,$receipt,$latest_data,$image_url,$id];
        $conn = $db_tenant;
        $results_update_product = db_update_builder($header, $table, $set, $sql_where, $execute, $conn);
        
        if($results_update_product){
            //do nothing
        }
        else{
            $final = array("status" => false, "data" => "fail", "notf" => "none", "redir" => "none");
            return json_encode($final);
        }
        
        //update sql start
        $header = "UPDATE";
        $table = "buying_history";
        $set = [
            [$profit_min,"`profit_min` = ?"],
            [$profit_max,"`profit_max` = ?"],
            [$capital,"`capital` = ?"]
        ];
        $sql_where = [
            [$id, "AND `buying_history`.`id` = ?"]
        ];
        $execute = [$profit_min, $profit_max, $capital, $id];
        $conn = $db_tenant;
        $results_buying_history = db_update_builder($header, $table, $set, $sql_where, $execute, $conn);
        
        if($results_buying_history){
            $final = array("status" => true, "data" => "success", "notf" => "none", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "data" => "fail", "notf" => "none", "redir" => "none");
            return json_encode($final);
        }
    }
}