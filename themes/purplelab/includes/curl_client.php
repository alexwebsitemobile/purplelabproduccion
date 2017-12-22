<?php

function callApi($user, $passwd) {
    $url = 'https://rr.purplelab.com/index.php/userapi/login';
    $curl = curl_init($url);
    $curl_post_data = array(
        "username" => $user,
        "password" => $passwd,
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    $curl_response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $respuesta = parseLoginResponse($curl_response, $http_status);
    return $respuesta;
}

function createUser($username, $email, $passwd, $firstname, $lastname, $phone, $company, $annualrevenue, $token) {
    $url = 'https://rr.purplelab.com/index.php/userapi/create_user';
    $curl = curl_init($url);
    $curl_post_data = array(
        "username" => $username,
        "email" => $email,
        "password" => $passwd,
        "first_name" => $firstname,
        "last_name" => $lastname,
        "contact_phone" => $phone,
        "company" => $company,
        "annualrevenue" => $annualrevenue,
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization:  ' . $token));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    $curl_response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo $http_status;
    curl_close($curl);
    if ($http_status == 400) {
        $respuesta = parseUserResponse($curl_response, $http_status);
    } else {
        $respuesta = parseUserResponse($curl_response, $http_status);
    }

    return $respuesta;
}

function parseUserResponse($curl_response, $http_status) {
    $arr = json_decode($curl_response, true);
    if ($http_status == 204) {
        return NULL;
    } else if ($http_status == 400) {
        return $arr['error'];
    } else {
        return 'ok';
    }
}

function parseLoginResponse($curl_response, $http_status) {
    $arr = json_decode($curl_response, true);
    // var_dump($arr);
    if ($http_status == 200) {
        return $arr;
        /* echo $arr['user']['first_name'];
          echo "<br>";
          echo $arr['user']['last_name'];
          echo "<br>";
          $token = $arr['token_id'];
          if(!isNullOrEmptyString($token)){
          echo "Token is not null <br> " . $token;
          } */
    } else {
        return $arr;
        //echo $arr['error'][0];
    }
}

function isValidToken($token) {
    $url = 'https://rr.purplelab.com/index.php/userapi/is_valid_token';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_GET, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('token:  ' . $token));
    $curl_response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if ($http_status == 200) {
        $respuesta = 'ok';
    } else {
        $respuesta = 'error';
    }
    $respuesta = parseUserResponse($curl_response, $http_status);
    return $respuesta;
}



function agreeHubspot($email, $firstname, $lastname, $phone, $company, $annualrevenue, $pagename, $url_form) {
    //Process a new form submission in HubSpot in order to create a new Contact.
unset($_COOKIE['hubspotutk']);
    $hubspotutk = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
    $ip_addr = $_SERVER['REMOTE_ADDR']; //IP address too.
    $hs_context = array(
        'hutk' => $hubspotutk,
        'ipAddress' => $ip_addr,
        'pageUrl' => 'https://www.purplelab.com/sign-up/',
        'pageName' => $pagename
    );
    $hs_context_json = json_encode($hs_context);

    $str_post = "firstname=" . urlencode($firstname)
            . "&lastname=" . urlencode($lastname)
            . "&email=" . urlencode($email)
            . "&phone=" . urlencode($phone)
            . "&company=" . urlencode($company)
            . "&annualrevenue=" . urlencode($annualrevenue)
            . "&hs_context=" . urlencode($hs_context_json);
    $endpoint = 'https://forms.hubspot.com/uploads/form/v2/2686874/' . $url_form;

    $ch = @curl_init();
    @curl_setopt($ch, CURLOPT_POST, true);
    @curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
    @curl_setopt($ch, CURLOPT_URL, $endpoint);
    @curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded'
    ));
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = @curl_exec($ch); //Log the response from HubSpot as needed.
    $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
    @curl_close($ch);
    //echo $status_code . " " . $response;
}

function isNullOrEmptyString($message) {
    return (!isset($message) || trim($message) === '');
}
?>
