<?php
require ('conexion.php');
require('../Class/Investment.php');
require ('validityAdmin.php');

$Investments = new Investment();

echo $Investments -> jsonInvestments($_POST['busqueda']);

?>