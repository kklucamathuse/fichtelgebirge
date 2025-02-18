<?php
if (isset($argv[1])) {
    //The file path of your image.
    if (count(explode(".jpg",$argv[1]))==1 && count(explode(".jpeg",$argv[1]))==1 && count(explode(".png",$argv[1]))==1 ) {
        # code...
    } else {
        $imagePath = $argv[1];
        $exif = exif_read_data($imagePath);
        if(!in_array($exif['Orientation'],[3,6,8])) {
            list($width, $height, $image_type, $attr) = getimagesize($imagePath);
        } else{
            list($height, $width, $image_type, $attr) = getimagesize($imagePath);
        }

        $sizes=[480,768,992,1200,1400,1920,2560];
        $quality = 85;
        $output=$imagePath;
        $newImagePath = $argv[1];
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
                imagewebp($im, $newImagePath, $quality);
                $allsizes=true;
                for ($i=0; $i < count($sizes); $i++) {
                    if ($sizes[$i]>=$width) {
                        $allsizes=false;
                        break;
                    }
                    $proportion=$sizes[$i]/$width;
                    $newHeight=round($proportion*$height);
                    $thumb = imagecreatetruecolor($sizes[$i], $newHeight);
                    imagealphablending($thumb, false);
                    imagesavealpha($thumb, true);
                    $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                    imagefilledrectangle($thumb, 0, 0, $sizes[$i], $newHeight, $transparent);
                    $src_w = imagesx($im);
                    $src_h = imagesy($im);
                    if ($sizes[$i]==1200) {
                        $cropHeight=630;
                        $thumb = imagecrop($thumb, ['x' => 0, 'y' => ($newHeight-$cropHeight)/2, 'width' => $sizes[$i], 'height' => $cropHeight]);
                        $newHeight=630;
                    }
                    imagecopyresampled($thumb, $im, 0, 0, 0, 0, $sizes[$i], $newHeight, $src_w, $src_h);

                    $newImagePathResize = str_replace(".webp", "-".$sizes[$i]."x".$newHeight.".webp", $newImagePath);
                    imagewebp($thumb, $newImagePathResize, $quality);
                }
                if ($allsizes) {
                    $newImagePathResize = str_replace(".webp", "-scaled.webp", $newImagePath);
                    imagewebp($thumb, $newImagePathResize, $quality);
                }
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
                $allsizes=true;
                for ($i=0; $i < count($sizes); $i++) {
                    if ($sizes[$i]>=$width) {
                        $allsizes=false;
                        break;
                    }
                    $proportion=$sizes[$i]/$width;
                    $newHeight=round($proportion*$height);
                    $thumb = imagecreatetruecolor($sizes[$i], $newHeight);
                    if ($sizes[$i]==1200) {
                        $cropHeight=630;
                        $thumb = imagecrop($thumb, ['x' => 0, 'y' => ($newHeight-$cropHeight)/2, 'width' => $sizes[$i], 'height' => $cropHeight]);
                        $newHeight=630;
                    }
                    imagecopyresampled($thumb, $im, 0, 0, 0, 0, $sizes[$i], $newHeight, $width, $height);
                    $newImagePathResize = str_replace(".webp", "-".$sizes[$i]."x".$newHeight.".webp", $newImagePath);
                    imagewebp($thumb, $newImagePathResize, $quality);
                }
                if ($allsizes) {
                    $newImagePathResize = str_replace(".webp", "-scaled.webp", $newImagePath);
                    imagewebp($thumb, $newImagePathResize, $quality);
                }
                imagedestroy($im);
                break;
            default:
                # code...
                break;
        }
    }
    }
}