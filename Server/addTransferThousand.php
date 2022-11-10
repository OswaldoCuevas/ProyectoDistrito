<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
require ('validityAdmin.php');

$Title_= new Title();
$SetTitle = $_POST['SetTitleId'];
$GetTitle = $_POST['GetTitleId'];
$Date_Start = $_POST['Date_Start'];
$Date_End  = $_POST['Date_End'];
$Amount = $_POST['Amount'];

$Title_ -> transfer_thousand($SetTitle, $GetTitle, $Date_Start, $Date_End, $Amount)
?>