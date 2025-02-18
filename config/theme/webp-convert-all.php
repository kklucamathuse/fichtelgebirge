<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
if (isset($argv[1])) {

    //The file path of your image.
    $imagePath = $argv[1];
    //Create an image object.
    $exif = exif_read_data($imagePath);
    if(!in_array($exif['Orientation'],[3,6,8])) {
        list($width, $height, $image_type, $attr) = getimagesize($imagePath);
    }else{
        list($height, $width, $image_type, $attr) = getimagesize($imagePath);
    }
    $sizes=[480,768,992,1200,1400,1920,2560];
    $quality = 70;
    $output=$imagePath;
    $newImagePath = str_replace("/wp-content/uploads/", "/files/webp_images/", $argv[1]);
}
else {
    $dir = dirname(__FILE__,6);
    $directories=["/wp-content/uploads","/wp-content/themes/bergauf/assets/img/impressum","/wp-content/themes/bergauf/assets/img/layout","/wp-content/themes/bergauf/assets/img/backend"];
    $directories=["/wp-content/uploads"];
    foreach ($directories as $key => $directory) {
        $files1 = scandir($dir."".$directory);
        foreach ($files1 as $fileimg) {
            $imagePath = $dir."".$directory."/".$fileimg;
            if (count(explode(".jpg",$fileimg))==1 && count(explode(".jpeg",$fileimg))==1 && count(explode(".png",$fileimg))==1 ) {
                continue;
            }

            $exif = exif_read_data($imagePath);
            if(empty($exif['Orientation'])) {
                list($width, $height, $image_type, $attr) = getimagesize($imagePath);
            }else{
                list($height, $width, $image_type, $attr) = getimagesize($imagePath);
            }

            $sizes=[480,768,992,1200,1400,1920,2560];
            $quality = 85;
            $output=$imagePath;

            $newImagePath = $imagePath;
            if ($image_type==2 || $image_type==3) {
                switch ($image_type) {
                    case 3:
                        $im = imagecreatefrompng($imagePath);
                        if(!empty($exif['Orientation'])) {
                            switch($exif['Orientation']) {
                                case 8:
                                    $im = imagerotate($im,90,0);
                                    break;
                                case 3:
                                    $im = imagerotate($im,180,0);
                                    break;
                                case 6:
                                    $im = imagerotate($im,-90,0);
                                    break;
                            }
                        }
                        imagepalettetotruecolor($im);
                        $newImagePath = str_replace(".png", ".webp", $newImagePath);

                        //Quality of the new webp image. 1-100.
                        //Reduce this to decrease the file size.

                        //Create the webp image.
                        //imagewebp($im, $newImagePath, $quality);
                        imagewebp($im, $newImagePath, $quality);
                        imagedestroy($im);
                        break;
                    case 2:
                        $im = imagecreatefromjpeg($imagePath);
                        if(!empty($exif['Orientation'])) {
                            switch($exif['Orientation']) {
                                case 8:
                                    $im = imagerotate($im,90,0);
                                    break;
                                case 3:
                                    $im = imagerotate($im,180,0);
                                    break;
                                case 6:
                                    $im = imagerotate($im,-90,0);
                                    break;
                            }
                        }
                        //imagepalettetotruecolor($im);
                        $newImagePath = str_replace(".jpg", ".webp", $newImagePath);
                        $newImagePath = str_replace(".jpeg", ".webp", $newImagePath);

                        //Quality of the new webp image. 1-100.
                        //Reduce this to decrease the file size.

                        //Create the webp image.
                        imagewebp($im, $newImagePath, $quality);
                        imagedestroy($im);
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }
    }
}
