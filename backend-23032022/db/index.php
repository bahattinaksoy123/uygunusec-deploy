<?php
// session_start();
require_once 'dbh.inc.php';

// define('__ROOT__', dirname(dirname(__FILE__)));
// require_once(__ROOT__.'/db/dbh.inc.php');


function selectUser($uid){
    $sql = "SELECT * FROM users WHERE uid = ? ; " ;
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        
        $result_data = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result_data)){
            $result = $row;
        }
        else{
            $result = "ERROR";
        }

    }
    mysqli_stmt_close($stmt);
    return $result;
}

function selectUserWithEmail($email){
    $sql = "SELECT * FROM users WHERE email = ? ; " ;
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        
        $result_data = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result_data)){
            $result = $row;
        }
        else{
            $result = "ERROR";
        }

    }
    mysqli_stmt_close($stmt);
    return $result;
}

function updateRole($email){
    $sql = "UPDATE users SET role = 'servicep'  WHERE email = ? ; " ;
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        

        if(mysqli_stmt_errno($stmt)){
            $result = false;
        }
        else{
            $result = true;
        }

    }
    mysqli_stmt_close($stmt);
    return $result;

}


function uidExist($uid){
    $result = true;
    $sql = "SELECT * FROM users WHERE uid = ? ; " ;
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        
        $result_data = mysqli_stmt_get_result($stmt);

        if(mysqli_fetch_assoc($result_data)){
            $result = true;
        }
        else{
            $result = false;
        }

    }
    mysqli_stmt_close($stmt);
    return $result;
}


function emailExist( $email){
    $result = true;
    $sql = "SELECT * FROM users WHERE email = ? ; " ;
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        
        $result_data = mysqli_stmt_get_result($stmt);

        if(mysqli_fetch_assoc($result_data)){
            $result = true;
        }
        else{
            $result = false;
        }

    }
    mysqli_stmt_close($stmt);
    return $result;
}

function userExist( $uid, $email){
    
    if(emailExist($email) || uidExist($uid)){
        return true;
    }
    else{
        return false;
    }
}

function insertUser($uid, $email){
    if(userExist($uid,$email)==true){
        return "ERROR";
        // echo "email or uid is exis\n";
        // die("died connection");
    }
    $sql = "INSERT INTO users (uid, email, role) VALUES (?, ?, ?) ; " ;
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        return "ERROR";
        // echo json_encode("STMT ERROR");
        // exit();
    }
    else{
        $role = "user";
        mysqli_stmt_bind_param($stmt, "sss", $uid, $email, $role);
        mysqli_stmt_execute($stmt);
        return "SUCCESSFUL";
    }

    mysqli_stmt_close($stmt);
}



// echo "i am in db\n";

?>