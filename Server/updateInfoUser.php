<?php
require ('conexion.php');
require('../Class/Users.php');
$User= new Users();
if(isset($_POST['User_Id']) && isset($_POST['Encabezado']) && isset($_POST['Value'])){
$User-> updateUser($_POST['User_Id'], $_POST['Encabezado'], $_POST['Value']);
}
?>