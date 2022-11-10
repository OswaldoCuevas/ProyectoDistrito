<?php
   require ('../Server/conexion.php');
	require('../Class/Document.php');
   require ('validityAdmin.php');

   $Document = $_FILES["file"]["tmp_name"]; 
   $tamanio = $_FILES["file"]["size"];
   $type    = $_FILES["file"]["type"];
   $name  = $_FILES["file"]["name"];
   if ( $Document != "none" )
 {
    $fp = fopen($Document, "rb");
    $contenido = fread($fp, $tamanio);
    $contenido = addslashes($contenido);
    fclose($fp); 
 }
    $Document_class = new Document();
   // 
   if(isset($_POST["tipo"]) && isset($_POST["año"]) && isset($_POST["operacion"])){

   
      switch ($_POST["operacion"]){
         case  "Guardar":
            echo isset($Document) ? $Document_class -> setInfoDocuments($Document, $name, $_POST["tipo"], $_POST["año"]) : "No se pudo leer el documento";
         break;
         case "Analizar": 
            echo isset($Document) ? $Document_class -> AnalizarFormato($Document,true) : "No se pudo leer el documento"; break;
         break;
      }

   }else{
   echo "error al recibir la información";
   }

?>