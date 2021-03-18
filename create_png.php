<?php
   // Create an image with the specified dimensions
   $image = imageCreate(300,200);
   ob_clean();
   // Create a color (this first call to imageColorAllocate
   //  also automatically sets the image background color)
   $colorRed = imageColorAllocate($image, 255,0,0);
   // Create another color
   $colorYellow = imageColorAllocate($image, 255,255,0);
 
   // Draw a rectangle
   imageFilledRectangle($image, 50, 50, 250, 150, $colorYellow);
 
   // Set type of image and send the output
   header("Content-type: image/jpeg");
   imageJpeg($image);
 
   // Release memory
   imageDestroy($image);
?>