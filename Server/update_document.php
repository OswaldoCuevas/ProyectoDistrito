<?php
require ('conexion.php');
require('../Class/Document.php');
$Document = new Document();
$Document -> editInfoDocument($_POST['Id_Info'],$_POST['Value'],$_POST['Encabezado'])

?>