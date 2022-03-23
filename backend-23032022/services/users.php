<?php
require_once("auth.php");
require_once __DIR__.'/../db/index.php';

function createUser($idToken, $payload){
$firebase_resp = getUserOrError($idToken);
if($firebase_resp == "ERROR"){
    echo "Firebase Error";
    exit();
}
// echo json_encode($firebase_resp,true);
$email = $firebase_resp["email"];
$uid = $firebase_resp["localId"];
// echo "\n";
// echo $email;
// echo "\n";
// echo $uid;
$valid_since = $firebase_resp["validSince"];

$resp = insertUser($uid, $email);
echo json_encode($resp, true);
}

function verifyAndCreateUser($oob_code){
    $result = array ('email_verified' => false, 'user_created' => false);
    $firebase_resp= verifyUser($oob_code);
    echo $firebase_resp;
    if($firebase_resp=='ERROR'){ $result['email_verified'] = false;  }
    else{
        
        if(isset($firebase_resp['emailVerified']) || $firebase_resp['emailVerified']==true){
            $result['email_verified'] = true;

            $email = $firebase_resp["email"];
            $uid = $firebase_resp["localId"];
            $resp = insertUser($uid, $email);
            echo json_encode($resp);
            if ($resp == "SUCCESSFUL"){
                $result['user_created'] = true;
            }
            else{
                $result['user_created'] = false;
            }
        }
        else{
            $result['email_verified'] = false;
        }
    }
    return $result;
}

function getUser($idToken, $payload){
    $firebase_resp = getUserOrError($idToken);
    if($firebase_resp == "ERROR"){
        echo "Firebase Error";
        exit();
    }
   
    $email = $firebase_resp["email"];
    $uid = $firebase_resp["localId"];
    $valid_since = $firebase_resp["validSince"];
    
    $resp = selectUser($uid);
    echo json_encode($resp, true);
    }

?>