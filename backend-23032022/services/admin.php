<?php
require_once("auth.php");
require_once __DIR__.'/../db/index.php';

function setServiceProvider($idToken, $payload){
$firebase_resp = getUserOrError($idToken);
if($firebase_resp == "ERROR"){
    echo json_encode("Firebase ERROR");
    die();
}


$uid = $firebase_resp["localId"];
$user = selectUser($uid);
if($user["role"]!="admin"){
    echo json_encode("No permisson");
    die();
}
// echo "\n";
// echo $uid;
// echo "\n";
// echo json_encode($user, true);
$valid_since = $firebase_resp["validSince"];

$email = $payload["email"];

$editing_user = selectUserWithEmail($email);
if($editing_user != "ERROR"){
    if($editing_user["role"]!="user"){
        echo json_encode("No permisson");
        die();
    }
    $update_resp = updateRole($email);
    if($update_resp){
        echo json_encode("\nUser is now a service provider");
    }
    else{
        echo json_encode("\nCould not updated Data");
    }
}
else{
    echo json_encode("\nEmail is not exisit");
}
// $resp = insertUser($uid, $email);
// echo json_encode($resp, true);
}

?>