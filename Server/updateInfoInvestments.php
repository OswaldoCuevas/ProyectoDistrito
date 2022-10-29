<?php
require ('conexion.php');
require('../Class/Investment.php');
$Investment= new Investment();
if(isset($_POST['User_Id']) ){

  $User_Id          =   $_POST['User_Id'];
  $Cologne          =   $_POST['Cologne'];
  $Plot             =   $_POST['Plot'];
  $System_          =   $_POST['System_'];
  $Hectare          =   $_POST['Hectare'];
  $Investments_Date =   $_POST['Investments_Date'];

  $Investments_Id = $Investment->addUserWithId($_POST['User_Id']);
  $Investment-> updateInvestment($Investments_Id,$User_Id, $Cologne,$Plot,$System_,$Hectare,$Investments_Date);
}
   
