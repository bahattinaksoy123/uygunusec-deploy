<?php
$url = $_SERVER['REQUEST_URI'];
if($_SERVER["REQUEST_METHOD"] == "POST"){    
    $resp = ['error'=>'no-support', 'status'=>'405'];
    die(json_encode($resp, true));}
else if($_SERVER["REQUEST_METHOD"] == "PUT"){    
    $resp = ['error'=>'no-support', 'status'=>'405'];
    die(json_encode($resp, true));}
else if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "<div style='text-align:center;'><a href='https://controlza.net/'>controlza.net</a></div>";}
?>