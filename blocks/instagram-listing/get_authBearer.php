<?php
//deklaration
$clientID = "XXX";
$clientSecret = "XXX";
$redirectURL = "https://xxx.kreativkarussell.dev/wp-content/themes/bergauf/blocks/socialmedia-wall/get_authBearer.php";

//User confirmes action -> extract Token
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($actual_link,'code=') !== false) {

  // extract Token from URL
  $authToken = substr($actual_link, strpos($actual_link, 'code=') +5 );

  //save Token
  file_put_contents("authToken.txt", $authToken);

  //Erfolgsmeldung AuthToken
  echo '<h4>Autorisierungstoken gespeichert!</h4>';
  }

  if(isset($authToken)){
    //exchange AuthToken with AccessToken
    //building query with AuthCode

    $url = 'https://api.instagram.com/oauth/access_token';
    $data = array(
      'client_id' => $clientID,
      'client_secret' => $clientSecret,
      'grant_type' => 'authorization_code',
      'redirect_uri' => $redirectURL,
      'code' => $authToken
    );
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $tmp_accessToken = curl_exec($curl);
    curl_close($curl);

    $tmp_accessToken = json_decode($tmp_accessToken);

    //Erfolgsmeldung ShortlifeToken
    echo '<h4>Kurzlebigen Schlüssel erhalten!</h4>';

    //Abbruch bei Fehler
    if(isset($tmp_accessToken->error_type)){
      echo "<strong> es ist ein Fehler aufgetreten! </strong><br>";

      echo "<strong>Error: </strong>" .$tmp_accessToken->error_message;
      die;
    }
    else if(isset($tmp_accessToken->access_token)) { //Variablendeklaration bei Erfolg
      $shortlifeAccessToken = $tmp_accessToken->access_token;
    }

    //save AccessToken
    file_put_contents("shortlife_accessToken.json", $shortlifeAccessToken);
  }

    //exchange Shortlife AccessToken with Longlife-AccessToken

    if(isset($shortlifeAccessToken)){
    $accessToken = file_get_contents("https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret={$clientSecret}&access_token={$shortlifeAccessToken}");
    file_put_contents("longlife_accessToken.json", $accessToken );
    echo '<h4>Langlebiger Zugriffsschlüssel gespeichert!</h4>';

    echo "<a href='https://xxx.kreativkarussell.dev/wp-content/themes/bergauf/blocks/socialmedia-wall/get_posts.php'> Jetzt neuen Schlüssel testen! </a>";
  }
