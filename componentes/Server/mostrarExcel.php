<?php
include("conexion.php");
$consulta=mysqli_query($sistema,"SELECT * FROM documento;");
while($documentos=mysqli_fetch_assoc($consulta)){
$excel=$documentos['doc'];
}
echo array_map('str_getcsv', base64_encode($excel));;