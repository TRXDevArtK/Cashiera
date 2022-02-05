<?php
use CodeIgniter\Database\Query;

    function db_dynamic($db_name, $hostname, $username, $password){
        $db_dynamic = [
            'DSN'      => '',
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'database' => $db_name,
            'DBDriver' => 'MySQLi'
        ];
        
        return $db_dynamic;
    }
    
    function string_random($string) {
        $pattern = "sxxkaj1829381";
        $text = strstr(strtolower($string), $pattern, true);
        $nrRand = rand(1111, 2047483648);
        $final = trim($text).trim($nrRand);
        return $final;
    }
    
    function uuidv4(){
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
      );
    }
    
    function db_upload_builder($location, $file, $old_url){
        //location (auto)
        //file (auto)
        //old_file_name (auto)
        
        //get file name
        $file_name = $file->getName();
        
        if($file_name === "" || $file_name === null){
            return $old_url;
        }
        
        //anything if failed
        $empty = "";
        
        //this is for image that have same name with upload rand name
        $file_extension = $file->guessExtension();
        $file_with_path = $location.$file_name;
        $file_size = filesize($file);
        
        //rand
        $rand_name = uuidv4().".".$file_extension;
        
        //this as sql image url if success later
        $file_with_rand = $location.$rand_name;
        
        //check if name same with upload file
        if(file_exists($file_with_path)){
            //permis, no need ?
            //chmod($file_with_path,0755);
            
            $file_size_temp = filesize($file_with_path);
            
            if($file_size == $file_size_temp){
                return $file_with_path;
            }
            else{
                if(unlink($file_with_path)){
                //do nothing
                }
                else{
                    return $empty;
                }
            }
        }
        
        //check if name same with old url provided
        if($old_url == null || $old_url == ""){
            // do nothing
        }
        else{
            if(file_exists($old_url)){
                //permis, no need ?
                //chmod($file_with_path,0755);
                
                $file_size_temp = filesize($old_url);
                
                if($file_size == $file_size_temp){
                    return $old_url;
                }
                else{
                    if(unlink($old_url)){
                    //do nothing
                    }
                    else{
                        return $empty;
                    }
                }
            }
        }
        
        //proceed
        if($file->isValid() && ! $file->hasMoved()){
            $file->move($location, $rand_name);
        }
        
        if($file->hasMoved()){
            return $file_with_rand;
        }
        else{
            return $empty;
        }
    }
    
    function db_delete_builder($header, $table, $where, $execute, $conn){
        //header (auto)
        //table (auto)
        
        //where process start
        $where_length = count($where);
        $where_query = "";
        for($i = 0;$i < $where_length;$i++){
            if($where[$i][0] === "" || $where[$i][0] === null || $where[$i][0] === "%%" || $where[$i][0] === "null" || $where[$i][0] === "nullnull"){
                $where[$i][1] = "";
            }
            else{
                $where_query .= $where[$i][1]." ";
            }
        }
        
        if($where_query === "" || $where_query === null){
            return ["status" => false, "notf" => "Kesalahan data, silahkan coba lagi nanti"];
        }
        else{
            //remove end space
            $where_query = substr($where_query,0,-1);

            //get the first world (and / or)
            $first_word = str_word_count($where_query, 1);

            //count first word
            $count_first = strlen($first_word[0]);

            //cut associate with count first
            $where_query = substr($where_query,$count_first);

            //prepend where
            $where_query = "WHERE".$where_query;
        }
        
        $all_query = $header." ".$table." ".$where_query;
        
        //initialization on query
        $init_sql['query'] = $all_query;
        $init_sql['db'] = $conn;
        
        //check if no execute (bind-param) then do normal query
        if(empty($execute)){
            $results = $init_sql['db']->query($init_sql['query']);
        }
        //else then use prepare
        else{
            $pQuery = $init_sql['db']->prepare(function($init_sql){
                $sql = $init_sql['query'];

                return (new Query($init_sql['db']))->setQuery($sql);
            }, $init_sql);

            $results = $pQuery->execute(...$execute);
            
            //tutup db sebelumnya
            $pQuery->close();
        }
        
        return $results;
    }
    
    function db_create_builder($header, $table, $insert, $execute, $conn){
        //header (auto)
        //table (auto)
        
        $insert_length = count($insert);
        $insert_head = "";
        $insert_body = "";
        for($i = 0;$i < $insert_length;$i++){
            $insert_head .= $insert[$i][0].", ";
            $insert_body .= "?, ";
        }
        //remove end space
        $insert_head = substr($insert_head,0,-2);
        $insert_head = "(".$insert_head.")";
        
        $insert_body = substr($insert_body,0,-2);
        $insert_body = "(".$insert_body.")";
        
        $all_query = $header." ".$table." ".$insert_head." VALUES ".$insert_body;
        
        //initialization on query
        $init_sql['query'] = $all_query;
        $init_sql['db'] = $conn;
        
        //check if no execute (bind-param) then do normal query
        if(empty($execute)){
            $results = $init_sql['db']->query($init_sql['query']);
        }
        //else then use prepare
        else{
            $pQuery = $init_sql['db']->prepare(function($init_sql){
                $sql = $init_sql['query'];

                return (new Query($init_sql['db']))->setQuery($sql);
            }, $init_sql);

            $results = $pQuery->execute(...$execute);
            
            //tutup db sebelumnya
            $pQuery->close();
        }
        
        return $results;
    }
    
    function db_update_builder($header, $table, $set, $where, $execute, $conn){
        //header (auto)
        //table (auto)
        //execute (auto)
        
        //set process start
        $set_length = count($set);
        $set_query = "";
        for($i = 0;$i < $set_length;$i++){
            if($set[$i][2] == 'ignore'){
                //this is for special case
            }
            else{
                $set_query .= $set[$i][1].", ";
            }
        }
        
        if($set_query === "" || $set_query === null){
            return ["status" => false, "notf" => "Seluruh input kosong dalam back-end, mohon diisi"];
        }
        else{
            //remove end space
            $set_query = substr($set_query,0,-2);
            $set_query = "SET ".$set_query;
        }
        //set process end
        
        //where process start
        $where_length = count($where);
        $where_query = "";
        for($i = 0;$i < $where_length;$i++){
            if($where[$i][0] === "" || $where[$i][0] === null || $where[$i][0] === "%%" || $where[$i][0] === "null" || $where[$i][0] === "nullnull"){
                $where[$i][1] = "";
            }
            else{
                $where_query .= $where[$i][1]." ";
            }
        }
        
        if($where_query === "" || $where_query === null){
            return ["status" => false, "notf" => "Persyaratan update harus ada, mohon dipenuhi"];
        }
        else{
            //remove end space
            $where_query = substr($where_query,0,-1);

            //get the first world (and / or)
            $first_word = str_word_count($where_query, 1);

            //count first word
            $count_first = strlen($first_word[0]);

            //cut associate with count first
            $where_query = substr($where_query,$count_first);

            //prepend where
            $where_query = "WHERE".$where_query;
        }
        //where process end
        
        //all query process start
        $all_query = $header." ".$table." ".$set_query." ".$where_query;
        //all query process end
        
        //execute filtering process start
        $execute_length = count($execute);
        $execute_builder = [];
        for($i = 0;$i < $execute_length;$i++){
            if($execute[$i] == '@*ignore*@'){
                //do nothing
            }
            else{
                $execute_builder[] = $execute[$i];
            }
        }
        //execute filtering process end
        
        //initialization on query
        $init_sql['query'] = $all_query;
        $init_sql['db'] = $conn;
        
        //check if no execute (bind-param) then do normal query
        if(empty($execute)){
            $results = $init_sql['db']->query($init_sql['query']);
        }
        //else then use prepare
        else{
            $pQuery = $init_sql['db']->prepare(function($init_sql){
                $sql = $init_sql['query'];

                return (new Query($init_sql['db']))->setQuery($sql);
            }, $init_sql);

            $results = $pQuery->execute(...$execute_builder);
            
            //tutup db sebelumnya
            $pQuery->close();
        }
        
        return $results;
    }
    
    function db_read_builder($header, $column, $table, $where, $group, $limit, $execute, $conn){
        //header (auto)
        
        //column process start
        $column_length = count($column);
        $column_query = "";
        for($i = 0;$i < $column_length;$i++){
            $column_query .= $column[$i][0]." as "."'".$column[$i][1]."' ,";
        }
        
        $column_query = substr($column_query,0,-2);
        //column process end
        
        //where process start
        $where_length = count($where);
        $where_length_fix = 0;
        for($i = 0;$i < $where_length;$i++){
            if($where[$i][0] === "" || $where[$i][0] === null || $where[$i][0] === "%%" || $where[$i][0] === "null" || $where[$i][0] === "nullnull"){
                // do nothing
            }
            else{
                $where_length_fix += 1;
            }
        }
        
        if($where_length_fix == 0){
            $where_query = "";
        }
        else{
            $where_query = "";
            for($i = 0;$i < $where_length;$i++){
                if($where[$i][0] === "" || $where[$i][0] === null || $where[$i][0] === "%%" || $where[$i][0] === "null" || $where[$i][0] === "nullnull"){
                    $where[$i][1] = "";
                }
                else{
                    $where_query .= $where[$i][1]." ";
                }
            }
            
            //remove end space
            $where_query = substr($where_query,0,-1);
            
            //get the first world (and / or)
            $first_word = str_word_count($where_query, 1);
            
            //count first word
            $count_first = strlen($first_word[0]);
            
            //cut associate with count first
            $where_query = substr($where_query,$count_first);
            
            //prepend where
            $where_query = "WHERE".$where_query;
        }
        //where process ends
        
        //limit process start
        $limit_query = "LIMIT ?,?";
        if(($limit[0] === "" || $limit[0] === null || $limit[0] === "%%") && ($limit[1] === "" || $limit[1] === null || $limit[1] === "%%")){
            $limit_query = "";
        }
        //limit process end
        
        //merge all process start
        $all_query = $header." ".$column_query." ".$table." ".$where_query." ".$group." ".$limit_query;
        //merge all process end
        
        //execute filtering process start
        $execute_length = count($execute);
        $execute_builder = [];
        for($i = 0;$i < $execute_length;$i++){
            if($execute[$i] === "%%" || $execute[$i] === null || $execute[$i] === "" || $execute[$i] === "null" || $execute[$i] === "nullnull"){
                //do nothing
            }
            else{
                $execute_builder[] = $execute[$i];
            }
        }
        //execute filtering process end
        
        //initialization on query
        $init_sql['query'] = $all_query;
        $init_sql['db'] = $conn;
        
        //check if no execute (bind-param) then do normal query
        if(empty($execute_builder)){
            $results = $init_sql['db']->query($init_sql['query']);
        }
        //else then use prepare
        else{
            $pQuery = $init_sql['db']->prepare(function($init_sql){
                $sql = $init_sql['query'];

                return (new Query($init_sql['db']))->setQuery($sql);
            }, $init_sql);

            $results = $pQuery->execute(...$execute_builder);
            
            //tutup db sebelumnya
            $pQuery->close();
        }
        
        //result is final
        return $results;
    }
    
    function db_create_tenant($db_name, $hostname, $username, $password){
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $hostname, $username, $password));
        
        //buat database user
        $tenant = $db_tenant->query('CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(16) NOT NULL,
            `password` char(110) NOT NULL,
            `email` varchar(256) DEFAULT NULL,
            `phone` varchar(20) DEFAULT NULL,
            `role` int(11) NOT NULL,
            `id_store` int(11) NOT NULL,
            `full_name` varchar(64) NOT NULL,
            `call_name` varchar(16) DEFAULT NULL,
            `status` int(2) NOT NULL,
            `salary` decimal(10,2) DEFAULT NULL,
            `image_url` varchar(256) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`)
            )');
        
        //buat database type_product
        $type_product = $db_tenant->query('CREATE TABLE `type_product` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(16) NOT NULL,
            `image_url` varchar(256) DEFAULT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database selling_history
        $selling_history = $db_tenant->query('CREATE TABLE `selling_history` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `datetime` datetime NOT NULL,
            `capital` decimal(10,2) NOT NULL,
            `profit` decimal(10,2) NOT NULL,
            `report` varchar(256) DEFAULT NULL,
            `pricing_report` decimal(10,2) DEFAULT NULL,
            `amount` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `teller` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database role
        $role = $db_tenant->query('CREATE TABLE `role` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(16) NOT NULL,
            `owner` tinyint(1) NOT NULL,
            `delete_self` tinyint(1) NOT NULL,
            `delete_other` tinyint(1) NOT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database report
        $report = $db_tenant->query('CREATE TABLE `report` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(16) NOT NULL,
            `description` varchar(256) NOT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database product
        $product = $db_tenant->query('CREATE TABLE `product` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `code` varchar(16) NOT NULL,
            `name` varchar(32) NOT NULL,
            `category` int(11) NOT NULL,
            `brand` varchar(32) NOT NULL,
            `desc` varchar(256) NOT NULL,
            `type` int(11) NOT NULL,
            `stock` int(11) NOT NULL,
            `id_store` int(11) NOT NULL,
            `capital` decimal(10,2) NOT NULL,
            `profit_min` decimal(10,2) NOT NULL,
            `profit_max` decimal(10,2) NOT NULL,
            `discount` int(3) DEFAULT NULL,
            `weight` decimal(10,2) DEFAULT NULL,
            `bundling` int(11) NOT NULL,
            `stats` int(11) NOT NULL,
            `inputter` varchar(16) DEFAULT NULL,
            `receipt` tinyint(1) NOT NULL,
            `latest_data` datetime NOT NULL,
            `image_url` varchar(256) DEFAULT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database id_store
        $id_store = $db_tenant->query('CREATE TABLE `id_store` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(32) DEFAULT NULL,
            `location` varchar(84) DEFAULT NULL,
            `config` int(1) NOT NULL,
            `color` varchar(8) NOT NULL,
            `logo` varchar(256) DEFAULT NULL,
            `print_logo` varchar(256) DEFAULT NULL,
            `print_msg` varchar(32) DEFAULT NULL,
            `mode` tinyint(1) NOT NULL,
            `timezone` varchar(20) NOT NULL,
            `latest_data` datetime DEFAULT NULL,
            `image_url` varchar(256) DEFAULT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database category_product
        $category_product = $db_tenant->query('CREATE TABLE `category_product` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(16) NOT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database buying_history
        $buying_history = $db_tenant->query('CREATE TABLE `buying_history` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `datetime` datetime NOT NULL,
            `profit_min` decimal(10,2) NOT NULL,
            `profit_max` decimal(10,2) NOT NULL,
            `capital` decimal(10,2) NOT NULL,
            `amount` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `teller` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database bundling
        $bundling = $db_tenant->query('CREATE TABLE `bundling` (
            `id` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `profit_max` decimal(10,2) NOT NULL,
            `name` varchar(32) NOT NULL,
            `amount` int(11) NOT NULL,
            `status` int(1) NOT NULL,
            PRIMARY KEY (`id`)
            )');
        
        //buat database overall_result
        $overall_result = $db_tenant->query('CREATE TABLE `overall_result` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `buy_latest_fetch` datetime DEFAULT NULL,
            `sell_latest_fetch` datetime DEFAULT NULL,
            `total_sales` decimal(10,2) DEFAULT NULL,
            `total_capital` decimal(10,2) DEFAULT NULL,
            `selling_number` int(11) DEFAULT NULL,
            `total_profit` decimal(10,2) DEFAULT NULL,
            PRIMARY KEY (`id`)
            )');
        
        if($tenant == true && $type_product == true && $selling_history == true 
            && $role == true && $report == true && $product == true && $id_store == true && $category_product == true
            && $buying_history == true && $bundling == true && $overall_result == true){
            return true;
        }
        else{
            return false;
        }
    }
    
    function db_create_data_tenant($db_name, $hostname, $username, $password){
        //database tenant
        $db_tenant = \Config\Database::connect(db_dynamic($db_name, $hostname, $username, $password));
        
        //create sample data
        $create_role_owner = $db_tenant->query("INSERT INTO `role` (`id`, `name`, `owner`, `delete_self`, `delete_other`) "
                . "VALUES (NULL, 'Owner', '1', '1', '1')");
        $create_role_employee = $db_tenant->query("INSERT INTO `role` (`id`, `name`, `owner`, `delete_self`, `delete_other`) "
                . "VALUES (NULL, 'Karyawan', '0', '0', '0')");
        $create_category = $db_tenant->query("INSERT INTO `category_product` (`id`, `name`) VALUES (NULL, 'catg_sample_1')");
        $create_type = $db_tenant->query("INSERT INTO `type_product` (`id`, `name`, `image_url`) VALUES (NULL, 'type_sample_1', NULL)");
        $create_id_store = $db_tenant->query("INSERT INTO `id_store` "
                . "(`id`, `name`, `location`, `config`, `color`, `logo`, `print_logo`, `print_msg`, `mode`, `timezone`, `latest_data`, `image_url`) "
                . "VALUES (NULL, 'toko_sample_1', NULL, '1', '#ff5959', NULL, NULL, NULL, '0', 'UTC', '2021-05-28 08:58:13.000000', NULL)");
        
        if($create_role_owner == true && $create_role_employee == true && $create_category == true && $create_type == true && $create_id_store == true){
            return true;
        }
        else{
            return false;
        }
    }
?>

