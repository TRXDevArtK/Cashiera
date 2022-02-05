<?php

    function check_login(){
        //HELPER CEK LOGIN
        //HAPUS INI KALAU MAU DEBUG DI POSTMAN
        //Autoload session
        $session = session();
        if(!isset($_SESSION['login']) && $_SESSION['login'] != 1 && !isset($_SESSION['username'])){
            //Kalau status gk ada, balik ke index
            return false;
        }
        else{
            $now = time();
            if ($now > $_SESSION['expire']) {
                session_destroy();
                return false;
            }
            else{
                return true;
            }
        }
    }

    function logout(){
        $session = session();
        $destroy = session_destroy();
        $unset = session_unset();

        if($destroy == true && $unset == true){
            return true;
        }
        else{
            return false;
        }
    }

    function check_similarity($old, $new, $conf, $config){
        if($config === 'default'){
            if($new === "" || $new === null || $conf === "" || $conf === null){
                return ["status" => true, "data" => "@*ignore*@", "notf" => "Mohon maaf salah satu input harus dimasukkan, silahkan input lagi", "config" => "ignore"];
            }
            else if($new !== $conf){
                return ["status" => false, "data" => "", "notf" => "Mohon maaf data awal tidak sama dengan konfirmasi, silahkan input lagi", "config" => "ignore"];
            }
            if($old === $new){
                return ["status" => true, "data" => "@*ignore*@", "notf" => "data sama / kosong", "config" => "ignore"];
            }
            else{
                return ["status" => true, "data" => $new, "notf"=>"data tidak sama", "config" => ""];
            }
        }
        else if($config === 'hashed'){
            if($new === "" || $new === null || $conf === "" || $conf === null){
                return ["status" => true, "data" => "@*ignore*@", "notf" => "Mohon maaf salah satu input harus dimasukkan, silahkan input lagi", "config" => "ignore"];
            }
            if($new !== $conf){
                return ["status" => false, "data" => "", "notf" => "Mohon maaf data awal tidak sama dengan konfirmasi, silahkan input lagi", "config" => "ignore"];
            }
            $verify = password_verify($new, $old);
            if($verify){
                return ["status" => true, "data" => "@*ignore*@", "notf" => "data sama / kosong", "config" => "ignore"];
            }
            else{
                $password_hash = password_hash($new, PASSWORD_ARGON2ID);
                return ["status" => true, "data" => $password_hash, "notf"=>"data tidak sama", "config" => ""];
            }
        }
    }


