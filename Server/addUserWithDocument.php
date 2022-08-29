<?php
$user = $_GET['user'];
require ('conexion.php');
require('../Class/Users.php');
$Users = new Users();
if(isset($_POST['user']) && isset($_POST['type'])){
    $Users -> addUserWithNameAndEmail($_POST['user'],$_POST['type']);
}

?>