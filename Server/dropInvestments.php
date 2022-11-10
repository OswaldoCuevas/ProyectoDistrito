<?php
require ('conexion.php');
require('../Class/Investment.php');
require ('validityAdmin.php');

$Investment = new Investment();
$Investments_Id = $_POST['Investments_Id'];
$Investment -> dropInvestment($Investments_Id);
?>