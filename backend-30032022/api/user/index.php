<?php
header('Access-Control-Allow-Origin: *');
require_once('../../services/users.php');

// echo json_encode("APi user connected");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_COOKIE['idToken'])){
        $resp = ['error'=>'null-id', 'status'=>'401'];
        die(json_encode($resp, true));
    }
    $idToken = $_COOKIE["idToken"];
    $data=json_decode(file_get_contents('php://input'),1);
    $payload = $data;
    createUser($idToken, $payload);
}
else if($_SERVER["REQUEST_METHOD"] == "PUT"){
    $resp = ['error'=>'no-support', 'status'=>'405'];
    die(json_encode($resp, true));
}
else if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(!isset($_COOKIE['idToken'])){
        $resp = ['error'=>'null-idToken', 'status'=>'401'];
        die(json_encode($resp, true));
    }
    $idToken = $_COOKIE["idToken"];
    $data=json_decode(file_get_contents('php://input'),1);
    $payload = $data;
    getUser($idToken, $payload);
}


?>