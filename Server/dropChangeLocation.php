<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
require ('validityAdmin.php');
require ('validityAdmin.php');

$Title_= new Title();
$Change_Id   =   $_POST['Change_Id'];

$Title_ -> dropChangeLocation($Change_Id);