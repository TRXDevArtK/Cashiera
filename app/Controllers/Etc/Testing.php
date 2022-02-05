<?php

//tempat file ini sekarang
namespace App\Controllers\Etc;

//controller yang mau digunakan
use App\Controllers\Extension\BaseController;
use CodeIgniter\I18n\Time;

class Testing extends BaseController
{
    public function index()
    {
        //cek error
        ini_set('display_errors', 1);
        $session = session();
        
        //FUNGSI UMUM
        //
        //Fungsi ambil post/get/dll , JANGAN LUPA!
        $request = \Config\Services::request();

        //Ambil model
        //Catatan : ini bisa ngambil di public function (disini) jika dibuat
        //Tapi itu harus enable auto routing . . 
        $TestingModel = new \App\Models\Etc\TestingModel();
        
        $terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(isset($_POST['ajaxtest'])){
            try
            {
                $abc = $post['aa'];
            }
            catch (\Exception $e)
            {
                return print_r("eyyy");
            }
        }
        
        if(isset($_POST['uploadtest'])){
            $post = $request->getPost();
            $files = $request->getFiles();
            $data = $TestingModel->uploadtest($post, $files);
            
            return print_r($data);
        }
        
        if(isset($_POST['alltest'])){
            $post = array("search"=>"");
            $data = $TestingModel->alltest($post);
            return $data;
        }
        
        if(isset($_POST['create_product'])){
            $post = array("code"=>"1126", "name"=>"generated", "category"=>"1", "brand"=>"gene");
            $data = $TestingModel->create_product($post);
            
            return $data;
        }
        
        if(isset($_POST['update_product'])){
            $post = array("username"=>"admin", "password"=>"12345", "key"=>"admin", "save"=>"1");
            $data = $TestingModel->update_product($post);
            
            return $data;
        }
        
        if(isset($_POST['AuthModel-login'])){
            $post = array("username"=>"admin", "password"=>"12345", "key"=>"admin", "save"=>"1");
            $data = $TestingModel->AuthModel_login($post);
            
            return $data;
        }
        
        if(isset($_POST['AuthModel-register'])){
            $post = [
                "no-hp"=>"085266771122", 
                "email"=>"refaldi@gmail.com",
                "username"=>"1113e", 
                "password"=>"aadsdas",
                "conf-password"=>"aadsdas",
                "key"=>"1122j",
                "conf-key"=>"1122j",
                "robot-check"=>"false"
                ];
            $data = $TestingModel->AuthModel_register($post);
            
            return $data;
        }
        
        if(isset($_POST['json-array'])){
            $arr = array("kuy" => "sek", "dor" => "det");
            return json_encode($arr);
        }
        
        if(isset($_POST['now-datetime'])){
            helper('datetime');
            return timeset('now', 'UTC');
        }
        
        if(isset($_POST['login'])){
            $post = [
                "username"=>"admin", 
                "password"=>"12345",
                "key"=>"admin"
                ];
            $data = $TestingModel->login($post);
            
            return $data;
        }
        
        if(isset($_POST['ResultsModel_overall_results'])){
            $post = [
                "first_date"=>"2021-1-28", 
                "last_date"=>"2021-9-28",
                "filter_store"=>"1", 
                "filter_category"=>"1",
                "filter_type"=>"1",
                ];
            $data = $TestingModel->ResultsModel_overall_results($post);
            
            return $data;
        }
        
        if(isset($_POST['FiltersModel_get_list_toko'])){
            $post = ["search"=>"1"];
            $data = $TestingModel->FiltersModel_get_list_toko($post);
            return $data;
        }
        
        if(isset($_POST['get_product_results'])){
            $post = [
                "first_date"=>"2021-1-28", 
                "last_date"=>"2021-5-28",
                "filter_store"=>"1", 
                "filter_category"=>"1",
                "filter_type"=>"1",
                "search"=>"",
                "limit"=>"20",
                "paging_num"=>"1"
                ];
            
            $data = $TestingModel->get_product_results($post);
            return $data;
        }
        
        if(isset($_POST['ResultsModel_get_selling_results'])){
            $post = [
                "first_date"=>"2021-1-28", 
                "last_date"=>"2021-5-28",
                "filter_store"=>"null", 
                "filter_category"=>"null",
                "filter_type"=>"null",
                "search"=>"",
                "limit"=>"3",
                "paging_num"=>"1"
                ];
            
            $data = $TestingModel->ResultsModel_get_selling_results($post);
            return $data;
        }
        
        if(isset($_POST['testdb1'])){
            $post = [
                "first_date"=>"null", 
                "last_date"=>"null",
                "filter_store"=>"null", 
                "filter_category"=>"null",
                "filter_type"=>"",
                "search"=>"",
                "limit"=>"20",
                "paging_num"=>"0"
                ];
            $data = $TestingModel->testdb1($post);
            return $data;
        }
        
        if(isset($_POST['ResultsModel_get_buying_results'])){
            $post = [
                "first_date"=>"2021-1-28", 
                "last_date"=>"2021-5-28",
                "filter_store"=>"1", 
                "filter_category"=>"1",
                "filter_type"=>"1",
                "search"=>"",
                "limit"=>"3",
                "paging_num"=>"1"
                ];
            $data = $TestingModel->ResultsModel_get_buying_results($post);
            return $data;
        }
        
        if(isset($_POST['PagingModel_get_paging_config'])){
            $post = [
                "first_date"=>"2021-4-21", 
                "last_date"=>"2021-4-30",
                "filter_store"=>"1", 
                "filter_category"=>"1",
                "filter_type"=>"1",
                "search"=>"",
                "limit"=>"1"
                ];
            $data = $TestingModel->PagingModel_get_paging_config($post);
            return $data;
        }
        
        
        
        return view('etc/testing_ground');
    }
}
