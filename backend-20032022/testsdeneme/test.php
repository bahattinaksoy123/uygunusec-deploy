<?php

    $url = "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=AIzaSyAclLtI5T-ssvzr0l4COIjNHbg_e93N7VY";
    $headers = array(
        "Content-Type: application/json"
     );
    $token = "eyJhbGciOiJSUzI1NiIsImtpZCI6ImYxZDU2YTI1MWU0ZGRhM2Y0NWM0MWZkNWQ0ZGEwMWQyYjlkNzJlMGQiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiQmFoYXR0aW4gQUtTT1kiLCJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZW51eWd1bnVzZWMiLCJhdWQiOiJlbnV5Z3VudXNlYyIsImF1dGhfdGltZSI6MTY0NzQzMjcyNSwidXNlcl9pZCI6ImRtaFVNcEJnOFBkZjMxSW04RVNONDJ2cHk4ajEiLCJzdWIiOiJkbWhVTXBCZzhQZGYzMUltOEVTTjQydnB5OGoxIiwiaWF0IjoxNjQ3NDM5ODU5LCJleHAiOjE2NDc0NDM0NTksImVtYWlsIjoidmlydHVhbHVzZXJ4QGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJmaXJlYmFzZSI6eyJpZGVudGl0aWVzIjp7ImVtYWlsIjpbInZpcnR1YWx1c2VyeEBnbWFpbC5jb20iXX0sInNpZ25faW5fcHJvdmlkZXIiOiJwYXNzd29yZCJ9fQ.j2NvFOw72GnXrW91vBXbE0MzMIWLGQaZ1CNQ-rS0uqnXFJhZXiYtGuwBUp33QiUp8C3TH8lqepocLzFU-7T4hTUT4X0jtACezF0V4mX4Ka7EqBRRExMRTYGwVkEXwSIvp6hXyFS0C6DNkY_WjVk_jsxKQQWJS8KeZiobCerZDE1v7MZKp_8hcCS9OcFDS9KxrjDh_8jgotMigR_xC4hSo0e_AbzSUN39RJtw277D9U4zfVsSsNQ8EWHjc25uEV8lYzcVcDITJkO4AoId6QU9FJooK3w2jriROk3hxKhh9FN53jDjduVkQ2Wc6FZksZWjh0zVIKaZdGSAROMvhKSSWA";
    $payload = json_encode( array( "idToken"=> $token ) );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // for debug only!
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($ch);
    // TODO return mu iyi die mi?
    // if(!$resp){die("Connection Failure");}
    curl_close($ch);
    $data = json_decode($resp, true);
    $user = $data["users"][0];
    echo json_encode($user);

?>