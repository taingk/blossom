<?php

header("Content-Type: image/png");

function randBgColor($image) {
    return imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
}

function randColor($image) {
    return imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));
}

$width = 150;
$height= 50;
$image = imagecreate($width, $height);
$backgroundColor = imagecolorallocate($image, randBgColor($image), randBgColor($image), randBgColor($image));
$char = "abcdefghijklmnopqrstuvwxyz0123456789";
$char = str_shuffle($char);
$length = rand(-8,-6);
$captcha = substr($char, $length) ;
$fonts = glob('public/font/*.ttf');
$x = rand(10, 15);

for ($i = 0; $i < strlen($captcha); $i++) {
    $size = rand(10, 15);
    $angle = rand(-30, 30);
    $y = rand(20, $height - 20);
    $fontKey = rand(0, count($fonts) - 1);

    imagettftext($image, $size, $angle, $x, $y, randColor($image), $fonts[$fontKey], $captcha[$i]);

    $x += $size + rand(1, 5);
}

for ($j = 0; $j < rand(3,6); $j++) {
    $x1 = rand(0, $width);
    $x2 = rand(0, $width);
    $y1 = rand(0, $height);
    $y2 = rand(0, $height);

    switch (rand(0,2)) {
        case 0:
            imageline($image, $x1, $y1, $x2, $y2, randColor($image));
            break;
        case 1:
            imageellipse($image, $x1, $y1, $x2, $y2, randColor($image));
            break;
        default:
            imagerectangle($image, $x1, $y1, $x2, $y2, randColor($image));
            break;
    }
}

imagepng($image);