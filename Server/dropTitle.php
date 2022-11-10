<?php
require ('conexion.php');
require('../Class/Title.php');
require ('validityAdmin.php');

$Title = new Title();
$Title_Id = $_POST['Title_Id'];
echo $Title_Id;
$Title -> dropTitle($Title_Id)
?>