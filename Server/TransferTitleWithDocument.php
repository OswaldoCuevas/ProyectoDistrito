<?php
require ('conexion.php');
require('../Class/Title.php');
$Title = new Title();
if(isset($_POST['Title_Number']) && isset($_POST['Control_Num'])){
    $Title -> titleTransfer($_POST['Title_Number'],$_POST['Control_Num']);
}
echo 1;