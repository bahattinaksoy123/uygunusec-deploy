<?php
// header('Access-Control-Allow-Origin: *');
// $serverName = "localhost";
// $dBUserName = "root";
// $dBPassword = "root";
// $dBName = "root";

$serverName = "94.138.203.200";
$dBUserName = "root2";
$dBPassword = "uygunusecmysql";
$dBName = "uygunusec";

try{
    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName );  
    
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
}
catch(Exception $e){
        $resp = ['error'=>'db-error', 'status'=>'400'];
        die(json_encode($resp, true));
}

