<?php
require ('conexion.php');
require('../Class/Title.php');
require ('validityAdmin.php');

$Title = new Title();
echo $_POST['Value'];
if (isset($_POST['Value'])){
    echo "1";
    $Location_Id = $_POST['Location_Id'];
    $Value = $_POST['Value'] == 'Sin registrar' ? 'null':"'".$_POST['Value']."'";
    $Encabezado = $_POST['Encabezado'];
    $Title -> changeLocation($Location_Id, $Encabezado, $Value);
    
}