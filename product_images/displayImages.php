<?php
$dirname = "../product_images/";
$images = glob($dirname."*.jpg");

foreach($images as $image) {
    echo '<img src="'.$image.'" alt="no image" width="200"/><br/>';
}