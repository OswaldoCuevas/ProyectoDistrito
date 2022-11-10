<?php
require ('../Server/conexion.php');
require ('../Class/Document.php');
require ('validityAdmin.php');
  
   $Title_Number=$_POST["Title_Number"];
   $User=$_POST["User"];
   $Plot=$_POST["Plot"];
   $Cologne=$_POST["Cologne"];
   $Validity=$_POST["Validity"];
   $Initial_Date=$_POST["Initial_Date"];
   $Water_Supply=$_POST["Water_Supply"];
   $Latitude=$_POST["Latitude"];
   $Longitude=$_POST["Longitude"];
   $Extend=$_POST["Extend"];
   $Documten= new Document();

    echo $Documten -> ShowUpdates($User,$Cologne,$Plot,$Title_Number,$Initial_Date,$Water_Supply,$Longitude,$Latitude,$Validity,$Extend);