<?php
header('Access-Control-Allow-Origin: *');
require_once('../../services/users.php');
require_once('../../services/admin.php');


// echo json_encode("APi role connected");
if($_SERVER["REQUEST_METHOD"] == "POST"){

}
else if($_SERVER["REQUEST_METHOD"] == "PUT"){
    if(!$_COOKIE["idToken"]){
        echo json_encode("Could not found id!!");
        die();
     }
     $idToken = $_COOKIE["idToken"];
     $data=json_decode(file_get_contents('php://input'),1);
     $payload = $data;
     setServiceProvider($idToken, $payload);
}
else if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "GET METHOD";
}

?>