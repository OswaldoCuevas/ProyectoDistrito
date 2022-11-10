<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
require ('validityAdmin.php');

$Title_Id = $_POST['Title_Id'];
$type = $_POST['type'];
$Title_= new Title();
    switch ($type) {
    case 'title':   echo  json_encode($Title_ -> consultTransferTitle($Title_Id)); break;
    case 'thousand':echo  json_encode($Title_ -> getTransferThousandsSpecific($Title_Id));break;
    case 'location':echo  json_encode($Title_ -> getChangelocation($Title_Id));break;
    }
   
 
    
         ?>