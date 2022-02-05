<?php

namespace App\Models\Services;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class ServicesModel extends Model
{
    public function create_selling_history($post){
        helper(['dynamicdb','datetime']);
        
        $db_name = $post['db_name'];
        $db_hostname = $post['db_hostname'];
        $db_username = $post['db_username'];
        $db_password = $post['db_password'];
        $timezone = $post['timezone'];
        $data = json_decode($post['data'], true);
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //debug
        //$final = array("status" => true, "data" => $data[0], "notf" => "Berhasil", "redir" => "none");
        //return json_encode($final);
        
        $results_input_role = false;
        
        //create product in product table
        for($i = 0;$i<count($data);$i++){
            $sql_header = "INSERT INTO";
            $sql_table = "`selling_history`";
            $sql_insert = [
                ['`id`', NULL],
                ['`datetime`', $data[$i]['datetime']],
                ['`capital`', $data[$i]['capital']],
                ['`profit`', $data[$i]['profit']],
                ['`report`', $data[$i]['report']],
                ['`pricing_report`', $data[$i]['pricing_report']],
                ['`amount`', $data[$i]['amount']],
                ['`product_id`', $data[$i]['product_id']],
                ['`teller`', $data[$i]['teller']]
            ];
            $sql_execute = [NULL, $data[$i]['datetime'], $data[$i]['capital'], $data[$i]['profit'], $data[$i]['report'], 
                $data[$i]['pricing_report'], $data[$i]['amount'], $data[$i]['product_id'], $data[$i]['teller']];
            $sql_conn = $db_tenant;
            $results_input_role = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
            
            //update product
            $header = "UPDATE";
            $table = "product";
            $set = [
                [$data[$i]['amount'],"`stock` = `stock` - ?"],
                [timeset('now', $timezone),"`latest_data` = ?"],
            ];
            $sql_where = [
                [$data[$i]['product_id'], "AND `product`.`id` = ?"]
            ];
            $execute = [$data[$i]['amount'], timeset('now', $timezone), $data[$i]['product_id']];
            $conn = $db_tenant;
            $results_update_product = db_update_builder($header, $table, $set, $sql_where, $execute, $conn);
        }
                
        if($results_update_product){
            $final = array("status" => true, "notf" => "Data berhasil di upload / online", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function login($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');

        //ambil post
        $username = $post['username'];
        $password = $post['password'];
        $key = $post['key'];

        //database server
        $db_server = \Config\Database::connect(db_dynamic('cashiera_server', 'localhost', 'root', ''));
        
        $sql_header = "SELECT";
        $sql_column = [
            ["ia.id", "id"],
            ["ia.db_name", "db_name"],
            ["ia.db_hostname", "db_hostname"],
            ["ia.db_username", "db_username"],
            ["ia.db_password", "db_password"]
        ];
        $sql_table = "FROM `id_auth` ia";
        $sql_where = [
            [$key, "AND ia.key = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$key];
        $sql_conn = $db_server;
        $results_id_auth = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results_id_auth->getResult() as $row)
        {
            $id = $row->id;
            $db_name = $row->db_name;
            $db_hostname = $row->db_hostname;
            $db_username = $row->db_username;
            $db_password = $row->db_password;
        }
        
        if($id == null){
            $final = array("status" => false, "data" => null, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => null);
            return json_encode($final);
        }

        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $sql_header = "SELECT";
        $sql_column = [
            ["u.id", "id"],
            ["u.username", "username"],
            ["u.password", "password"],
            ["u.email", "email"],
            ["u.phone", "phone"],
            ["u.role", "role"],
            ["u.id_store", "id_store"],
            ["u.full_name", "full_name"],
            ["u.call_name", "call_name"],
            ["u.status", "status"],
            ["u.salary", "salary"],
            ["u.image_url", "image_url"]
        ];
        $sql_table = "FROM `users` u";
        $sql_where = [
            [$username, "AND u.username = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$username];
        $sql_conn = $db_tenant;
        $results_users = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        foreach($results_users->getResult('array') as $row)
        {
            $data[] = $row;
        }
        
        //get only 1
        $data = $data[0];
            
        //jika benar maka buat session dan set return true;
        if(password_verify($password, $data['password'])){
            //start set session for login
            $data['user_id'] = $data['id'];
            $data['db_id'] = $id;
            $data['db_name'] = $db_name;
            $data['db_hostname'] = $db_hostname;
            $data['db_username'] = $db_username;
            $data['db_password'] = $db_password;
            $data['login'] = true;
            $data['start'] = time();
            $data['expire'] = $data['start'] + (1 * 24 * 60 * 60 );
            
            $final = array("status" => true, "data" => $data, "notf" => "Login berhasil, mohon tunggu", "redir" => "/dashboard");
            return json_encode($final);
        } 
        else{
            $final = array("status" => false, "data" => null, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => null);
            return json_encode($final);
        }
    }
    
    public function read_latest_table_data($post){
        
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $db_name = $post['db_name'];
        $db_hostname = $post['db_hostname'];
        $db_username = $post['db_username'];
        $db_password = $post['db_password'];
        $user_id = $post['user_id'];
        $latest_data = $post['latest_data'];
        $id_store = $post['id_store'];
        
        $image_download = [];

        //database server
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $read_product = $db_tenant->query("SELECT * FROM product WHERE latest_data > '".$latest_data."' AND id_store = '".$id_store."'");
        foreach($read_product->getResult('array') as $row)
        {
            $read_product_data[] = $row;
            if($row['image_url'] == "" || $row['image_url'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['image_url'];
            }
        }
        
        $read_type_product = $db_tenant->query("SELECT * FROM type_product");
        foreach($read_type_product->getResult('array') as $row)
        {
            $type_product_data[] = $row;
            if($row['image_url'] == "" || $row['image_url'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['image_url'];
            }
        }
        
        $read_category_product = $db_tenant->query("SELECT * FROM category_product");
        foreach($read_category_product->getResult('array') as $row)
        {
            $category_product_data[] = $row;
        }
        
        $read_bundling = $db_tenant->query("SELECT * FROM bundling");
        foreach($read_bundling->getResult('array') as $row)
        {
            $bundling_data[] = $row;
        }
        
        $read_store_config = $db_tenant->query("SELECT ids.id, ids.name, ids.location, ids.config, ids.color, ids.logo, "
                . "ids.print_logo, ids.print_msg, ids.mode, ids.timezone, ids.latest_data, ids.image_url FROM id_store ids "
                . "LEFT JOIN users u ON u.id_store = ids.id WHERE u.id = '".$user_id."'");
        foreach($read_store_config->getResult('array') as $row)
        {
            $store_data[] = $row;
            if($row['image_url'] == "" || $row['image_url'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['image_url'];
            }
            
            if($row['logo'] == "" || $row['logo'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['logo'];
            }
            
            if($row['print_logo'] == "" || $row['print_logo'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['print_logo'];
            }
        }
        
        //add base url
        $image_download[] = array_walk($image_download, function(&$value) {$value = base_url($value); });
        
        $data = [];
        $data['read_product'] = $read_product_data;
        $data['type_product'] = $type_product_data;
        $data['category_product'] = $category_product_data;
        $data['bundling'] = $bundling_data;
        $data['store'] = $store_data[0];
        $data['image_download'] = $image_download;
        
        if($read_product == true && $read_type_product == true && $read_category_product == true 
                && $read_bundling == true && $read_store_config == true){
            $final = array("status" => true, "data" => $data, "notf" => "Proses Database Berhasil", "redir" => null);
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "data" => null, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => null);
            return json_encode($final);
        }
    }
    
    public function read_table_data($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $db_name = $post['db_name'];
        $db_hostname = $post['db_hostname'];
        $db_username = $post['db_username'];
        $db_password = $post['db_password'];
        $user_id = $post['user_id'];
        $id_store = $post['id_store'];
        
        $image_download = [];

        //database server
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $read_product = $db_tenant->query("SELECT * FROM product WHERE id_store = '".$id_store."'");
        foreach($read_product->getResult('array') as $row)
        {
            $read_product_data[] = $row;
            if($row['image_url'] == "" || $row['image_url'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['image_url'];
            }
        }
        
        $read_type_product = $db_tenant->query("SELECT * FROM type_product");
        foreach($read_type_product->getResult('array') as $row)
        {
            $type_product_data[] = $row;
            if($row['image_url'] == "" || $row['image_url'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['image_url'];
            }
        }
        
        $read_category_product = $db_tenant->query("SELECT * FROM category_product");
        foreach($read_category_product->getResult('array') as $row)
        {
            $category_product_data[] = $row;
        }
        
        $read_bundling = $db_tenant->query("SELECT * FROM bundling");
        foreach($read_bundling->getResult('array') as $row)
        {
            $bundling_data[] = $row;
        }
        
        $read_store_config = $db_tenant->query("SELECT ids.id, ids.name, ids.location, ids.config, ids.color, ids.logo, "
                . "ids.print_logo, ids.print_msg, ids.mode, ids.timezone, ids.latest_data, ids.image_url FROM id_store ids "
                . "LEFT JOIN users u ON u.id_store = ids.id WHERE u.id = '$user_id'");
        foreach($read_store_config->getResult('array') as $row)
        {
            $store_data[] = $row;
            if($row['image_url'] == "" || $row['image_url'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['image_url'];
            }
            
            if($row['logo'] == "" || $row['logo'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['logo'];
            }
            
            if($row['print_logo'] == "" || $row['print_logo'] == null){
                //do nothing
            }
            else{
                $image_download[] = $row['print_logo'];
            }
        }
        
        //add base url
        $image_download[] = array_walk($image_download, function(&$value) {$value = base_url($value); });
        
        $data = [];
        $data['read_product'] = $read_product_data;
        $data['type_product'] = $type_product_data;
        $data['category_product'] = $category_product_data;
        $data['bundling'] = $bundling_data;
        $data['store'] = $store_data[0];
        $data['image_download'] = $image_download;
        
        if($read_product == true && $read_type_product == true && $read_category_product == true 
                && $read_bundling == true && $read_store_config == true){
            $final = array("status" => true, "data" => $data, "notf" => "Proses Database Berhasil", "redir" => null);
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "data" => null, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => null);
            return json_encode($final);
        }
    }
}

