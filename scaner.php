<?php

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
//$formulario->readImageBlob($imageBlob);