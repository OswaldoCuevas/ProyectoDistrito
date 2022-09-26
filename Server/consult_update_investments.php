<?php
include("conexion.php");
include("../Class/Document.php");
include("../Class/Investment.php");
$Document = new Document();
$Investment = new Investment();

if(isset($_POST["User"])){
  echo  $Investment -> getInvestmentSpecific($_POST["User"],$_POST["Cologne"],$_POST["Plot"],$_POST["Investments_Date"]);
}else if(isset( $_POST["Id_Info"])){
  echo  $Document -> getInvestmentSpecific($_POST["Id_Info"]);
}