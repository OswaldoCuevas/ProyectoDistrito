<?php
include("conexion.php");
include("../Class/Document.php");
include("../Class/Investment.php");
require ('validityAdmin.php');

$Document = new Document();
$Investment = new Investment();

if(isset($_POST["User"])){
  echo  $Investment -> getInvestmentSpecific($_POST["User"],$_POST["Cologne"],$_POST["Plot"],$_POST["Investments_Date"],$_POST['System_'],$_POST['Hectare']);
}else if(isset( $_POST["Id_Info"])){
  echo  $Document -> getInvestmentSpecific($_POST["Id_Info"]);
}