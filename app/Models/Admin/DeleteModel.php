<?php
 
namespace App\Models\Admin;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class DeleteModel extends Model
{
    public function delete_role($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $id_length = count($id);
        
        //query builder
        for($i = 0;$i<$id_length;$i++){
            $sql_header = "DELETE FROM";
            $sql_table = "role";
            $sql_where = [
                [$id[$i], "AND `role`.`id` = ?"]
            ];
            $sql_conn = $db_tenant;
            $sql_execute = [$id[$i]];
            $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        }
        
        if($results){
            $final = array("status" => true, "notf" => "Data jabatan sudah di hapus", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function delete_user_login($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $db_id = $_SESSION['d_id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        $db_server = \Config\Database::connect(db_dynamic('cashiera_server', 'localhost', 'root', ''));
        
        //drop database
        $results = $db_tenant->query("DROP DATABASE $db_name");
        
        if($results){
            //do nothing
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        //delete id from id_auth
        $sql_header = "DELETE FROM";
        $sql_table = "id_auth";
        $sql_where = [
            [$db_id, "AND `id_auth`.`id` = ?"]
        ];
        $sql_conn = $db_server;
        $sql_execute = [$db_id];
        $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        
        if($results){
            $final = array("status" => true, "notf" => "Data user sudah di hapus", "redir" => base_url("/dashboard/logout"));
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function delete_type_product($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $id_length = count($id);
        
        //query builder
        for($i = 0;$i<$id_length;$i++){
            $sql_header = "DELETE FROM";
            $sql_table = "type_product";
            $sql_where = [
                [$id[$i], "AND `type_product`.`id` = ?"]
            ];
            $sql_conn = $db_tenant;
            $sql_execute = [$id[$i]];
            $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        }
        
        if($results){
            $final = array("status" => true, "notf" => "Data toko sudah di hapus", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function delete_category_product($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $id_length = count($id);
        
        //query builder
        for($i = 0;$i<$id_length;$i++){
            $sql_header = "DELETE FROM";
            $sql_table = "category_product";
            $sql_where = [
                [$id[$i], "AND `category_product`.`id` = ?"]
            ];
            $sql_conn = $db_tenant;
            $sql_execute = [$id[$i]];
            $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        }
        
        if($results){
            $final = array("status" => true, "notf" => "Data toko sudah di hapus", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function delete_users($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $id_length = count($id);
        
        //query builder
        for($i = 0;$i<$id_length;$i++){
            $sql_header = "DELETE FROM";
            $sql_table = "users";
            $sql_where = [
                [$id[$i], "AND `users`.`id` = ?"]
            ];
            $sql_conn = $db_tenant;
            $sql_execute = [$id[$i]];
            $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        }
        
        if($results){
            $final = array("status" => true, "notf" => "Data toko sudah di hapus", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function delete_store($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $id_length = count($id);
        
        //query builder
        for($i = 0;$i<$id_length;$i++){
            $sql_header = "DELETE FROM";
            $sql_table = "id_store";
            $sql_where = [
                [$id[$i], "AND `id_store`.`id` = ?"]
            ];
            $sql_conn = $db_tenant;
            $sql_execute = [$id[$i]];
            $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        }
        
        if($results){
            $final = array("status" => true, "notf" => "Data toko sudah di hapus", "redir" => "none");
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function delete_product($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb', 'datetime']);
        
        $username = $_SESSION['username'];
        $id_user = $_SESSION['u_id'];
        $db_name = $_SESSION['db_name'];
        $db_hostname = $_SESSION['db_hostname'];
        $db_username = $_SESSION['db_username'];
        $db_password = $_SESSION['db_password'];
        
        $id = $post['id'];
        
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $db_hostname, $db_username, $db_password));
        
        $id_length = count($id);
        
        //query builder
        for($i = 0;$i<$id_length;$i++){
            $sql_header = "DELETE FROM";
            $sql_table = "product";
            $sql_where = [
                [$id[$i], "AND `product`.`id` = ?"]
            ];
            $sql_conn = $db_tenant;
            $sql_execute = [$id[$i]];
            $results = db_delete_builder($sql_header, $sql_table, $sql_where, $sql_execute, $sql_conn);
        }
        
        if($results){
            $final = array("status" => true, "notf" => "Data produk sudah di hapus", "redir" => base_url('/'));
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Terjadi kesalahan server, silakan coba lagi", "redir" => "none");
            return json_encode($final);        }

    }
}