<?php
require ('conexion.php');
require('../Class/Title.php');
$Title = new Title();
if(isset($_POST['Title_Id']) && isset($_POST['Encabezado']) && isset($_POST['Value'])){
$Title -> updateTitle($_POST['Title_Id'], $_POST['Encabezado'], $_POST['Value']);
}
?>