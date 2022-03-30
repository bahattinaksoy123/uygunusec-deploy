<?php
require_once("auth.php");
require_once __DIR__.'/../db/index.php';

function createUser($idToken, $payload){
    $firebase_resp = getUserOrError($idToken);
    if($firebase_resp == "ERROR"){
        $resp = ['error'=>'firebase-connection', 'status'=>'400'];
        die(json_encode($resp, true));
    }
    // echo json_encode($firebase_resp,true);
    $email = $firebase_resp["email"];
    $uid = $firebase_resp["localId"];
    // echo "\n";
    // echo $email;
    // echo "\n";
    // echo $uid;
    $valid_since = $firebase_resp["validSince"];
    try{
        $data = insertUser($uid, $email);
        if($data[0] == "error"){
            $resp = ['error'=>$data[1], 'status'=>'400'];
            
        }
        else{
            $resp = ['success'=>$data[1], 'status'=>'200'];
        }
    }
    catch(Exception $e){
        $resp = ['error'=>'db-error', 'db-error'=>'400'];
    }
    finally{
        die(json_encode($resp, true));
    }
}

function verifyAndCreateUser($oob_code){
    $result = array ('email_verified' => false, 'user_created' => false);

    $firebase_resp= verifyUser($oob_code);
    if($firebase_resp=='ERROR'){ $result['email_verified'] = false;  }
    else{
        
        if(isset($firebase_resp['emailVerified']) || $firebase_resp['emailVerified']==true){
            $result['email_verified'] = true;

            $email = $firebase_resp["email"];
            $uid = $firebase_resp["localId"];
            $db_resp = insertUser($uid, $email);
            if ($db_resp['status'] == "success"){
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
        $resp = ['error'=>'firebase-connection', 'status'=>'400'];
        die(json_encode($resp, true));
    }
   
    $email = $firebase_resp["email"];
    $uid = $firebase_resp["localId"];
    $valid_since = $firebase_resp["validSince"];
    
    try{
        $data = selectUser($uid);
        if($data[0] == "error"){
            $resp = ['error'=>$data[1], 'status'=>'400'];
            
        }
        else{
            $resp_user = $data[1];
            $user = array("email"=>$resp_user['email'], "role"=>$resp_user['role']);
            $resp = ['success'=>$user, 'status'=>'200'];
        }
    }
    catch(Exception $e){
        $resp = ['error'=>'db-error', 'db-error'=>'400'];
    }
    finally{
        die(json_encode($resp, true));
    }


    }

?>