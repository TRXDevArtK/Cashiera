<?php
 
namespace App\Models\Admin;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class ReadModel extends Model
{
    public function read_user_login($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_id = $_SESSION['d_id'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //database tenant & admin
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        $db_server = \Config\Database::connect(db_dynamic('cashiera_server', 'localhost', 'root', ''));
        
        //check key in server
        $sql_header = "SELECT";
        $sql_column = [
            ["ia.key", "key"],
        ];
        $sql_table = "FROM `id_auth` ia ";
        $sql_where = [
            [$db_id, "AND ia.id = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$db_id];
        $sql_conn = $db_server;
        $results_data = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        foreach($results_data->getResult('array') as $row)
        {
           $key = $row['key'];
        }
        
        //get data from user
        $sql_header = "SELECT";
        $sql_column = [
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
            ["u.image_url", "image_url"],
            ["ids.name", "store_name"],
            ["r.name", "role_name"]
        ];
        $sql_table = "FROM `users` u "
                . "LEFT JOIN role r ON u.role = r.id "
                . "LEFT JOIN id_store ids ON u.id_store = ids.id";
        $sql_where = [
            [$id_user, "AND u.id = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$id_user];
        $sql_conn = $db_tenant;
        $results_data = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results_data->getResult('array') as $row)
        {
           $data = $row;
        }
        
        //input key to data
        $data['key'] = $key;
        
        $final = array("status" => true, "data" => $data, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function read_role($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //should not read admin
        $not_admin = "AND id != 1";
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM `role` r";
        $sql_where = [
            [$search, "AND `r`.`name` LIKE ?"],
            [$not_admin, $not_admin]
        ];
        $sql_group = "GROUP BY `r`.`name` ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search];
        $sql_conn = $db_tenant;
        $results_count = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results_count->getNumRows();
        if($limit == "" || $limit == null || $paging_num == "" || $paging_num == null){
            $paging['total-paging'] = "";
            $paging['start-from'] = "";
        }
        else{
            $paging['total-paging'] = ceil($paging['total-record'] / $limit);
            $paging['start-from'] = ($paging_num-1) * $limit;
        }
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["r.id", "id"],
            ["r.name", "name"],
            ["r.owner", "owner"],
            ["r.delete_self", "delete_self"],
            ["r.delete_other", "delete_other"]
        ];
        $sql_table = "FROM `role` r";
        $sql_where = [
            [$search, "AND `r`.`name` LIKE ?"],
            [$not_admin, $not_admin]
        ];
        $sql_group = "GROUP BY `r`.`name` ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$search, $paging['start-from'],$limit];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        foreach($results->getResult('array') as $row){
            $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function read_users($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //should not read admin
        $not_admin = "AND r.id != 1";
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM `users` u "
                . "LEFT JOIN role r ON u.role = r.id "
                . "LEFT JOIN id_store ids ON u.id_store = ids.id";
        $sql_where = [
            [$search, "AND (ids.name LIKE ? OR u.username LIKE ? OR u.full_name LIKE ? OR r.name LIKE ? OR u.phone LIKE ?)"],
            [$not_admin, $not_admin]
        ];
        $sql_group = "GROUP BY u.full_name ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search, $search, $search, $search, $search];
        $sql_conn = $db_tenant;
        $results_count = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results_count->getNumRows();
        $paging['total-paging'] = ceil($paging['total-record'] / $limit);
        $paging['start-from'] = ($paging_num-1) * $limit;
        
        //query initialization
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
            ["u.image_url", "image_url"],
            ["ids.name", "store_name"],
            ["r.name", "role_name"],
        ];
        $sql_table = "FROM `users` u "
                . "LEFT JOIN role r ON u.role = r.id "
                . "LEFT JOIN id_store ids ON u.id_store = ids.id";
        $sql_where = [
            [$search, "AND (ids.name LIKE ? OR u.username LIKE ? OR u.full_name LIKE ? OR r.name LIKE ? OR u.phone LIKE ?)"],
            [$not_admin, $not_admin]
        ];
        $sql_group = "GROUP BY u.full_name ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$search, $search, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results_data = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results_data->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function read_store($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM `id_store` ids";
        $sql_where = [
            [$search, "AND (ids.name LIKE ? OR ids.location LIKE ?)"]
        ];
        $sql_group = "GROUP BY ids.name ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results->getNumRows();
        $paging['total-paging'] = ceil($paging['total-record'] / $limit);
        $paging['start-from'] = ($paging_num-1) * $limit;
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["ids.name", "name"],
            ["ids.location", "location"],
            ["ids.timezone", "timezone"],
            ["ids.latest_data", "latest_data"],
            ["ids.id", "id"],
            ["ids.image_url", "image_url"],
            ["ids.config", "config"],
            ["ids.color", "color"],
            ["ids.logo", "logo"],
            ["ids.print_logo", "print_logo"],
            ["ids.print_msg", "print_msg"],
            ["ids.mode", "mode"],
        ];
        $sql_table = "FROM `id_store` ids";
        $sql_where = [
            [$search, "AND (ids.name LIKE ? OR ids.location LIKE ?)"]
        ];
        $sql_group = "GROUP BY ids.name ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

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
    
    public function read_product($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM product p LEFT JOIN id_store ids ON p.id_store = ids.id "
                . "LEFT JOIN category_product cp ON p.category = cp.id "
                . "LEFT JOIN type_product tp ON p.type = cp.id "
                . "LEFT JOIN bundling b ON p.bundling = b.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (p.latest_data >= ? AND p.latest_data < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.id_store = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR p.profit_min LIKE ? OR p.profit_max LIKE ? OR p.stock LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name ASC";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
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
            ["p.brand", "Brand"],
            ["p.profit_min", "Untung Min"],
            ["p.profit_max", "Untung Maks"],
            ["p.capital", "Modal"],
            ["p.discount", "Diskon"],
            ["p.stock", "Stock"],
            ["p.weight", "Berat"],
            ["p.inputter", "Penginput"],
            ["p.latest_data", "Data Terakhir"],
            ["ids.latest_data", "Data Terakhir Store"],
            ["ids.timezone", "Timezone"],
            ["p.stats", "Status"],
            ["p.receipt", "Struk"],
            ["p.desc", "Deskripsi"],
            ["p.image_url", "URL Gambar"],
            ["p.bundling", "ID Bundling"],
            ["p.category", "ID Kategori"],
            ["p.type", "ID Tipe"],
            ["p.id_store", "ID Toko"],
            ["p.id", "ID Barang"]
        ];
        $sql_table = "FROM product p LEFT JOIN id_store ids ON p.id_store = ids.id "
                . "LEFT JOIN category_product cp ON p.category = cp.id "
                . "LEFT JOIN type_product tp ON p.type = cp.id "
                . "LEFT JOIN bundling b ON p.bundling = b.product_id";
        $sql_where = [
            [$first_date."".$last_date, "AND (p.latest_data >= ? AND p.latest_data < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.id_store = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR p.profit_min LIKE ? OR p.profit_max LIKE ? OR p.stock LIKE ?)"]
        ];
        $sql_group = "GROUP BY p.name DESC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

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
    
    public function read_selling_history($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id LEFT JOIN users u ON sh.teller = u.id";
        $sql_where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR sh.profit LIKE ? OR sh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY sh.id ASC";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
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
            ["sh.capital", "Modal"],
            ["sh.profit", "Keuntungan"],
            ["sh.id", "ID Penjualan"],
            ["sh.teller", "Teller"],
            ["sh.report", "Laporan"],
            ["sh.pricing_report", "Laporan Keuangan"],
            ["u.call_name", "Nama Panggil"],
        ];
        $sql_table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id LEFT JOIN users u ON sh.teller = u.id";
        $sql_where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR sh.profit LIKE ? OR sh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY sh.id ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

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
    
    public function read_buying_history($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $first_date = $post['first_date'];
        $last_date = $post['last_date'];
        $store = $post['filter_store'];
        $category = $post['filter_category'];
        $type = $post['filter_type'];
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM buying_history bh LEFT JOIN product p ON bh.product_id = p.id LEFT JOIN users u ON bh.teller = u.id";
        $sql_where = [
            [$first_date."".$last_date, "AND (bh.datetime >= ? AND bh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR bh.profit LIKE ? OR bh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY bh.id ASC";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search];
        $sql_conn = $db_tenant;
        
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
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
            ["bh.profit_min", "Keuntungan Min"],
            ["bh.profit_max", "Keuntungan Maks"],
            ["p.capital", "Modal"],
            ["bh.id", "ID Pembelian"],
            ["u.call_name", "Teller"],
        ];
        $sql_table = "FROM buying_history bh LEFT JOIN product p ON bh.product_id = p.id LEFT JOIN users u ON bh.teller = u.id";
        $sql_where = [
            [$first_date."".$last_date, "AND (bh.datetime >= ? AND bh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"],
            [$search, "AND (p.name LIKE ? OR bh.profit LIKE ? OR bh.amount LIKE ?)"]
        ];
        $sql_group = "GROUP BY bh.id ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$first_date, $last_date, $store, $category, $type, $search, $search, $search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

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
    
    public function read_overall_result($post){
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
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["SUM(sh.amount)", "total_sales_num"],
            ["SUM((sh.profit+sh.capital)*sh.amount)", "total_selling"],
            ["SUM(sh.profit*sh.amount)", "total_profit"]
        ];
        $sql_table = "FROM selling_history sh LEFT JOIN product p ON sh.product_id = p.id ";
        $sql_where = [
            [$first_date."".$last_date, "AND (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.id_store = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results->getResult() as $row)
        {
           $total_sales_num = $row->total_sales_num;
           $total_selling = $row->total_selling;
           $total_profit = $row->total_profit;
        }
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["SUM(bh.capital*bh.amount)", "total_capital"]
        ];
        $sql_table = "FROM buying_history bh LEFT JOIN product p ON bh.product_id = p.id ";
        $sql_where = [
            [$first_date."".$last_date, "AND (bh.datetime >= ? AND bh.datetime < (? + INTERVAL 1 DAY))"],
            [$store, "AND p.store_id = ?"],
            [$category, "AND p.category = ?"],
            [$type, "AND p.type = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$first_date, $last_date, $store, $category, $type];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

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
    
    public function read_id_store($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["id", "id"],
            ["name", "name"],
            ["timezone", "timezone"]
        ];
        $sql_table = "FROM `id_store`";
        $sql_where = [
            [$search, "AND `name` LIKE ?"]
        ];
        $sql_group = "ORDER BY `id` ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search];
        $sql_conn = $db_tenant;
        $results = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        foreach($results->getResult('array') as $row){
            $data[] = $row;
        }
        
        $final = array("status" => true, "data" => $data, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function read_category_product($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM `category_product` cp";
        $sql_where = [
            [$search, "AND cp.name LIKE ?"]
        ];
        $sql_group = "GROUP BY cp.id ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search];
        $sql_conn = $db_tenant;
        $results_count = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results_count->getNumRows();
        if($limit == "" || $limit == null || $paging_num == "" || $paging_num == null){
            $paging['total-paging'] = "";
            $paging['start-from'] = "";
        }
        else{
            $paging['total-paging'] = ceil($paging['total-record'] / $limit);
            $paging['start-from'] = ($paging_num-1) * $limit;
        }
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["cp.id", "id"],
            ["cp.name", "name"]
        ];
        $sql_table = "FROM `category_product` cp";
        $sql_where = [
            [$search, "AND cp.name LIKE ?"]
        ];
        $sql_group = "GROUP BY cp.id ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results_data = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results_data->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
    
    public function read_type_product($post){
        //ambil helper untuk mengambil database
        helper('dynamicdb');
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $search = "%".$post['search']."%";
        $limit = $post['limit'];
        $paging_num = $post['paging_num'];
        
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["COUNT(*)", "count"]
        ];
        $sql_table = "FROM `category_product` cp";
        $sql_where = [
            [$search, "AND cp.name LIKE ?"]
        ];
        $sql_group = "GROUP BY cp.name ASC";
        $sql_limit = ["",""];
        $sql_execute = [$search];
        $sql_conn = $db_tenant;
        $results_count = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        //dapatkan jumlah
        $paging = [];
        $paging['total-record'] = $results_count->getNumRows();
        if($limit == "" || $limit == null || $paging_num == "" || $paging_num == null){
            $paging['total-paging'] = "";
            $paging['start-from'] = "";
        }
        else{
            $paging['total-paging'] = ceil($paging['total-record'] / $limit);
            $paging['start-from'] = ($paging_num-1) * $limit;
        }
        
        //query initialization
        $sql_header = "SELECT";
        $sql_column = [
            ["tp.id", "id"],
            ["tp.name", "name"],
            ["tp.image_url", "image_url"]
        ];
        $sql_table = "FROM `type_product` tp";
        $sql_where = [
            [$search, "AND tp.name LIKE ?"]
        ];
        $sql_group = "GROUP BY tp.name ASC";
        $sql_limit = [$paging['start-from'],$limit];
        $sql_execute = [$search, $paging['start-from'], $limit];
        $sql_conn = $db_tenant;
        $results_data = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);

        foreach($results_data->getResult('array') as $row)
        {
           $data[] = $row;
        }
        
        if($data != null){
            $array_keys = array_keys($data[0]);
        }
        
        $final = array("status" => true, "data" => $data, "paging" => $paging, "header" => $array_keys, "notf" => "none", "redir" => "none");
        return json_encode($final);
    }
}