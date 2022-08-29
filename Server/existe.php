<?php
require ('conexion.php');
require('../Class/Users.php');
require('../Class/Title.php');
$Users = new Users();
$Title = new Title();
if(isset($_POST['value']) && isset($_POST['type'])){
    switch($_POST['type']){
        case 'user':    echo $Users ->  existe($_POST['value']);    break;
        case 'title':    echo $Title ->  existe($_POST['value']);    break;
    }
    
}