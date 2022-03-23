<?php

function callAPI($method, $url, $headers,  $payload){

   $ch = curl_init();


    switch ($method){
       case "POST":
          curl_setopt($ch, CURLOPT_POST, true);
          if ($payload)
             curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
          break;
       case "PUT":
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($payload)
             curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
          break;
       default:
         //  if ($data)
         //     $url = sprintf("%s?%s", $url, http_build_query($data));
         break;
    }

    // OPTIONS:
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // TODO ARASTIR
   //for debug only!
   // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   //  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    
    $resp = curl_exec($ch);
    curl_close($ch);
    if(!$resp){ return NULL;}
    else{
      $data = json_decode($resp, true);
      return $data;
   }
 }

 ?>