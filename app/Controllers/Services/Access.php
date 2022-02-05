<?php

//tempat file ini sekarang
namespace App\Controllers\Services;

//controller yang mau digunakan
use App\Controllers\Extension\BaseController;
use CodeIgniter\Database\Query;

class Access extends BaseController
{
    public function index()
    {    
        //Inisialisasi request
        $request = \Config\Services::request();
        
        //Ambil model
        $ServicesModel = new \App\Models\Services\ServicesModel();
            
        //Sanitize request post yg masuk ke controller
        $terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_SPECIAL_CHARS);
        
        //Jika terdeteksi post === '' maka ambil requestnya dan kirim ke model
        //Nanti jika proses selesai, maka return data dari model
        //
        if(isset($terms) && $terms == 'login'){
            $post = $request->getPost();
            $data = $ServicesModel->login($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms == 'read_table_data'){
            $post = $request->getPost();
            $data = $ServicesModel->read_table_data($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms == 'read_latest_table_data'){
            $post = $request->getPost();
            $data = $ServicesModel->read_latest_table_data($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms == 'create_selling_history'){
            $post = $request->getPost();
            $data = $ServicesModel->create_selling_history($post);
            
            return $data;
        }
        
        //Jika tidak ada post maka jangan tampilkan apa apa
        return false;
    }
}
