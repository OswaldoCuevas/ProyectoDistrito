<?php
 require ('../Server/conexion.php');
 require('../Class/Document.php');
 $Document = new Document();
if(isset($_POST["Document_Id"])){
    $Document -> dropDocument($_POST["Document_Id"]);
}

?>