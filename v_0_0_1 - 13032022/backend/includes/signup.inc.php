<?php

header('Access-Control-Allow-Origin: *');
// if (isset($_POST["submit"])){
if (true){
    $email = $_POST["email"];
    $password = $_POST["password"];
    // $email = "email";
    // $password = "password";
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // // if(emailInvalid($email) !== false){

    // // }

    if(emailExists($conn, $email) !== false){
        echo json_encode("Email is already exist");
        exit();
    }

    createUser($conn, $email, $password);
}
else{
    header ("location: ../error.php");
    exit();
}