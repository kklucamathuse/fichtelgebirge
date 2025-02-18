<?php
add_filter('wp_handle_upload', 'webp_creator' );

function webp_creator( $file ) {
    $imagePath = str_replace("/wp-content/uploads/", "", $file["url"]);
    $searchDummy=explode("/wp-content/uploads/",  $file["url"]);
    if (isset($searchDummy[1])) {

        $imagePath = $searchDummy[1];

        $output=exec("php ".ABSPATH."wp-content/themes/bergauf/config/theme/webp-convert.php ".ABSPATH."wp-content/uploads/".$imagePath);
        //$output="php ".ABSPATH."files/webpconvert.php ".$imagePath;
        // $sPath = ABSPATH . 'files/test.json';
        // file_put_contents($sPath, $output, FILE_USE_INCLUDE_PATH);
        //Prüfen, ob Datei erfolgreich hochgeladen wurde
        //move_uploaded_file(json_encode($file), $sPath);
    }
    return $file;
}
function deleteWebp( $id, $post ) {
    //echo "Let's not delete Attachment id: " . $id ;
    // prevent the attachment from actually being deleted
    // if( 1 == 1 ) { // made up condition
    //     die; // Prevent the script from continuing.
    // }
    $dir = ABSPATH . 'wp-content/uploads/';
    $files1 = scandir($dir);
    $uebergabe = array();
    $uebergabe1 = array();
    $searchDummy=explode("/wp-content/uploads/", $post->guid);
    if (isset($searchDummy[1])) {
        $search = $searchDummy[1];
        $exif = exif_read_data(ABSPATH . 'wp-content/uploads/' .$search);
        if(!in_array($exif['Orientation'],[3,6,8])) {
            list($width, $height, $image_type, $attr) = getimagesize(ABSPATH . 'wp-content/uploads/' .$search);
        }else{
            list($height, $width, $image_type, $attr) = getimagesize(ABSPATH . 'wp-content/uploads/' .$search);
        }
        $search=str_replace(".jpg", ".webp", $search);
        $search=str_replace(".jpeg", ".webp", $search);
        $search=str_replace(".png", ".webp", $search);
        foreach ($files1 as $filePDF) {
            $zwischenspeicher = explode($search, $filePDF);
            if (isset($zwischenspeicher[1])) {

                //$zwischenspeicher2 = explode(".webp", $filePDF);

                //if (isset($zwischenspeicher2[1])) {
                    $uebergabe1[] = $filePDF;
                //}

            }
        }
        $uebergabeTest=[];
        foreach ($uebergabe1 as $byebyePDF) {
            $sizes=[480,768,992,1200,1400,1920,2560];

            $allsizes=true;
            for ($i=0; $i < count($sizes); $i++) {
                if ($sizes[$i]>=$width) {
                    $allsizes=false;
                    break;
                }
                $proportion=$sizes[$i]/$width;
                $newHeight=round($proportion*$height);
                if ($sizes[$i]==1200) {
                    $newHeight=630;
                }
                $newbyebyePDF = str_replace(".webp", "-".$sizes[$i]."x".$newHeight.".webp", $byebyePDF);
                $uebergabeTest[]=$newbyebyePDF;
                unlink(ABSPATH . 'wp-content/uploads/' . $newbyebyePDF);
            }
            if ($allsizes) {
                $newbyebyePDF = str_replace(".webp", "-scaled.webp", $byebyePDF);
                $uebergabeTest[]=$newbyebyePDF;
                unlink(ABSPATH . 'wp-content/uploads/' . $newbyebyePDF);
            }
            $uebergabeTest[]=$byebyePDF;
            $uebergabeTest[]=$post->guid;
            unlink(ABSPATH . 'wp-content/uploads/' . $byebyePDF);
        }

        $output=json_encode($uebergabeTest);
        //$output="php ".ABSPATH."files/webpconvert.php ".$imagePath;
        // $sPath = ABSPATH . 'files/testDelete.json';
        // file_put_contents($sPath, $output, FILE_USE_INCLUDE_PATH);
    }
};
// add the action
add_action( 'delete_attachment', 'deleteWebp', 10, 2 );
