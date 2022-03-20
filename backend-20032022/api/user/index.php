<?php
header('Access-Control-Allow-Origin: *');
require_once('../../services/users.php');

// echo json_encode("APi user connected");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!$_COOKIE["idToken"]){
       echo json_encode("Could not found id!!");
       die();
    }
    $idToken = $_COOKIE["idToken"];
    $data=json_decode(file_get_contents('php://input'),1);
    $payload = $data;
    createUser($idToken, $payload);
}
else if($_SERVER["REQUEST_METHOD"] == "PUT"){}
else if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(!$_COOKIE["idToken"]){
        echo json_encode("Could not found id!!");
        die();
    }
    $idToken = $_COOKIE["idToken"];
    $data=json_decode(file_get_contents('php://input'),1);
    $payload = $data;
    getUser($idToken, $payload);
}


?>