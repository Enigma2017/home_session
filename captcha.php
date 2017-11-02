<?php
//2) убрать использование гет параметра с числом из скрипта  капчи - использовать сессию
session_start();
$imgX = 120;  // image width
$imgY = 20;   // image height
$fontMinSize = 12;  // Min font size
$fontMaxSize = 15;   //Max   font size
$maxHorizAngle = 20;   //Максимальный угол отклонения от горизонтали по часовой стрелке и против, по умолчанию-20
$textColor = null;
$imageColor = null;
$font = null;
$image = null;
//$securityNumber = $_GET['number'];
$font = __DIR__ . '/SpicyRice.ttf';
$image = imagecreate($imgX, $imgY);
// colors allocations - text, noise, bg
$textColor = imagecolorallocate($image, 0, 0, 0);
$imageColor = imagecolorallocate($image, 255, 255, 255);
// fill the bg of image
imagefill($image, 0, 0, $imageColor);
    
    //  В переменной $number будет храниться число, показанное на изображении
   // $num_n = strlen($securityNumber);
 
$string = "";
    for ($n = 0; $n < 5; $n++) {
        //$num = substr($securityNumber, $n, 1);
        $string .= chr(rand(97, 122)); // вывод случайных символов от a до z, по html коду
        $_SESSION['rand_code'] = $string; // создаем сессию, в которой будут храниться отображаемые символы
        $font_size = rand($fontMinSize, $fontMaxSize);//$imgY/2
        $angle = rand(360 - $maxHorizAngle, 360 + $maxHorizAngle);
        /*  вычисление координат для каждой цифры, формулы обеспечивают нормальное расположние
        /  при любых значениях размеров цифры и изображения
        $y = rand(($imgY - $font_size) / 4 + $font_size, ($imgY - $font_size) / 2 + $font_size);
        $x = rand(($imgX / $num_n - $font_size) / 2, $imgX / $num_n - $font_size) + $n * $imgX / $num_n;*/
        $textColor = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));       //цвет текста
        imagettftext($image, $font_size, $angle, $textColor, $font, $_SESSION['rand_code']);
    }
header("Content-type: image/png");
imagepng($image);