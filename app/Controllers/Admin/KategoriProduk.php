<?php

//tempat file ini sekarang
namespace App\Controllers\Admin;

//controller yang mau digunakan
use App\Controllers\Extension\BaseController;

class KategoriProduk extends BaseController
{
    public function index()
    {
        //Check login
        helper('auth');
        $login = check_login();
        if($login == false){
            return redirect()->to(base_url().'/');
        }
        
        //Inisialisasi request
        $request = \Config\Services::request();

        //Ambil model
        $ReadModel = new \App\Models\Admin\ReadModel();
        $UpdateModel = new \App\Models\Admin\UpdateModel();
        $CreateModel = new \App\Models\Admin\CreateModel();
        $DeleteModel = new \App\Models\Admin\DeleteModel();
        
        //Sanitize request post yg masuk ke controller
        $terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_SPECIAL_CHARS);
        
        //Jika terdeteksi post === '' maka ambil requestnya dan kirim ke model
        //Nanti jika proses selesai, maka return data dari model
        //
        if(isset($terms) && $terms === 'delete_category_product'){
            $post = $request->getPost();
            $data = $DeleteModel->delete_category_product($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms === 'create_category_product'){
            $post = $request->getPost();
            $data = $CreateModel->create_category_product($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms === 'update_category_product'){
            $post = $request->getPost();
            $data = $UpdateModel->update_category_product($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms === 'read_category_product'){
            $post = $request->getPost();
            $data = $ReadModel->read_category_product($post);
            
            return $data;
        }
        
        //Masukkan title halaman saat ini
        $data['title'] = "Kategori";
        
        //Tambahkan view beserta datanya
        return view('admin/pages/kategori_produk', $data);
    }
}