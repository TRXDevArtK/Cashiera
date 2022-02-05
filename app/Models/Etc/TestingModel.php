<?php
 
namespace App\Models\Etc;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class TestingModel extends Model
{
    public function uploadtest($post, $files){
        //ambil helper untuk mengambil database
        helper('dynamicdb');

        //ambil post
        $username = "admin";
        $password = "12345";
        $key = "admin";

        //database server
        $db_server = \Config\Database::connect(db_dynamic("server"));
        
        $sql_header = "SELECT";
        $sql_column = [
            ["ia.id", "id"],
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
        }
        
        if($id == null){
            $final = array("status" => false, "data" => null, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => null);
            return json_encode($final);
        }
        
        $db_name = "tenant_".$id;
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        return print_r($db_name);
        
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
            
        //jika benar maka buat session dan set return true;
        if(password_verify($password, $data['password'])){
            return "berhasil login";
        } 
        else {
            return "gagal login";
        }
    }
    
    public function alltest($post){
        helper('dynamicdb');
        
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        $timezone = "UTC";
        $data = [['id'=> 2, 'product_id'=> 17, 'name'=> 'Nokia 105', 'code'=> 6438409036803, 'discount'=> 0, 'profit_min'=> 30000, 'profit_max'=> 80000, 'datetime'=> '2021-06-25 03:18:44', 'capital'=> 220000, 'profit'=> 300000, 'report'=> '', 'pricing_report'=> '', 'amount'=> 1, 'teller'=> 1, 'online'=> 0]];
        
        //database server
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
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
            $execute = [$data[$i]['amount'], $data[$i]['product_id']];
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
    
    public function create_product($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');

        //ambil post
        $username = "admin";
        $password = "12345";
        $key = "admin";

        //database server
        $db_server = \Config\Database::connect(db_dynamic("server"));
        
        $sql_header = "SELECT";
        $sql_column = [
            ["ia.id", "id"],
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
        }
        
        if($id == null){
            $final = array("status" => false, "data" => null, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => null);
            return json_encode($final);
        }

        $db_name = "tenant_".$id;
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
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
            $data['db_name'] = "tenant_".$id;
            $data['username'] = $data['call_name'];
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
    
    public function update_product($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        $code = "";
        $name = "aa";
        $brand = "";
        $id = "";
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //update sql start
        $header = "UPDATE";
        $table = "product";
        $set = [
            [$code,"`code` = ?"],
            [$name,"`name` = ?"],
            [$brand,"`brand` = ?"]
        ];
        $sql_where = [
            [$id, "AND product.id = ?"]
        ];
        $execute = [$code,$name,$brand,$id];
        $conn = $db_tenant;
        $results = db_update_builder($header, $table, $set, $sql_where, $execute, $conn);
        
        $final = array("status" => true, "notf" => $results, "redir" => "none");
        return json_encode($final);
    }
    
    public function get_product_results($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM product p LEFT JOIN product_location pl ON p.id = pl.product_id "
                . "LEFT JOIN id_store ids ON pl.store_id = ids.id "
                . "LEFT JOIN category_product cp ON p.category = cp.id "
                . "LEFT JOIN type_product tp ON p.type = cp.id "
                . "LEFT JOIN bundling b ON p.bundling = b.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (p.latest_data >= ? AND p.latest_data < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR p.profit_min LIKE ? OR p.profit_max LIKE ? OR p.stock LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name ASC";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results->getNumRows();
        $paging['total-paging'] = ceil($paging['total-record'] / $limit);
        $paging['start-from'] = ($paging_num-1) * $limit;
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["p.name", "Nama"],
            ["p.code", "Kode"],
            ["cp.name", "Kategori"],
            ["tp.name", "Tipe"],
            ["ids.name", "Toko"],
            ["p.brand", "Branding"],
            ["p.profit_min", "Untung Min"],
            ["p.profit_max", "Untung Maks"],
            ["p.discount", "Diskon"],
            ["p.stock", "Stock"],
            ["p.weight", "Berat"],
            ["p.inputter", "Penginput"],
            ["p.latest_data", "Data Dimodif"],
            ["p.receipt", "Struk"],
            ["p.stats", "Status"],
            ["p.bundling", "ID Bundling"],
            ["p.category", "ID Kategori"],
            ["p.type", "ID Tipe"],
            ["ids.id", "ID Toko"],
            ["p.id", "ID Barang"]
        ];
        $sql_table = "FROM product p LEFT JOIN product_location pl ON p.id = pl.product_id "
                . "LEFT JOIN id_store ids ON pl.store_id = ids.id "
                . "LEFT JOIN category_product cp ON p.category = cp.id "
                . "LEFT JOIN type_product tp ON p.type = cp.id "
                . "LEFT JOIN bundling b ON p.bundling = b.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (p.latest_data >= ? AND p.latest_data < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR p.profit_min LIKE ? OR p.profit_max LIKE ? OR p.stock LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name DESC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function login($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        // sanitize terms
        $terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_SPECIAL_CHARS);

        //ambil post
        //$post = $request->getPost();
        $username = $post['username'];
        $password = $post['password'];
        $key = $post['key'];

        //database server
        $db_server = \Config\Database::connect(db_dynamic("server"));
        
        $init_sql['query'] = "SELECT id FROM `id_auth` WHERE `key` = ?";
        $init_sql['db'] = $db_server;

        //query dengan prepare
        $pQuery = $db_server->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);
        
