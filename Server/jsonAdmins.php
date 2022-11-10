<?php
require ('conexion.php');
require('../Class/Users.php');
require ('validityAdmin.php');

$Users = new Users();
echo $Users -> jsonAdmins($_POST['Full_Name']);

?>