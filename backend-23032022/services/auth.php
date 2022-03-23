<?php
require_once __DIR__.'/../api/firebase/index.php';

function getUserOrError($idToken){
    $resp_data = getFirebaseUser($idToken);
    return  (!$resp_data || isset($resp_data['error']))?"ERROR":$resp_data["users"][0];
}

function verifyUser($oob_code){
    $resp_data = verifyFirebaseUser($oob_code);
    return  (!$resp_data || isset($resp_data['error']))?"ERROR":$resp_data;
}

?>