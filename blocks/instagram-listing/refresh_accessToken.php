#!/usr/bin/php81
<?php
/*----------- Access Token Automatic refresh -----------*/
$filename = __DIR__ . "/longlife_accessToken.json";
$website = "www.domain.de";
$emailFrom = "From: Instagram Wall <info@kreativkarussell.de>";
$empfaenger = "ef@kreativkarussell.de, cw@kreativkarussell.de";
$betreff = $website." Instagram Sider";
$emailText;
$fehlerDatei=false;
$fehlerAllgemein = false;
$fehlerNachricht = __DIR__ . "/refresh_accessToken.php";
$longliveToken;
$strdate;
$timestamp;
$timestampPlus60;
$verbleibeneTage;
$sucess = false;

/*----------- Datei auslesen && Timestamp abfragen && Timestamp + 60 Tage -----------*/
if (file_exists($filename)) {
    $fileContent = file_get_contents($filename);
    $content = json_decode($fileContent, true);
    $longliveToken = $content["access_token"];
    $timestamp = date("d.m.Y", filemtime($filename));
    $strdate = strtotime($timestamp);
    $timestampPlus60 = date("d.m.Y", strtotime("+60 day", $strdate));

    /*----------- Ablauf des Tokens abfragen -----------*/

    $verbleibeneTage = restTage(date("d.m.Y"),$timestampPlus60,"dmY",".");
    echo $verbleibeneTage. " Tage Verbleiben <br>";

    /*----------- Token updaten -----------*/

    if($verbleibeneTage <= 5){
        //Update
        $accessToken = file_get_contents("https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=".$longliveToken);
        if(strpos($accessToken, 'access_token') !== false && strpos($accessToken, 'token_type') !== false && strpos($accessToken, 'expires_in') !== false)
            {
                file_put_contents($filename, $accessToken );
                $sucess = true;
            }
            else
            {
                $fehlerAllgemein = true;
            }
    }else{
        //noch Aktuell
        echo "Token noch Aktuell<br>";
    }

}else{
    $fehlerDatei = true;
}

/*----------- Fehler abfragen -----------*/
if($fehlerDatei != true){
    if($fehlerAllgemein != true){
        if($sucess !=false){
            echo "Success!";
            $emailText = "Gute Nachrichten! Der Instagram Slider Token von " . $website . " wurde erfolgreich geupdatet!";
            mail($empfaenger, $betreff, $emailText, $emailFrom);
        }
    }else{
        echo "Fehler bitte &Uuml;berpr&uuml;fen!";
        $emailText = "Schlechte Nachrichten! Der Instagram Slider Token von " . $website . " wurde NICHT  geupdatet!<br> Bitte umgehend Pr&uuml;fen!<br><br>".$fehlerNachricht;
        $betreff = "Error bei ".$website." Instagram Sider";
        mail($empfaenger, $betreff, $emailText, $emailFrom);
    }
}else{
    echo "Fehler Datei existiert nicht!";
    $emailText = "Schlechte Nachrichten! Der Instagram Slider Token von " . $website . " wurde NICHT geupdatet!<br> Die Datei " . $filename . " wurde nicht gefunden!<br>Bitte umgehend Pr&uuml;fen!";
    $betreff = "Error bei ".$website." Instagram Sider";
    mail($empfaenger, $betreff, $emailText, $emailFrom);
}
/*----------- Rest Tage Berechnen -----------*/
function restTage($begin, $end, $format, $sep){

    $pos1 = strpos($format, 'd');
    $pos2 = strpos($format, 'm');
    $pos3 = strpos($format, 'Y');

    $begin = explode($sep,$begin);
    $end = explode($sep,$end);

    $first = GregorianToJD($end[$pos2],$end[$pos1],$end[$pos3]);
    $second = GregorianToJD($begin[$pos2],$begin[$pos1],$begin[$pos3]);

    if($first > $second)
        return $first - $second;
    else
        return $second - $first;

    }
?>
