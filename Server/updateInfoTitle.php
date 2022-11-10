<?php
require ('conexion.php');
require('../Class/Title.php');
require ('validityAdmin.php');

$Title = new Title();
echo $_POST['Title_Id'].$_POST['Encabezado'].$_POST['Value'];
if(isset($_POST['Title_Id']) && isset($_POST['Encabezado']) && isset($_POST['Value'])){
    $Title -> updateTitle($_POST['Title_Id'], $_POST['Encabezado'], $_POST['Value']);
}
?>