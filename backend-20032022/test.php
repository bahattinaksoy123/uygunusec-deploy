<?php
header('Access-Control-Allow-Origin: *');
$serverName = "94.138.203.200";
$dBUserName = "root2";
$dBPassword = "uygunusecmysql";
$dBName = "uygunusec";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName );

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo json_encode($_COOKIE["idToken"]);

?>