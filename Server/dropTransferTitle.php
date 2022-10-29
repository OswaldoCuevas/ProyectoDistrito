<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;

$Title_= new Title();
$Transfers_Id   =   $_POST['Transfers_Id'];

$Title_ -> dropTransferTitle($Transfers_Id);