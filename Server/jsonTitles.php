<?php
require ('conexion.php');
require('../Class/Title.php');
$Titles = new Title();

echo $Titles -> jsonTitles($_POST['busqueda']);

?>