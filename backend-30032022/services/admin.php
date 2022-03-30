<?php
require_once("auth.php");
require_once __DIR__.'/../db/index.php';

function setServiceProvider($idToken, $payload){
$firebase_resp = getUserOrError($idToken);

if(!isset($payload['email'])){
    $resp = ['error'=>'invalid-user-email', 'status'=>'400'];
    die(json_encode($resp, true));
}
$email = $payload["email"];

if($firebase_resp == "ERROR"){
    $resp = ['error'=>'firebase-connection', 'status'=>'400'];
    die(json_encode($resp, true));
}
$uid = $firebase_resp["localId"];

$data = selectUser($uid);
if($data[0]=="error"){
    $resp = ['error'=>'db-error', 'status'=>'400'];
    die(json_encode($resp, true));
}
$user = $data[1];

if($user["role"]!="admin"){
    $resp = ['error'=>'no-permission', 'status'=>'403'];
    die(json_encode($resp, true));
}
// echo "\n";
// echo $uid;
// echo "\n";
// echo json_encode($user, true);
$valid_since = $firebase_resp["validSince"];



$data = selectUserWithEmail($email);
$status = $data[0];
$editing_user = $data[1];
if($status != "error"){
    if($editing_user["role"]!="user"){
        $resp = ['error'=>'role-not-user', 'status'=>'403'];
        die(json_encode($resp, true));
    }
    $update_resp = updateRole($email);
    if($update_resp){
        $resp = ['success'=>'role-user-to-serviceprovider', 'status'=>'200'];
        die(json_encode($resp, true));
    }
    else{
        $resp = ['error'=>'db-error', 'status'=>'400'];
        die(json_encode($resp, true));
    }
}
else{
    $resp = ['error'=>'invalid-user-email', 'status'=>'400'];
    die(json_encode($resp, true));
}
// $resp = insertUser($uid, $email);
// echo json_encode($resp, true);
}

?>