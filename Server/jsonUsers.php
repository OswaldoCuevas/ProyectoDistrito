<?php
require ('conexion.php');
require('../Class/Users.php');
$Users = new Users();

echo $Users -> jsonUsers($_POST['Full_Name']);

?>