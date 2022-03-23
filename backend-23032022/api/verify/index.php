<?php
header('Access-Control-Allow-Origin: *');
require_once('../../services/users.php');
require_once '../call-api.php';
require_once __DIR__.'/../../db/index.php';

function exitMessage(){
    $message = "Linki Kontrol ediniz";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
}
// echo json_encode("APi user connected");
if($_SERVER["REQUEST_METHOD"] == "GET"){    
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
        $url = "https";
    }
    else {$url = "http";}
  
    // Here append the common URL characters.
    $url .= "://";
  
    // Append the host(domain name, ip) to the URL.
    $url .= $_SERVER['HTTP_HOST'];
    
    // Append the requested resource location to the URL
    $url .= $_SERVER['REQUEST_URI'];
    
    $url_components = parse_url($url);
    
    if(isset($url_components['query'])){
        parse_str($url_components['query'], $params);
        
        if(!isset($params['mode']) ||  $params['mode']!="verifyEmail"){exitMessage();}
        if(!isset($params['oobCode'])){exitMessage();}
        if(!isset($params['apiKey']) ||  $params['apiKey']!="AIzaSyAclLtI5T-ssvzr0l4COIjNHbg_e93N7VY"){exitMessage();}
        if(!isset($params['lang']) ||  $params['lang']!="tr"){exitMessage();}
        
        $oob_code = $params['oobCode'];

    ?>
<html>
<head>
<title>Uygunusec</title>
<style type="text/css">

body{
    margin-top: 200px;
    text-align: center;
}

p{
    text-align: center;
}
button{
    text-align: center;
}
</style>
</head>
<body>
<?php
echo "<div>";

echo "<h2>Email Adresiniz Dogrulaniyor...</h2>";

$result_message = verifyAndCreateUser($oob_code);

if($result_message['email_verified']){
if($result_message['user_created']){
echo "<h2>Ana Sayfaya Yonlendiriliyorsunuz</h2>";
$navigate = "Ana Sayfaya Yonlendiriliyorsunuz";
sleep(2);
$home_page = "http://uygunusec.com/controlza/index.html";
echo "<script type='text/javascript'>alert('$navigate');</script>";
header("Location: $home_page");
}
else{
echo "<h2>Kullanici Yaratilamadi!!</h2>";
echo "<button> Tekrar Dene </button>";
}
}
else{
echo "<h2>Email Dogrulanamadi!!!</h2>";
echo "<button> Tekrar Dene </button>";
}
echo "</div>";
?>
 

</body>

</html>
    
    <?php

        // require_once __DIR__.'/../../pages/verify.php';
    }
    else{
        exitMessage();
    }



}
else{
    exitMessage();
}
?>


