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
        'options' => [
            [72, 65, 468, 1431],
            [72, 65, 468, 1243],
            [72, 65, 468, 972],
            [72, 65, 468, 795],
        ],
    ],
    'Q4' => [        
        'options' => [
            [78, 57, 720, 1436],
            [78, 57, 720, 1243],
            [78, 57, 720, 978],
            [78, 57, 720, 800],
        ],
    ],
    'Q5' => [        
        'options' => [
            [72, 65, 965, 1519],
            [72, 65, 965, 1366],
        ],
    ],
    'Q6' => [        
        'options' => [
            [72, 65, 1221, 1517],
            [72, 65, 1223, 1366],
        ],
    ],
    'Q7' => [        
        'options' => [
            [72, 65, 1470, 1517],
            [72, 65, 1469, 1368],
        ],
    ],
    'Q8' => [        
        'options' => [
            [72, 65, 1720, 1519],
            [72, 65, 1719, 1369],
        ],
    ],
    'Q9' => [        
        'options' => [
            [72, 65, 1972, 1436],
            [72, 65, 1972, 1246],
            [72, 65, 1972, 995],
            [72, 65, 1972, 800],
        ],
    ],    
];


//$imagePath = './images/0.jpg';
//$imagick = new \Imagick(realpath($imagePath));
//$imagick2 = clone $imagick;
////cropImage ($width, $height, $x, $y)
//$width  = $regions['Q3']['width'];
//$height = $regions['Q3']['height'];
//$x = $regions['Q3']['x'];
//$y = $regions['Q3']['y'];
//
//$imagick2->cropImage($width, $height, $x, $y);

function weight($imageRegion) {
    
    // Outros efectos para mellorar
    $imageRegion->negateImage(true);
    $imageRegion->fxImage('intensity');
  
    // Contar pixels
    $it = new \ImagickPixelIterator($imageRegion);
    
    $whitePixel = new \ImagickPixel('#000');
    
    $totalPixels = 0;
    $dirtyPixels = 0;
    
    foreach ($it as $pixels) { 
        foreach ($pixels as $column => $pixel) {             
            if (!$pixel->isSimilar($whitePixel, 0.1)) {                  
                $dirtyPixels++;
            }
            
            $totalPixels++;
        }
        $it->syncIterator();
    }
    
    return ($dirtyPixels*100/$totalPixels);
}

function selected($weights) {
    $isBlank = false;
    $selected = array_search(max($weights), $weights);
    
    foreach($weights as $i => $value) {
        if(($i != $selected) && ($value >= $weights[$selected])) {
            return -1;
        }
    }
    
    return $selected;
}

$imagePath = './images/0.png';
//$imagePath = './images/1.jpg';
$formulario = new \Imagick(realpath($imagePath));


foreach($regions as $region => $question) {
    $weights = [-1];
    
    for($i=0; $i<count($question['options']); $i++) {
        list($width, $height, $x, $y) = $question['options'][$i];
        $box = $formulario->clone();
        $box->cropImage($width, $height, $x, $y);
        
        $weights[] = weight($box);
    }
    
    // TODO: controlar pesos por si hai respostas en branco
    echo "Opción seleccionada: " . selected($weights) . PHP_EOL;
}





//$square->blackThresholdImage('grey');
//$square->contrastImage(true);


// 

//$similarity = null;
//$bestMatch = null;
//$comparison = $imagick2->subImageMatch($square, $bestMatch, $similarity);

/*
$similarity->setImageFormat('png');
$similarity->writeImage('images/similarity.png');*/

//var_dump($similarity);
//var_dump($bestMatch);
//
//$comparison->setImageFormat('png');
//$comparison->writeImage('images/comparison.png');