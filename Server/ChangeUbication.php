<?php
require ('conexion.php');
require('../Class/Title.php');
$Title = new Title();
echo $_POST['Value'];
if (isset($_POST['Value'])){
    echo "1";
    $Title_Id = $_POST['Title_Id'];
    $Value = $_POST['Value'] == 'Sin registrar' ? 'null':"'".$_POST['Value']."'";
    $Encabezado = $_POST['Encabezado'];
    $Title -> changeLocation($Title_Id, $Encabezado, $Value);
    
}