        $results = $pQuery->execute($key);

        //peringatan, jquery tidak bisa return integer atau nilai = null
        foreach($results->getResult() as $row)
        {
            $id = $row->id;
        }
        
        //tutup db sebelumnya
        $pQuery->close();
        
        if($id == null){
            $final = array("status" => false, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => "none");
            return json_encode($final);
        }

        $db_name = "tenant_".$id;

        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        $init_sql['query'] = "select id,password,username from `users` where `username` = ?";
        $init_sql['db'] = $db_tenant;
        
        $pQuery = $db_tenant->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);

        $results = $pQuery->execute($username);
        foreach($results->getResult() as $row)
        {
            $db_id = $row->id;
            $db_username = $row->username;
            $db_password = $row->password;
        }
        
        //tutup db sebelumnya
        $pQuery->close();
            
        //jika benar maka buat session dan set return true;
        if(password_verify($password, $db_password)){
            $session = session();
            $_SESSION['u_id'] = $db_id;
            $_SESSION['d_id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['login'] = true;
            $_SESSION['start'] = time();
            
            if(isset($_POST['save'])){
                $_SESSION['expire'] = $_SESSION['start'] + (1 * 24 * 60 * 60 );
            }
            else{
                $_SESSION['expire'] = $_SESSION['start'] + (180 * 60);
            }
            
            $final = array("status" => true, "notf" => "Login berhasil, mohon tunggu", "redir" => base_url("/dashboard/laporan-keseluruhan"));
            return json_encode($final);
        } else {
            $final = array("status" => false, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function testdb1($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        //post data
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //ambil total penjualan sesuai dengan filter
        
        //query initialization
        $header = "SELECT";
        $column = [
            ["p.name", "Nama"],
            ["sh.product_id", "ID Produk"],
            ["p.code", "Kode Produk"],
            ["sh.datetime", "Tanggal"],
            ["sh.amount", "Jumlah"],
            ["sh.profit", "Keuntungan"],
            ["sh.id", "ID Penjualan"],
            ["sh.teller", "Teller"],
            ["sh.report", "Laporan"],
            ["sh.pricing_report", "Laporan Keungan"]
        ];
        $table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id "
            . "LEFT JOIN product_location pl ON pl.product_id = sh.product_id";
        $where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR sh.profit LIKE ? OR sh.amount LIKE ?)"]
        ];
        $group = "GROUP BY p.id ASC";
        $limit = ["",""];
        $execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search];
        $conn = $db_tenant;
        
        $results = db_query_builder($header, $column, $table, $where, $group, $limit, $execute, $conn);
        
        foreach($results->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        $final = array("data" => $data);
        return json_encode($final, JSON_PRETTY_PRINT);
    }
    
    public function PagingModel_get_paging_config($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        //session data
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        //post data
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //ambil total penjualan sesuai dengan filter
        $pQuery = $db_tenant->prepare(function($db_tenant){
            $sql = "SELECT COUNT(*) as count "
                    . "FROM selling_history sh "
                    . "LEFT JOIN product p "
                    . "ON sh.product_id = p.id "
                    . "LEFT JOIN product_location pl "
                    . "ON pl.product_id = sh.product_id "
                    . "WHERE (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY)) "
                    . "AND pl.store_id = ? "
                    . "AND p.category = ? "
                    . "AND p.type = ? "
                    . "AND (p.name LIKE ? "
                    . "OR sh.profit LIKE ? "
                    . "OR sh.amount LIKE ?) "
                    . "GROUP BY p.name DESC ";

            return (new Query($db_tenant))->setQuery($sql);
        });

        $results = $pQuery->execute($first_date, $last_date, $store, $category, $type, $search, $search, $search);

        //dapatkan jumlah
        $data['total-record'] = $results->getNumRows();
        $data['total-paging'] = ceil($data['total-record'] / $limit);

        //tutup db sebelumnya
        $pQuery->close();
        
        $final = array("status" => true, "data" => $data, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function ResultsModel_get_selling_results($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id "
                . "LEFT JOIN product_location pl ON pl.product_id = sh.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR sh.profit LIKE ? OR sh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name DESC";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results->getNumRows();
        $paging['total-paging'] = ceil($paging['total-record'] / $limit);
        $paging['start-from'] = ($paging_num-1) * $limit;
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["p.name", "Nama"],
            ["sh.product_id", "ID Produk"],
            ["p.code", "Kode Produk"],
            ["sh.datetime", "Tanggal"],
            ["sh.amount", "Jumlah"],
            ["sh.profit", "Keuntungan"],
            ["sh.id", "ID Penjualan"],
            ["sh.teller", "Teller"],
            ["sh.report", "Laporan"],
            ["sh.pricing_report", "Laporan Keungan"]
        ];
        $sql_table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id "
                . "LEFT JOIN product_location pl ON pl.product_id = sh.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR sh.profit LIKE ? OR sh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name DESC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function ResultsModel_get_buying_results($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM buying_history bh LEFT JOIN product p ON bh.product_id = p.id "
                . "LEFT JOIN product_location pl ON pl.product_id = bh.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (bh.datetime >= ? AND bh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR bh.profit LIKE ? OR bh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name DESC";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results->getNumRows();
        $paging['total-paging'] = ceil($paging['total-record'] / $limit);
        $paging['start-from'] = ($paging_num-1) * $limit;
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["p.name", "Nama"],
            ["bh.product_id", "ID Produk"],
            ["p.code", "Kode Produk"],
            ["bh.datetime", "Tanggal"],
            ["bh.amount", "Jumlah"],
            ["bh.profit", "Keuntungan"],
            ["p.capital", "Modal"],
            ["bh.id", "ID Pembelian"],
            ["bh.teller", "Teller"]
        ];
        $sql_table = "FROM buying_history bh LEFT JOIN product p ON bh.product_id = p.id "
                . "LEFT JOIN product_location pl ON pl.product_id = bh.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (bh.datetime >= ? AND bh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR bh.profit LIKE ? OR bh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name DESC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function FiltersModel_get_list_toko($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        $search = "%".$post['search']."%";
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["id", "id"],
            ["name", "name"]
        ];
        $sql_table = "FROM `id_store`";
        $sql_where = [
            [$search, "AND `name` LIKE ?"]
        ];
        $sql_group = "ORDER BY `id` ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search];
        $sql_conn = $db_tenant;
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        foreach($results->getResult() as $row){
            $data['name'][] = $row->name;
            $data['id'][] = $row->id;
        }
        
        $final = array("status" => true, "data" => $data, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function ResultsModel_overall_results($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        //ambil post
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = "tenant_".$_SESSION['d_id'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "total_sales_num"],
            ["SUM(sh.profit+p.capital)", "total_selling"],
            ["SUM(sh.profit)", "total_profit"]
        ];
        $sql_table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id "
                . "LEFT JOIN product_location pl ON pl.product_id = sh.product_id ";
        $sql_where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type];
        $sql_conn = $db_tenant;
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results->getResult() as $row)
        {
           $total_sales_num = $row->total_sales_num;
           $total_selling = $row->total_selling;
           $total_profit = $row->total_profit;
        }
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["SUM(p.capital)", "total_capital"]
        ];
        $sql_table = "FROM buying_history bh "
                . "LEFT JOIN product p ON bh.product_id = p.id "
                . "LEFT JOIN product_location pl ON pl.product_id = bh.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (bh.datetime >= ? AND bh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND pl.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type];
        $sql_conn = $db_tenant;
        $results = db_query_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results->getResult() as $row)
        {
            $total_capital = $row->total_capital;
        }
        
        if($total_selling === null){
            $total_selling = "0";
        }
        
        if($total_capital === null){
            $total_capital = "0";
        }
        
        if($total_profit === null){
            $total_profit = "0";
        }
        
        $data = array('total-capital' => $total_capital, 
            "total-profit" => $total_profit, 
            "total-selling" => $total_selling, 
            "total-sales-num" => $total_sales_num);
        
        $final = array("status" => true, "data" => $data, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function AuthModel_register($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');

        //$post = $request->getPost();
        $no_hp = $post['no-hp'];
        $email = $post['email'];
        $username = $post['username'];
        $password = $post['password'];
        $conf_password = $post['conf-password'];
        $key = $post['key'];
        $conf_key = $post['conf-key'];
        $robot = $post['robot-check'];
        
        //cek jika key/password sama dengan confirmasi
        if($key != $conf_key || $password != $conf_password){
            $final = array("status" => false, "notf" => "Maaf key atau password salah, silahkan coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        if($robot != "false"){
            $final = array("status" => false, "notf" => "Mohon centang, saya bukan robot", "redir" => "none");
            return json_encode($final);
        }
        
        //ambil waktu
        $time = new Time('now');
        $time = $time->toDateTimeString();
        
        //database server
        $db_server = \Config\Database::connect(db_dynamic("server"));
        
        $init_sql['query'] = "SELECT `key` FROM `id_auth` WHERE `key` = ?";
        $init_sql['db'] = $db_server;
        
        //cari apabila username sama
        $pQuery = $db_server->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);
        
        $results = $pQuery->execute($key);
        $pQuery->close();
        
        if($results->getNumRows() > 0){
            $final = array("status" => false, "notf" => "Maaf key sudah ada, silahkan input yang lain", "redir" => "none");
            return json_encode($final);
        }
        
        //input ke id_auth datanya
        $init_sql['query'] = "INSERT INTO `id_auth` (`id`, `key`, `last_login`, `first_login`) VALUES (NULL, ?, ?, ?)";
        $init_sql['db'] = $db_server;
        
        $pQuery = $db_server->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);
        
        $results = $pQuery->execute($key, $time, $time);
        $pQuery->close();
        
        //ambil id nya dari auth
        $init_sql['query'] = "SELECT `id` FROM `id_auth` WHERE `key` = ?";
        $init_sql['db'] = $db_server;
        
        $pQuery = $db_server->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);
        
        $results = $pQuery->execute($key);
        $pQuery->close();
        
        foreach($results->getResult() as $row){
            $id = $row->id;
        }
        
        //buat databasenya
        $db_name = "tenant_".$id;
        
        $forge = \Config\Database::forge();
        $create_db = $forge->createDatabase($db_name);
        if($create_db == true){
            //lanjut
        }
        else{
            $final = array("status" => false, "notf" => "sepertinya ada kesahalan server database, mohon coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        //buat semua tabel yang diperlukan
        $db_create = db_create_tenant($db_name);
        if($db_create == true){
            //lanjut
        }
        else{
            $final = array("status" => false, "notf" => "sepertinya ada kesahalan server database, mohon coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        //ambil db tenant sesuai db name
        $db_tenant = \Config\Database::connect(db_dynamic($db_name));
        
        $init_sql['query'] = "INSERT INTO `users` (`id`, `username`, `password`, `email`, "
                    . "`phone`, `role`, `id_store`, `full_name`, `call_name`, `status`, `salary`) "
                    . "VALUES (NULL, ?, ?, ?, ?, ?, ?, '', NULL, ?, NULL)";
        $init_sql['db'] = $db_tenant;
        
        $pQuery = $db_tenant->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);
        
        //password hash
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);
        
        //role (0 default admin tenant)
        $role = '0'; 
        
        //id store (0 default semua store)
        $id_store = '0';
        
        //status (0 default admin tenant)
        $status = '0';
        
        $results = $pQuery->execute($username, $password_hash, $email, $no_hp, $role, $id_store, $status);
        $pQuery->close();
        
        $init_sql['query'] = "SELECT `id`,`username` FROM `users` WHERE `username` = ?";
        $init_sql['db'] = $db_tenant;
        
        $pQuery = $db_tenant->prepare(function($init_sql){
            $sql = $init_sql['query'];

            return (new Query($init_sql['db']))->setQuery($sql);
        },$init_sql);
        
        $results = $pQuery->execute($username);
        $pQuery->close();
        if($results->getNumRows() == 1){
            $final = array("status" => true, "notf" => "registrasi berhasil, anda akan login, mohon tunggu sebentar", "redir" => base_url("/dashboard/laporan-keseluruhan"));
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Username sudah ada atau kesalahan server, silahkan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
}

