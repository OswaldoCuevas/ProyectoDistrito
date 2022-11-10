<?php
require ('conexion.php');
require('../Class/Title.php');
require ('validityAdmin.php');

$Title = new Title();
if(isset($_POST['Title_Id']) && isset($_POST['Cologne']) && isset($_POST['Plot'])&& isset($_POST['Longitude']) && isset($_POST['Latitude'])){
    
    $Title  -> changeLocationWhiteTitle($_POST['Title_Id'], $_POST['Cologne'], $_POST['Plot'], $_POST['Longitude'], $_POST['Latitude']);
}

?>