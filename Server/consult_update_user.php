<?php
include("conexion.php");
include("../Class/Document.php");
include("../Class/Users.php");
$Document = new Document();
$User = new Users();

if(isset($_POST["User"])){
  echo  $User -> getUserSpecific($_POST["User"]);
}else if(isset( $_POST["Id_Info"])){
  echo  $Document -> getUserSpecific($_POST["Id_Info"]);
}