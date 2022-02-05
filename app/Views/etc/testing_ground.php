<?php
//    $first_date = "2021-01-21";
//    $last_date = "2021-05-21";
//    $conn = new mysqli('localhost','root','','tenant_1111');
//    $query = "SELECT COUNT(*) AS count FROM selling_history sh "
//            . "LEFT JOIN product p ON sh.product_id = p.id "
//            . "LEFT JOIN product_location pl ON pl.product_id = sh.product_id "
//            . "WHERE (sh.datetime >= ? AND sh.datetime < (? + INTERVAL 1 DAY)) AND pl.store_id = 1 AND p.category = 1 AND p.type = 1";
//    $sql_run = mysqli_prepare($conn, $query);
//    mysqli_stmt_bind_param($sql_run, "ss", $first_date, $last_date);
//    mysqli_stmt_execute($sql_run);
//    $result = mysqli_stmt_get_result($sql_run);
//    $row = mysqli_fetch_assoc($result);
//    
//    print_r($row);
// Filtering the array
//$array = array("apple" => "eyy", "sus" => "");
//var_dump($array);
//echo "<br>";
// 
//// Filtering the array
//$result = array_filter($array);                 
//var_dump($result);

//function strin_random($string) {
//    $pattern = "sxxkaj1829381";
//    $firstPart = strstr(strtolower($string), $pattern, true);
//    $nrRand = rand(1111, 2047483648);
//    $username = trim($firstPart).trim($nrRand);
//    return $username;
//}
//
//echo "random username ".strin_random("1");
//
//echo password_hash("admin" ,PASSWORD_ARGON2ID);
//
// echo print_r($_SESSION);
//
//echo base_url("resources/pages/filters.js");
use CodeIgniter\Database\Query;
use CodeIgniter\I18n\Time;
helper('dynamicdb');

$db_tenant = \Config\Database::connect(db_dynamic('tenant_1694033084', 'localhost', 'root', ''));

//initialization on query
$init_sql['query'] = "SELECT r.id as 'id' ,r.name as 'name' ,r.owner as 'owner' ,r.delete_self as 'delete_self' ,r.delete_other as 'delete_other' FROM `role` r WHERE id != 1 GROUP BY `r`.`name` ASC LIMIT ?,?";
$init_sql['db'] = $db_tenant;

$pQuery = $init_sql['db']->prepare(function($init_sql){
  $sql = $init_sql['query'];

  return (new Query($init_sql['db']))->setQuery($sql);
}, $init_sql);

$results = $pQuery->execute('0', '20');

//tutup db sebelumnya
$pQuery->close();
?>

