<?php

//tempat file ini sekarang
namespace App\Controllers\Admin;

//controller yang mau digunakan
use App\Controllers\Extension\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        //Ambil helper auth
        helper('auth');
        
        //lakukan proses logout
        $session_dest = logout();
        
        //Jika true maka logout, jika tidak maka kembali
        if($session_dest = true){
            $data['notf'] = "Berhasil Logout, anda akan di redirect ke homepage";
            $data['redir'] = base_url("/");
        }
        else{
            $data['notf'] = "Gagal Logout, anda akan di redirect kembali";
            $data['redir'] = base_url("dashboard/laporan-keseluruhan");
        }
        
        //Tambahkan view beserta datanya
        return view('admin/pages/logout', $data);
    }
}
