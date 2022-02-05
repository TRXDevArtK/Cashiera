<?php

//tempat file ini sekarang
namespace App\Controllers\Homepage;

//controller yang mau digunakan
use App\Controllers\Extension\BaseController;

class Home extends BaseController
{
    
    public function index()
    {    
        //Check login
        helper('auth');
        $login = check_login();
        
        //Inisialisasi request
        $request = \Config\Services::request();

        //Ambil model
        $AuthModel = new \App\Models\Homepage\AuthModel();
            
        //Sanitize request post yg masuk ke controller
        $terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_SPECIAL_CHARS);
        
        //Jika terdeteksi post === '' maka ambil requestnya dan kirim ke model
        //Nanti jika proses selesai, maka return data dari model
        //
        if(isset($terms) && $terms == 'login'){
            $post = $request->getPost();
            $data = $AuthModel->login($post);
            
            return $data;
        }
        
        if(isset($terms) && $terms == 'register'){
            $post = $request->getPost();
            $data = $AuthModel->register($post);
            
            return $data;
        }

        //Masukkan title halaman saat ini
        //dan data jika sudah login
        $data['title'] = "Homepage";
        $data['login'] = $login;
        
        //Tambahkan view beserta datanya
        return view('homepage/pages/index', $data);
    }
}