<html>
    <head>
        <script src="resources/jquery/jquery.js"></script>
        <!--extension datatables-->
        <link rel="stylesheet" href="resources/extension/datatables/datatables.min.css"/>
        <script defer src="resources/extension/datatables/datatables.min.js"></script>
        
        <link rel="stylesheet" href="resources/collapsible/collapsible.css"/>
        <style>
            .btn-dropdown-2 {
              background-color: #4CAF50;
              color: white;
              padding: 16px;
              font-size: 16px;
              border: none;
              cursor: pointer;
            }

            .btnORcnv-dropdown-2:hover, .btnORcnv-dropdown-2:focus {
              background-color: #3e8e41;
            }

            .inp-dropdown-text-1 {
              box-sizing: border-box;
              /*background-image: url('searchicon.png');*/
              background-position: 14px 12px;
              background-repeat: no-repeat;
              font-size: 16px;
              padding: 14px 20px 12px 45px;
              border: none;
              border-bottom: 1px solid #ddd;
            }

            .inp-dropdown-text-1:focus {outline: 3px solid #ddd;}

            .btnORcnv-dropdown-2 {
              position: relative;
              display: inline-block;
            }

            .btn-dropdown-cont-2 {
              display: none;
              position: absolute;
              background-color: #f6f6f6;
              min-width: 230px;
              overflow: auto;
              border: 1px solid #ddd;
              z-index: 1;
            }

            .btn-dropdown-cont-a-2 {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }

            .btn-dropdown-cont-a-2:hover {background-color: #ddd;}
        </style>
    </head>
    <body>
        <form method="post" id="uup" action="<?= current_url(); ?>">
          <input type="submit" name="AuthModel-login" value="AuthModel-login">
          <input type="submit" name="AuthModel-register" value="AuthModel-register">
          <input type="submit" name="now-datetime" value="now-datetime">
          <input type="submit" name="json-array" value="json-array">
          <input type="submit" name="ResultsModel_overall_results" value="ResultsModel_overall_results">
          <input type="submit" name="FiltersModel_get_list_toko" value="FiltersModel_get_list_toko">
          <input type="submit" name="ResultsModel_get_selling_results" value="ResultsModel_get_selling_results">
          <input type="submit" name="ResultsModel_get_buying_results" value="ResultsModel_get_buying_results">
          <input type="submit" name="PagingModel_get_paging_config" value="PagingModel_get_paging_config">
          <input type="submit" name="testdb1" value="testdb1">
          <input type="submit" name="login" value="login">
          <input type="submit" name="get_product_results" value="get_product_results">
          <input type="submit" name="update_product" value="update_product">
          <input type="submit" name="create_product" value="create_product">
          <input type="submit" id="ajaxtest" name="ajaxtest" value="ajaxtest">
          <input type="submit" name="alltest" value="alltest">
        </form>
        
        <form method="post" id="testcheckupload" action="<?= current_url(); ?>" enctype="multipart/form-data">
            <input type="file" name="userfile"/>
            <input type="submit" id="uploadtest" name="uploadtest" value="uploadtest">
        </form>
        <br>
        
        <div class="btnORcnv-dropdown-2">
            <button id="btn-dropdown-2" class="btn-dropdown-2">Dropdown</button>
            <div id="btn-dropdown-cont-2" class="btn-dropdown-cont-2">
                <input type="text" placeholder="Search.." id="inp-dropdown-text-1" class="inp-dropdown-text-1">
                <a class="btn-dropdown-cont-a-2" data-value="about" href="#about/">About</a>
                <a class="btn-dropdown-cont-a-2" data-value="base" href="#base/">Base</a>
                <a class="btn-dropdown-cont-a-2" data-value="blog" href="#blog/">Blog</a>
                <a class="btn-dropdown-cont-a-2" data-value="contact" href="#contact">Contact</a>
                <a class="btn-dropdown-cont-a-2" data-value="custom" href="#custom">Custom</a>
                <a class="btn-dropdown-cont-a-2" data-value="support" href="#support">Support</a>
                <a class="btn-dropdown-cont-a-2" data-value="tools" href="#tools">Tools</a>
            </div>
        </div>
        <br>
        
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                </tr>
                <tr>
                    <td>Cedric Kelly</td>
                    <td>Senior Javascript Developer</td>
                    <td>Edinburgh</td>
                    <td>22</td>
                    <td>2012/03/29</td>
                    <td>$433,060</td>
                </tr>
                <tr>
                    <td>Airi Satou</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>33</td>
                    <td>2008/11/28</td>
                    <td>$162,700</td>
                </tr>
                <tr>
                    <td>Brielle Williamson</td>
                    <td>Integration Specialist</td>
                    <td>New York</td>
                    <td>61</td>
                    <td>2012/12/02</td>
                    <td>$372,000</td>
                </tr>
                <tr>
                    <td>Herrod Chandler</td>
                    <td>Sales Assistant</td>
                    <td>San Francisco</td>
                    <td>59</td>
                    <td>2012/08/06</td>
                    <td>$137,500</td>
                </tr>
            </tbody>
        </table>
        
        <h2>Animated Collapsibles</h2>

        <p>A Collapsible:</p>
        <button class="clps-1">Open Collapsible</button>
        <div class="clps-content-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>

        <p>Collapsible Set:</p>
        <button class="clps-1">Open Section 1</button>
        <div class="clps-content-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <button class="clps-1">Open Section 2</button>
        <div class="clps-content-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <button class="clps-1">Open Section 3</button>
        <div class="clps-content-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>


        <script src="resources/collapsible/collapsible.js"></script>
        <script>
        $(document).ready(function(){
            
//            $("#ajaxtest").on("click", function(event){
//                event.stopPropagation();
//                event.preventDefault();
//                $.ajax({
//                    url:"<?= current_url()?>",
//                    method:"POST",
//                    dataType: 'json',
//                    cache: false,
//                    data:{
//                        abc:'abc',
//                        terms:"ajaxtest"
//                    },
//                    success:function(data){
//                        alert("suecces");
//                    },
//                    error: function(jqXHR, textStatus, errorThrown) {
//                        console.log(JSON.stringify(jqXHR));
//                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
//                    }
//                });
//            });
            
            //datatables
            $('#example').DataTable( {
                "paging":   true,
                "ordering": true,
                "info":     true
            } );
            
            //THIS IS MODAL TYPE 1//////////////////

            var modal1 = $("#modal-1");
            var modalBtn1 = $("#modal-btn-1");
            var modalClose1 = $("#modal-close-1");
            var modalContent1 = $("#modal-content-1");

            modalBtn1.on("click", function() {
              modal1.show();
            });

            modalClose1.on("click", function() {
              modal1.hide();
            });

            $(document).mouseup(function(e){
                if (!modalContent1.is(e.target) && modalContent1.has(e.target).length === 0) 
                {
                    modal1.hide();
                }
            });
            
            //clickable dropdown
            $('#btn-dropdown-2').on('click', function(){
                $('#btn-dropdown-cont-2').toggle();
            });

            $('#inp-dropdown-text-1').on('keyup', function(){
                var input = $('#inp-dropdown-text-1');
                var value = input.val().toLowerCase();
                var dropDownList = $('#btn-dropdown-cont-2 .btn-dropdown-cont-a-2');
                dropDownList.filter(function(){
                    var tos = $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
            $('.btn-dropdown-cont-a-2').on('click', function(){
               var getValue = $(this).data();
               $('#inp-dropdown-text-1').val(getValue['value']);
            });
           
            
        });
        </script>
    </body>
</html>