<?php 
header('Access-Control-Allow-Origin: *');
// function inputCheck(){
//     if( !preg_match("")  )
// }

// function emailInvalid($email){

//     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//         return true;
//     }

// }

function emailExists($conn, $email){
    $result;
    $sql = "SELECT * FROM users WHERE email = ? ; " ;
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        
        $result_data = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result_data)){
            return $row;
        }
        else{
            return false;
        }

    }

    mysqli_stmt_close($stmt);
}

function createUser ($conn, $email , $password){
    echo "<script> console.log('askjdks'); </script>";
    $sql = "INSERT INTO users (email, password) VALUES (?, ?) ; " ;
    $stmt = mysqli_stmt_init($conn);
    echo "<script> console.log('askjdks'); </script>";
    $x = mysqli_stmt_prepare($stmt, $sql);
    echo "<script> console.log('askjdks'); </script>";
    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        echo json_encode("STMT ERROR");
        exit();
    }
    else{

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
        mysqli_stmt_execute($stmt);
        header ("location: ../login.php");
        
    }

    mysqli_stmt_close($stmt);
}