<?php
namespace App\Traits;

trait ImageConvert
{
    public  function PdfToImage($pdfPath)
    {
        $image = new imagick($pdfPath.'[0]'); // o az első oldalt jelzi
        return $image->setImageFormat('jpeg'); 
    }
    public  function watermark($image,$watermark)
    {
        // Retrieve size of the Images to verify how to print the watermark on the image
        $img_Width = $image->getImageWidth();
        $img_Height = $image->getImageHeight();
        $watermark->resizeImage($img_Width, $img_Height);
        //$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $x, $y);
       return  $image->compositeImage($watermark, Imagick::COMPOSITE_OVER);
    }
    public  function imageResize($image,$width,$height)
    {
       // $image->resizeImage($width, $height, $filterType, $blur, $bestFit);
     return   $image->resizeImage($width, $height);
    }

}
/*

$image->writeImage('thumb.jpg'); 


$image = new Imagick();
$image->readImage(getcwd(). "/goat.jpg");

// Open the watermark image
// Important: the image should be obviously transparent with .png format
$watermark = new Imagick();
$watermark->readImage(getcwd(). "/draft_watermark.png");

// Retrieve size of the Images to verify how to print the watermark on the image
$img_Width = $image->getImageWidth();
$img_Height = $image->getImageHeight();
$watermark_Width = $watermark->getImageWidth();
$watermark_Height = $watermark->getImageHeight();

// Check if the dimensions of the image are less than the dimensions of the watermark
// In case it is, then proceed to 
if ($img_Height < $watermark_Height || $img_Width < $watermark_Width) {
    // Resize the watermark to be of the same size of the image
    $watermark->scaleImage($img_Width, $img_Height);

    // Update size of the watermark
    $watermark_Width = $watermark->getImageWidth();
    $watermark_Height = $watermark->getImageHeight();
}

// Calculate the position
$x = ($img_Width - $watermark_Width) / 2;
$y = ($img_Height - $watermark_Height) / 2;

// Draw the watermark on your image
$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $x, $y);


// From now on depends on you what you want to do with the image
// for example save it in some directory etc.
// In this example we'll Send the img data to the browser as response
// with Plain PHP
header("Content-Type: image/" . $image->getImageFormat());
echo $image;
*/