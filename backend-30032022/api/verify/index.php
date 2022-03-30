

<?php
header('Access-Control-Allow-Origin: *');
require_once('../../services/users.php');
require_once '../call-api.php';
require_once __DIR__.'/../../db/index.php';
$logo_file_path = __DIR__.'/../../static/images/logo.jpeg';
function exitMessage(){
    $message = "Linki Kontrol ediniz";
    die("<script type='text/javascript'>alert('$message');</script>");
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

        $result_message = "Email Adresiniz Dogrulaniyor";
          ob_end_flush();
          ob_implicit_flush();
          for ($i = 1; $i < 3; $i++)
          {
            echo "
        <html>
        <head>
        <title>Uygunusec</title>
        <style type='text/css'>
        
        body{
            margin-top: 200px;
            text-align: center;
            margin-left:50px;
            marrin-right:50px;
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
        
        <div>
        ";
        if($i==1){
            echo "<img style='width:250px;' src='../../logo.jpeg' />";
        }
        echo "<h2> $result_message...</h2>";
        echo "</div>
        
        </body>
        
        </html>
        \n";
        if($i==1){
            $result = verifyAndCreateUser($oob_code );
        
            if($result['email_verified']){
                if($result['user_created']){
                
                $result_message  = "Mailiniz Doğrulanmıştır <br> Ana Sayfaya Yonlendiriliyorsunuz... ";
                $home_page = "http://uygunusec.com/controlza/";
                // echo "<script type='text/javascript'>alert('$navigate');</script>";
                // header("Location: $home_page");
                echo "<script>
                setTimeout(() => {
                    window.location.href='$home_page';
                }, 3000);

                </script>";
                }
                else{
                $result_message = 'Kullanıcı Oluşturulamadı!!';
                }
            }
            else{
            $result_message = "Mail Doğrulanamadı <br> <h3> Mailinizi daha önceden doğrulamış olabilirsiniz ya da linkin süresi geçmiş olabilir<br> <a href='http://uygunusec.com/controlza/'>uygunusec.com</a> üzerinden tekrar giriş yaparak gerekiyorsa yeni bir doğrulama maili alabilirsiniz!!</h3>";
            }
        }
    }
        

    }
    else{
        exitMessage();
    }
    
}
else{
    $resp = ['error'=>'no-support', 'status'=>'405'];
    die(json_encode($resp, true));
}
?>


