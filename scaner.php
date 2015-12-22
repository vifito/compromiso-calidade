<?php

/*
$pdf_in = 'images/SKMBT_C65215122213490.pdf';

$img_array = array();
$im = new Imagick();

$im->setResolution(300, 300);

$im->readImageBlob(file_get_contents($pdf_in));
$num_pages = $im->getNumberImages();

echo '$num_pages: ' . $num_pages;

for($i=0; $i<$num_pages; $i++) {
    $im->setIteratorIndex($i);
    $im->setImageFormat('jpeg');
    //$img_array[$i] = $im->getImageBlob();
    //$img_array[$i] = clone($im);
    
    $im->writeImage('images/' . $i . '.jpg');
}
$im->destroy();
 
//$formulario = new Imagick();
//$formulario->readImageBlob($imageBlob); */

$regions = [
    'Q3' => [
        'width' => 255,
        'height' => 1218,
        'x' => 348,
        'y' => 483,
    ],
    'Q4' => [
        'width' => 255,
        'height' => 1218,
        'x' => 600,
        'y' => 483,
    ],
];


$imagePath = './images/0.jpg';
$imagick = new \Imagick(realpath($imagePath));
$imagick2 = clone $imagick;
//cropImage ($width, $height, $x, $y)
$width  = $regions['Q3']['width'];
$height = $regions['Q3']['height'];
$x = $regions['Q3']['x'];
$y = $regions['Q3']['y'];

$imagick2->cropImage($width, $height, $x, $y);

$imagePath = './images/square.jpg';
$square = new \Imagick(realpath($imagePath));

$similarity = null;
$bestMatch = null;
$comparison = $imagick2->subImageMatch($square, $bestMatch, $similarity);

/*$similarity->setImageFormat('png');
$similarity->writeImage('images/similarity.png');*/

var_dump($similarity);
var_dump($bestMatch);



$comparison->setImageFormat('png');
$comparison->writeImage('images/comparison.png');