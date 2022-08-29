<?php
include("conexion.php");
include("../Class/Document.php");
include("../Class/Title.php");
$Document = new Document();
$Title = new Title();

if(isset($_POST["title"])){
  echo  $Title -> getTitleSpecific($_POST["title"]);
}else if(isset( $_POST["Id_Info"])){
  echo  $Document -> getTitleSpecific($_POST["Id_Info"]);
}