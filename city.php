<?php
     // include 'current.php';
     $url = 'https://api.openweathermap.org/data/2.5/weather?q=Lisburn&appid=b87ddfcb90d0e5ea9132e4ab54a65ffb&units=metric';

     $response = file_get_contents($url);
     
     $obj = json_encode($response);
     echo json_decode($obj);
?>