<?php
require_once __DIR__.'/../call-api.php';

function getFirebaseUser($idToken){
    $url = "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=AIzaSyAclLtI5T-ssvzr0l4COIjNHbg_e93N7VY";
    $headers = array(
        "Content-Type: application/json"
     );
    $token = $idToken;
    $payload = json_encode( array( "idToken"=> $token ) );
    $data = callAPI("POST", $url, $headers,  $payload);
    return $data;
}

function verifyFirebaseUser($oob_code){
    $firebase_verify_url = "https://identitytoolkit.googleapis.com/v1/accounts:update?key=AIzaSyAclLtI5T-ssvzr0l4COIjNHbg_e93N7VY";
    $headers = array(
        "Content-Type: application/json"
        );
    $payload = json_encode( array( "oobCode"=> $oob_code ) );
    $firebase_resp = callAPI("POST", $firebase_verify_url, $headers,  $payload);
    return $firebase_resp;
}


?>