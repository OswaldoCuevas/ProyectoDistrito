<?php
include("conexion.php");
$count=1;
error_reporting( E_PARSE);
function miGestorDeErrores($errno, $errstr, $errfile, $errline)
{
   global $count;
   echo "<b>Error en la fila número $count del archivo $nombre</b>";

}
set_error_handler("miGestorDeErrores");


 $archivo = $_FILES["file"]["tmp_name"]; 
 $tamanio = $_FILES["file"]["size"];
 $tipo    = $_FILES["file"]["type"];
 $nombre  = $_FILES["file"]["name"];
 $nombre =utf8_encode($nombre);
 if ( $archivo != "none" )
 {
    $fp = fopen($archivo, "rb");
    $contenido = fread($fp, $tamanio);
    $contenido = addslashes($contenido);
    fclose($fp); 
    $sentenciaSqlInsertarDocumento="INSERT INTO documento(nombredocumento) VALUES ('$nombre');";
    mysqli_query($sistema,  $sentenciaSqlInsertarDocumento)or die(mysqli_error($sistema,  $sentenciaSqlInsertarDocumento)); 
         $id2=mysqli_query($sistema,"SELECT LAST_INSERT_ID();");
                $id_2=mysqli_fetch_assoc($id2);
               $id_nuevo=$id_2['LAST_INSERT_ID()']; 
 }

$openfile = fopen($archivo, "r");
$cont = fread($openfile, filesize($archivo));
$csv = file( $archivo);




foreach ($csv as $linea) {

        
   $fila=explode(";",$linea);
   $fila[0]=utf8_encode($fila[0]);
   $fila[0]=preg_replace('/[\s]{2,10}/',' ',$fila[0]);
  
   if($count>0){

      $aux=explode("\"",$fila[0]);
      if(count($aux)>1){
        $auxFila="";
         $k=1;
         foreach ($aux as $aux2) {
            if(impar($k)){
               $auxFila=$auxFila.$aux2;
            }else{
               $usuarios=explode(",",$aux2);
               $primero=true;
               foreach ($usuarios as $aux3) {
                  if($primero){
                     $primero=false;
                     $auxFila=$auxFila."".$aux3;
                  }else{
                     $auxFila=$auxFila."  ".$aux3;
            }
         }
            
            }
            $k++;
         }
         $fila[0]=$auxFila;
   }
       
      $columna=explode(",",$fila[0]);
      if(!empty($programa=$columna[0])){
         $estructura="id_documento,programa";
         $insert="$id_nuevo,$programa";
         $masDeUnUSuario=0;
      if(!empty($nombreUsuario=$columna[1])){
         
         // $aux=explode("\"",$columna[1]);
         // $i=1;
         // if(count($aux)>1){
         //    while(count($aux)>1){
         // $aux=explode("\"",$columna[1+$i]);
         // $concatena=$aux[0];
         // $nombreUsuario="$nombreUsuario $concatena";
         // $i++;
         // }
         // $masDeUnUSuario=$i-1;
         //    }
        
         $nombreUsuario = remove_sp_chr($nombreUsuario);
         
         $estructura="$estructura,usuario";
         $nombreCodigcado=utf8_encode($nombreUsuario);
         $insert="$insert,'$nombreCodigcado'";

      }
      if(!empty($lote=$columna[2])){
         $estructura="$estructura,lote";
         $insert="$insert,'$lote'";
      
      }
      if(!empty($colonia=$columna[3])){
         $estructura="$estructura,colonia";
         $insert="$insert,'$colonia'";
      }
      if(!empty($sector=$columna[4])){
      }
      if(!empty($numeroDeTitulo=$columna[5])){
         $estructura="$estructura,numero_titulo";
         $titulo20=substr($numeroDeTitulo, 0,20);
         $insert="$insert,'$titulo20'";
      }
      if(!empty($vigencia=explode(" ",$columna[6]))){
       
         if(!empty($vigencia_guardar=$vigencia[0])){
            $estructura="$estructura,vigencia";
            
            $insert="$insert,$vigencia_guardar";
         }
        
      }
      
      if(!empty($fechaInicio=$columna[7])){
         
         $formatear_fecha=preg_split("/[\s]+/", $fechaInicio);
         $verificar=substr($formatear_fecha[0], 0, 1);
         if(!ctype_alpha($verificar)){
      $dia=  $formatear_fecha[0];
      if(strlen($dia)<=1){
         $dia="0$dia";
      }
      $mes=  $formatear_fecha[2];
      switch ( $mes) {
         case "ENERO":$mes="01";break;
         case "EN.":$mes="01";break;
         case "ENE.":$mes="01";break;
         case "ENER.":$mes="01";break;
         case "FEBRERO":$mes="02";break;
         case "FEB.":$mes="02";break;
         case "FEB":$mes="02";break;
         case "MARZO":$mes="03";break;
         case "MAR.":$mes="03";break;
         case "MAR":$mes="03";break;
         case "ABRIL":$mes="04";break;
         case "ABR.":$mes="04";break;
         case "ABR":$mes="04";break;
         case "MAYO":$mes="05";break;
         case "MAY.":$mes="05";break;
         case "MAY":$mes="05";break;
         case "JUNIO":$mes="06";break;
         case "JUN.":$mes="06";break;
         case "JUN":$mes="06";break;
         case "JULIO":$mes="07";break;
         case "JUL.":$mes="07";break;
         case "JUL":$mes="07";break;
         case "AGOSTO":$mes="08";break;
         case "AGO.":$mes="08";break;
         case "AGO":$mes="08";break;
         case "SEPTIEMBRE":$mes="09";break;
         case "SEP.":$mes="09";break;
         case "SEP":$mes="09";break;
         case "SEPT.":$mes="09";break;
         case "SEPT":$mes="09";break;
         case "OCTUBRE":$mes="10";break;
         case "OCT.":$mes="10";break;
         case "NOVIEMBRE":$mes="11";break;
         case "NOV.":$mes="11";break;
         case "DICIEMBRE":$mes="12";break;
         case "DIC.":$mes="12";break;
         case "DIC":$mes="12";break;

         }
         $estructura="$estructura,fecha_inicio";
         $fechaAGuardar="$formatear_fecha[4]-$mes-$dia";
         $insert="$insert,'$fechaAGuardar'";
         }
      }
      if(empty($prorroga=$columna[8])){}
      if(!empty($dotacion=$columna[9])){
         $estructura="$estructura,dotacion";
         $insert="$insert,$dotacion";
      }
      if(!empty($latitud=$columna[10])){
         $estructura="$estructura,latitud";
         $latitudFormateda=preg_replace('([^A-Za-z0-9 ])', '', $latitud);
         $insert="$insert,'$latitudFormateda'";
      }
      if(!empty($longitud=$columna[11])){
         $estructura="$estructura,longitud";
         $longitudFormateda=preg_replace('([^A-Za-z0-9 ])', '', $longitud);
         $insert="$insert,'$longitudFormateda'";
      }
      $sentenciaSqlInfoDocumento="INSERT INTO informaciondocumento ($estructura) 
         VALUES ($insert) ";

          mysqli_query($sistema,$sentenciaSqlInfoDocumento)or die(mysqli_error($sistema,$sentenciaSqlInfoDocumento));
          
         } 
   }
      
      
         
         
        
     
   $count++;
}

function remove_sp_chr($str)
         {
             $result = str_replace(array("#", "'", ";","´","=",'"'), '', $str);
             return $result;
         }
         
         function impar($valor){  
if($valor%2==0)
{

	return false;
}else{

	return true;
}
         }
 echo "1";
?>