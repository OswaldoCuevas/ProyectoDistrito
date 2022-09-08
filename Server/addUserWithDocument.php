<?php
require ('conexion.php');
require('../Class/Users.php');
$Users = new Users();
if(isset($_POST['user']) && isset($_POST['type'])){
    $Users -> addUserWithNameAndType($_POST['user'],$_POST['type']);
} else if(isset($_POST['user'])){
    $Users -> addUserWithName($_POST['user']);
}

?>