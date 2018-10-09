<?php

function shrinkWithAspectRatio($width_orig, $height_orig, $max_width, $max_height)
{
    $ratio_orig = $width_orig / $height_orig;

    if ($width_orig <= $max_width || $height_orig <= $max_height) {
        $width = $width_orig;
        $height = $height_orig;
    } else {
        if ($max_width / $max_height > $ratio_orig) {
            $width = $max_height * $ratio_orig;
            $height = $max_height;
        } else {
            $width = $max_width;
            $height = $max_width / $ratio_orig;
        }
    }

    return [(int)$width, (int)$height];
}

function resizeImageAndSave($orig, $to, $max_width, $max_height)
{
    list($orig_width, $orig_height, $image_type) = getimagesize($orig);

    switch ($image_type)
    {
        case IMAGETYPE_GIF:
            $orig_img = imagecreatefromgif($orig);
            break;
        
        case IMAGETYPE_JPEG:
            $orig_img = imagecreatefromjpeg($orig);
            break;

        case IMAGETYPE_PNG:
            $orig_img = imagecreatefrompng($orig);
            break;

        default:
            throw new RuntimeException();
            break;
    }

    list($new_width, $new_height) = shrinkWithAspectRatio($orig_width, $orig_height, $max_width, $max_height);

    $new_img = imagecreatetruecolor($new_width, $new_height);

    if ($image_type === IMAGETYPE_GIF || $image_type === IMAGETYPE_PNG) {
        imagealphablending($new_img, false);
        imagesavealpha($new_img, true);
        $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
        imagefilledrectangle($new_img, 0, 0, $new_width, $new_height, $transparent);
    }

    imagecopyresampled($new_img, $orig_img, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

    switch ($image_type)
    {
        case IMAGETYPE_GIF:
            imagegif($new_img, $to);
            break;
        
        case IMAGETYPE_JPEG:
            imagejpeg($new_img, $to, 80);
            break;

        case IMAGETYPE_PNG:
            imagepng($new_img, $to, 8);
            break;
    }
}

/*
$files = array_diff(scandir("../blog/images/"), array('.', '..'));

foreach ($files as $file) {
resizeImageAndSave("../blog/images/$file",
                    "../blog/tmp_images/$file",
                    1200, 1200);
}
*/