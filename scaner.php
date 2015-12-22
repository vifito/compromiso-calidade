<?php

$img_array = array();
$im = new imagick();
$im->setResolution(150,150);
$im->readImageBlob($pdf_in);
$num_pages = $im->getNumberImages();
for($i = 0;$i < $num_pages; $i++) 
{
    $im->setIteratorIndex($i);
    $im->setImageFormat('jpeg');
    $img_array[$i] = $im->getImageBlob();
 }
 $im->destroy();
 
 