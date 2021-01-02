<?php
require 'config.php';
require 'vendor/users.php';
require 'vendor/properties.php';
require 'vendor/functions.php';
if(isset($_POST['slider_id']))
{
    global $database;
    $datas = Property::getMePhotos($_POST['slider_id']);
    $count=0;
    foreach($datas as $data)
    {
        echo "<div class='carousel-item active'>";
        echo "<img src='".BASE_URL."/images/".$data['img1']."' alt='".$count."' class='img-fluid'></div>";
         echo "<div class='carousel-item'>";
        echo "<img src='".BASE_URL."/images/".$data['img2']."' alt='".$count."' class='img-fluid'></div>";
         echo "<div class='carousel-item'>";
        echo "<img src='".BASE_URL."/images/".$data['img3']."' alt='".$count."' class='img-fluid'></div>";
    }
    exit();
}
?>