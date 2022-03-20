<?php
require_once '../call-api.php';

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


?>