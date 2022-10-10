<?php
require ('conexion.php');
require('../Class/Users.php');
$Users = new Users();
echo $Users -> jsonAdmins($_POST['Full_Name']);

?>