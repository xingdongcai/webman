<?php
$dirname = "../product_images/";
$images = glob($dirname."*.png");

foreach($images as $image) {
    echo '<img src="'.$image.'" alt="no image" style="width:500px;height:600px;"/><br />';
}