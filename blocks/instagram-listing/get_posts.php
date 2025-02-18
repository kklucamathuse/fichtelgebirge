#!/usr/bin/php81
<?php
include __DIR__. "/refresh_accessToken.php";
//DEV MODE (unterdrückt E-Mail Versand und Fehlermeldungen)
$dev_mode = false;
//Archive Mode (Speichert alle Beiträge in einem Archiv Ordner (Sortiert nach Jahren))
$arch_mode = false;
//Qualität der webp Bilder
$quality = 85;
//Ordner des Blocks
$ordner = "/wp-content/themes/bergauf/blocks/instagram-wall/";

if($_SERVER["REMOTE_ADDR"] == '130.180.64.138' && $dev_mode == true){
	echo "der Entwicklermodus ist aktiviert. <strong> Mailing ist deaktiviert </strong><br>";
}

//ziehe Access Token aus .json
$filename = __DIR__.'/longlife_accessToken.json';

if (file_exists($filename)) {
    $filecontent = file_get_contents($filename);
    $content = json_decode($filecontent);
		$longLife_accessToken = $content->access_token;
		//Error Handling
		if(!isset($longLife_accessToken)){
			echo "Der Schlüssel existiert nicht <br>";
			if($dev_mode == false){
				sendErrorMail();
			}
		}

} else {
    echo "Die Datei existiert nicht <br>";
		if($dev_mode == false){
			sendErrorMail();
		}
}
	########################################################################################################################
	/*
	New Posts
	*/
	########################################################################################################################
	if(!file_exists(__DIR__."/img")){
		mkdir(__DIR__."/img", 0777);
	}
	$id_posts = array();
	$result_new = array();
	$url = "https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token=".$longLife_accessToken;
	$json = fetchMediaDataByToken($url);
	$result = json_decode($json, true);
	foreach ($result["data"] as $beitrag) {
		$url = $beitrag["media_url"];
		echo("<pre>");
		var_dump($beitrag);
		echo("</pre>");
		if ($beitrag["media_type"] == "VIDEO"){
			if(!file_exists(__DIR__."/img/".$beitrag["id"].".webp")){
				$url_video = $beitrag["thumbnail_url"];
				$image = imagecreatefromjpeg($url_video);
				imagewebp($image, __DIR__."/img/".$beitrag["id"].".webp", $quality);
				imagedestroy($image);
			}
		}else
		{
			if(!file_exists(__DIR__."/img/".$beitrag["id"].".webp")){
			$image = imagecreatefromjpeg($url);
			imagewebp($image, __DIR__."/img/".$beitrag["id"].".webp", $quality);
			imagedestroy($image);
			}
		}
		$id_posts[] = $beitrag["id"].".webp";
		$beitrag["pic_url"] = $ordner. "img/" .$beitrag["id"].".webp";
		array_push($result_new, $beitrag);
	}
	$json = json_encode($result_new);
	echo("test");
	file_put_contents(__DIR__.'/instagram.json', $json);
	$excist_posts = scandir(__DIR__."/img");

	$old_posts = array_diff($excist_posts, $id_posts);
	if(!empty($old_posts)){
		foreach($old_posts as $post){
			if($post !== "." && $post !== ".."){
				unlink(__DIR__."/img/".$post);
			}
		}
	}
	########################################################################################################################
	/*
	Archive
	*/
	########################################################################################################################
	if($arch_mode == true){
		$result_all = array();
		do{
			if(empty($result_archive["paging"]["next"])){
				$url = "https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token=".$longLife_accessToken;
			}else{
				$url = $result_archive["paging"]["next"];
			}
			$json = fetchMediaDataByToken($url);
			$result_archive = json_decode($json, true);
			if(!file_exists(__DIR__."/archive")){
				mkdir(__DIR__."/archive", 0777);
			}
			foreach ($result_archive["data"] as $beitrag) {
				$url = $beitrag["media_url"];
				$date = strtotime($beitrag["timestamp"]);
				$timestamp = date('Y', $date);
				if(!file_exists(__DIR__."/archive/".$timestamp)){
					mkdir(__DIR__."/archive/". $timestamp, 0777);
				}
				if (strpos($url, ".mp4") !== false){
					if(!file_exists(__DIR__."/archive/". $timestamp."/".$beitrag["id"].".webp")){
						$url_video = $beitrag["thumbnail_url"];
						$image = imagecreatefromjpeg($url_video);
						imagewebp($image, __DIR__."/archive/". $timestamp."/".$beitrag["id"].".webp", $quality);
						imagedestroy($image);
					}
				}else
				{
					if(!file_exists(__DIR__."/archive/". $timestamp."/".$beitrag["id"].".webp")){
					$image = imagecreatefromjpeg($url);
					imagewebp($image, __DIR__."/archive/". $timestamp."/".$beitrag["id"].".webp", $quality);
					imagedestroy($image);
					}
				}
				$beitrag["year"] = $timestamp;
				$beitrag["pic_url"] = "/wp-content/themes/bergauf/blocks/new-insta-wall/archive/".$timestamp."/".$beitrag["id"].".webp";
				array_push($result_all, $beitrag);
				$id_posts[$timestamp][] = $beitrag["id"].".webp";
			}
		}while(!empty($result_archive["paging"]["next"]));

		// echo "warum";
		// $excist_dir = scandir(__DIR__."/archive");
		// foreach($excist_dir as $dir){
		// 	if($dir !== "." && $dir !== ".." && is_dir(__DIR__."/archive/".$dir)){
		// 		$excist_posts = scandir(__DIR__."/archive/".$dir);
		// 		$old_posts = array_diff($excist_posts, $id_posts[$dir]);
		// 		if(!empty($old_posts)){
		// 			foreach($old_posts as $post){
		// 				if($post !== "." && $post !== ".."){
		// 					if($_SERVER["REMOTE_ADDR"] == '130.180.64.138'){
		// 						echo "<pre>";
		// 						echo $dir."</br>";
		// 						echo($post);
		// 						echo "</pre>";
		// 					}
		// 					unlink(__DIR__."/archive/". $dir . "/".$post);
		// 				}
		// 			}
		// 		}
		// 	}
		// }
		

		$all_json = json_encode($result_all);
		file_put_contents(__DIR__.'/archive/archive_instagram.json', $all_json);
	}

if (!isset($result)) {
		echo ("Es ist ein Fehler aufgetreten! Es wurde automatisch eine E-Mail an kreativkarussell gesendet! \n");
		if(!isset($result_all) && $arch_mode == true){
			echo ("Es ist ein Fehler beim Archive aufgetreten! Es wurde automatisch eine E-Mail an kreativkarussell gesendet! \n");
		}
		sendErrorMail();
} else {
	if($dev_mode == true){
		if($_SERVER["REMOTE_ADDR"] == '130.180.64.138' ) {
			echo count($result['data']) . " Posts saved.\n";
		}
	}
}

function fetchMediaDataByToken($_url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function sendErrorMail()
{
	$empfaenger = "ef@kreativkarussell.de";
	$betreff = "Kreativkarussell Instagram Feed";
	$from = "From: Instagram Error <info@kreativkarussell.de>";
	$text = "Es gibt ein Problem mit dem Instagram Feed! <br>
	Bitte prüfen: ".__DIR__."/get_posts.php";
		mail($empfaenger, $betreff, $text, $from);
}
