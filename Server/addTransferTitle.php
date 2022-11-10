<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
require ('validityAdmin.php');

$Title_= new Title();
$Title_Id          = $_POST['Title_Id'];
$New_User          = $_POST['New_User'];
$Previous_User     = $_POST['Previous_User'];
$Transfer_Date     = $_POST['Transfer_Date'];

$Title_ -> transfer_title($Title_Id,$New_User,$Previous_User,$Transfer_Date)
?>