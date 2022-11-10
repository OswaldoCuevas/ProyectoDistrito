<?php
require ('conexion.php');
require('../Class/Title.php');
require ('validityAdmin.php');

$Title = new Title();
if(isset($_POST['Title_Id'])    && isset($_POST['Cologne']) 
&& isset($_POST['Plot'])        && isset($_POST['Longitude']) 
&& isset($_POST['Latitude'])    && isset($_POST['Change_Date'])){
    $Title_Id       = $_POST['Title_Id'];
    $Cologne        = $_POST['Cologne'];
    $Plot           = $_POST['Plot'];
    $Longitude      = $_POST['Longitude'];
    $Latitude       = $_POST['Latitude'];
    $Change_Date    = $_POST['Change_Date'];
    
    $Title  -> changeLocationWhitDate($Title_Id, $Cologne, $Plot, $Longitude, $Latitude,  $Change_Date);
}
?>