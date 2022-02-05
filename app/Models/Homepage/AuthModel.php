<?php
 
namespace App\Models\Homepage;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;

class AuthModel extends Model
{
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
            
        //jika benar maka buat session dan set return true;
        if(password_verify($password, $data[0]['password'])){
            $session = session();
            $_SESSION['u_id'] = $data[0]['id'];
            $_SESSION['d_id'] = $id;
            $_SESSION['db_name'] = $db_name;
            $_SESSION['db_hostname'] = $db_hostname;
            $_SESSION['db_username'] = $db_username;
            $_SESSION['db_password'] = $db_password;
            $_SESSION['username'] = $data[0]['call_name'];
            $_SESSION['login'] = true;
            $_SESSION['start'] = time();
            
            if(isset($_POST['save'])){
                $_SESSION['expire'] = $_SESSION['start'] + (1 * 24 * 60 * 60 );
            }
            else{
                $_SESSION['expire'] = $_SESSION['start'] + (180 * 60);
            }
            
            $final = array("status" => true, "data" => null, "notf" => "Login berhasil, mohon tunggu", "redir" => base_url("/dashboard/laporan-keseluruhan"));
            return json_encode($final);
        } 
        else{
            $final = array("status" => false, "data" => null, "notf" => "Maaf data login salah, silahkan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
    
    public function register($post){
        //ambil helper untuk mengambil database
        helper(['dynamicdb','datetime']);

        //data post
        $phone = $post['phone'];
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
        
        //password hash
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);
        
        //default value
        $id = NULL;
        $role = '1'; 
        $id_store = '1';
        $status = '1';
        $image_url = NULL;
        $full_name = $username;
        $call_name = $username;
        $salary = "0";
        $time = timeset('now', 'UTC');
        
        //database server
        $db_server = \Config\Database::connect(db_dynamic('cashiera_server', 'localhost', 'root', ''));
        
        //check key if already in table
        $sql_header = "SELECT";
        $sql_column = [
            ["ia.key", "key"]
        ];
        $sql_table = "FROM `id_auth` ia";
        $sql_where = [
            [$key, "AND ia.key = ?"]
        ];
        $sql_group = "";
        $sql_limit = ["",""];
        $sql_execute = [$key];
        $sql_conn = $db_server;
        $results_check_key = db_read_builder($sql_header, $sql_column, $sql_table, $sql_where, $sql_group, $sql_limit, $sql_execute, $sql_conn);
        
        if($results_check_key->getNumRows() > 0){
            $final = array("status" => false, "notf" => "Maaf key sudah ada, silahkan input yang lain", "redir" => "none");
            return json_encode($final);
        }
        
        $db_name = "tenant_".string_random($key);
        
        //input id_auth
        $sql_header = "INSERT INTO";
        $sql_table = "`id_auth`";
        $sql_insert = [
            ['`id`', $id],
            ['`key`', $key],
            ['`last_login`', $time],
            ['`first_login`', $time],
            ['`db_name`', $db_name],
            ['`db_hostname`', "localhost"],
            ['`db_username`', "root"],
            ['`db_password`', ""],
        ];
        $sql_execute = [$id, $key, $time, $time, $db_name, "localhost", "root", ""];
        $sql_conn = $db_server;
        $results_input_id_auth = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        if($results_input_id_auth){
            //do nothing
        }
        else{
            $final = array("status" => false, "notf" => "sepertinya ada kesahalan server database, mohon coba lagi", "redir" => "none");
            return json_encode($final); 
        }
        
        $db_hostname = "localhost";
        $db_username = "root";
        $db_password = "";
        
        //last inserted auto increment key
        $last_inserted_id = $sql_conn->insertID();
        
        //create database
        $forge = \Config\Database::forge();
        $create_db = $forge->createDatabase($db_name);
        if($create_db == true){
            //lanjut
        }
        else{
            $final = array("status" => false, "notf" => "sepertinya ada kesahalan server database, mohon coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        //create all needed table
        $db_create = db_create_tenant($db_name, 'localhost', 'root', '');
        if($db_create == true){
            //lanjut
        }
        else{
            $final = array("status" => false, "notf" => "sepertinya ada kesahalan server database, mohon coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        //create sample data
        $db_create_sample = db_create_data_tenant($db_name, 'localhost', 'root', '');
        
        if($db_create_sample == true){
            //lanjut
        }
        else{
            $final = array("status" => false, "notf" => "sepertinya ada kesahalan server database, mohon coba lagi", "redir" => "none");
            return json_encode($final);
        }
        
        //ambil db tenant sesuai db name
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, "localhost", "root", ""));
        
        //insert user according to register before
        $sql_header = "INSERT INTO";
        $sql_table = "`users`";
        $sql_insert = [
            ['`id`', $id],
            ['`username`', $username],
            ['`password`', $password_hash],
            ['`email`', $email],
            ['`phone`', $phone],
            ['`role`', $role],
            ['`id_store`', $id_store],
            ['`full_name`', $full_name],
            ['`call_name`', $call_name],
            ['`status`', $status],
            ['`salary`', $salary]
        ];
        $sql_execute = [$id, $username, $password_hash, $email, $phone, $role, $id_store, $full_name, $call_name, $status, $salary];
        $sql_conn = $db_tenant;
        $results_input_users = db_create_builder($sql_header, $sql_table, $sql_insert, $sql_execute, $sql_conn);
        
        $last_inserted_user_id = $sql_conn->insertID();
        
        if($results_input_users){
            
            //start set session for login
            $session = session();
            $_SESSION['u_id'] = $last_inserted_user_id;
            $_SESSION['d_id'] = $last_inserted_id;
            $_SESSION['username'] = $call_name;
            $_SESSION['db_name'] = $db_name;
            $_SESSION['db_hostname'] = $db_hostname;
            $_SESSION['db_username'] = $db_username;
            $_SESSION['db_password'] = $db_password;
            $_SESSION['login'] = true;
            $_SESSION['start'] = time();
            
            if(isset($_POST['save'])){
                $_SESSION['expire'] = $_SESSION['start'] + (1 * 24 * 60 * 60 );
            }
            else{
                $_SESSION['expire'] = $_SESSION['start'] + (180 * 60);
            }
            
            $final = array("status" => true, "notf" => "registrasi berhasil, anda akan login, mohon tunggu sebentar", "redir" => base_url("/dashboard/laporan-keseluruhan"));
            return json_encode($final);
        }
        else{
            $final = array("status" => false, "notf" => "Username sudah ada atau kesalahan server, silahkan coba lagi", "redir" => "none");
            return json_encode($final);
        }
    }
}

