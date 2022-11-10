<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
require ('validityAdmin.php');

$Title_= new Title();
$Transfers_Id   =   $_POST['Transfers_Id'];
$Title_ -> dropTransferThousand($Transfers_Id);