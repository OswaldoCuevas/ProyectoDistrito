<?php
  require ('../Library/vendor/autoload.php');
   function limitVarchar($Encabezado){
        
    switch ($Encabezado){

        case 'User':          return  400;  break;                                 
        case'Type_User':      return   30;  break; 
        case'Cologne':        return   80;  break;                                   
        case 'Plot':          return   80;  break;                                         
        case'Title_Number':   return   40;  break;                                     
        case 'Longitude':     return   20;  break;                                        
        case'Latitude':       return   20;  break;                                          
        case'System_':        return  100;  break;                                                                  
        case'RFC' :           return  200;  break;                                
        case'CURP' :          return  200;  break;                                                             
        case'INE'  :          return   15;  break;                                     
        case'Phone_Number' :  return  200;  break;                                  
        case'Tenant' :        return  400;  break;  
        case'Email' :         return  200;  break; 
        case'Initial_Date' :  return  200;  break; 
    }
    return 100000;
  }
   function formatCorrect($type , $expresion){
    switch ($type ) {
      
      case 'User':            return true; break;
      case 'Plot':            return true; break;
      case 'Cologne':         return true; break;
      case 'Title_Number':    return true; break;
      case 'Water_Supply':    return true; break; 
      case 'Extend':          return true; break;           
    }
    $comparacion =  regularExpressions($type);
    return preg_match($comparacion,$expresion); 
 }
  function regularExpressions($type) {
  switch ($type) {
      case 'Program':         return  "/^[\s]*[0-9]+[\s]*$/i";        break;
      case 'Validity':        return  "/^[\s]*[0-9]{1,3}[\s]+/i";     break;
      case 'Initial_Date':    return  "/^[\s]*[0-9]{1,2}[\s]*(de|del)[\s]*(ene|feb|mar|abr|may|jun|jul|ago|sep|oct|nov|dic)(.)*[\s]*(de|del)[\s]*[0-9]{4}[\s]*$/i"; break;
      case 'Latitude':        return  "/[\s]*[\d][\s]*/";             break;
      case 'Longitude':       return  "/[\s]*[\d][\s]*/";             break;
      case 'Type_User':       return  "/^[\s]*(p.p|ejidal)[\s]*$/i";  break;
  }
  return "/[\w.]/i";
 }

 function getEncabezado($hoja,$numeroColumnas) {

  $programa = "/^(([\s]*p[\s]*r[\s]*o[\s]*g[\s]*)|(No.$)|(numero$))/i";//programa
  $usuario = "/[\s]*u[\s]*s[\s]*u[\s]*a[\s]*r[\s]*i[\s]*o[\s]*/i";//usuario
  $lote = "/l[\s]*o[\s]*t[\s]*e/i";//lote
  $colonia = "/c[\s]*o[\s]*l[\s]*o[\s]*n[\s]*i[\s]*a/i";//colonia
  $sector = "/s[\s]*e[\s]*c[\s]*t[\s]*o[\s]*r/i";
  $numeroTitulo = "/t[\s]*(i|í)[\s]*t[\s]*u[\s]*l[\s]*o[\s]*[\s]*(d[\s]*e){0,1}/i" ;
  $prorroga ="/(d[\s]*e){0,1}[\s]*(p[\s]*r[\s]*o[\s]*r[\s]*r[\s]*o[\s]*g[\s]*a)/i";
  $vigencia = "/v[\s]*i[\s]*g[\s]*e[\s]*n[\s]*c[\s]*i[\s]*a/i";
  $fecha_inicio= "/f[\s]*e[\s]*c[\s]*h[\s]*a[\s]*(d[\s]*e){0,1}[\s]*i[\s]*n[\s]*i[\s]*c[\s]*i[\s]*o/i";
  $dotacion="/d[\s]*o[\s]*t[\s]*a[\s]*c[\s]*i[\s]*(o|ó)[\s]*n/i";
  $latitud="/l[\s]*a[\s]*t[\s]*i[\s]*t[\s]*u[\s]*d/i";
  $longitud="/l[\s]*o[\s]*n[\s]*g[\s]*i[\s]*t[\s]*u[\s]*d/i";

  $System_="/^[\s]*s[\s]*i[\s]*s[\s]*t[\s]*e[\s]*m[\s]*a[\s]*$/i";              
  $Hectare= "/((sup.)|(has.))/i";            
  $Investments_Date=  "/^[o]$/i"; 
  $RFC="/[\s]*r[\s]*f[\s]*c/i";         
  $CURP="/c[\s]*u[\s]*r[\s]*p/i";                            
  $INE= "/^[\s]*(i[\s]*n[\s]*e)[\s]*$/i";                 
  $Phone_Number= "/[\s]*(n[\s]*(u|ú)[\s]*m[\s]*e[\s]*r[\s]*o[\s]*)[\s]*(d[\s]*e){0,1}[\s]*([\s]*(t[\s]*e[\s]*l(e|é)[\s]*f[\s]*o[\s]*n[\s]*o[\s]*)|([\s]*c[\s]*e[\s]*l[\s]*u[\s]*l[\s]*a[\s]*r))/i";        
  $Tenant= "/[\s]*A[\s]*r{1,2}[\s]*e[\s]*n[\s]*d[\s]*a[\s]*t[\s]*a[\s]*r[\s]*i[\s]*o[\s]*/i";             
  $Email= "/(((correo)[\s]*(electr(o|ó)nico){0,1}) | email)/i";             
                                
  $array = array();
  for($indiceColumna = 1; $indiceColumna <= $numeroColumnas; $indiceColumna++){
        $Encabezado=$hoja->getCellByColumnAndRow($indiceColumna, 1);


     
        if(preg_match($programa,$Encabezado)){
        if(encabezadoRepetido($array,"Program")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Program");
      }else if(preg_match($usuario,$Encabezado)){
        if(encabezadoRepetido($array,"User")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("User");
      }else if(preg_match($lote,$Encabezado)){
        if(encabezadoRepetido($array,"Plot")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Plot");
      }else if(preg_match($colonia,$Encabezado)){
        if(encabezadoRepetido($array,"Cologne")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Cologne");
      }else if(preg_match($sector,$Encabezado)){
        if(encabezadoRepetido($array,"Type_User")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Type_User");
      }else if(preg_match($numeroTitulo,$Encabezado)){
        if(encabezadoRepetido($array,"Title_Number")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Title_Number");
      }else if(preg_match($vigencia,$Encabezado)){
        if(encabezadoRepetido($array,"Validity")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Validity");
      }else if(preg_match($prorroga,$Encabezado)){
        if(encabezadoRepetido($array,"Extend")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Extend");
      }else if(preg_match( $fecha_inicio,$Encabezado)){
        if(encabezadoRepetido($array,"Initial_Date")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Initial_Date");
      }else if(preg_match($dotacion,$Encabezado)){
        if(encabezadoRepetido($array,"Water_Supply")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Water_Supply");
      }else if(preg_match($latitud,$Encabezado)){
        if(encabezadoRepetido($array,"Latitude")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Latitude");
      }else if(preg_match($longitud,$Encabezado)){
        if(encabezadoRepetido($array,"Longitude")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Longitude");
      }else if(preg_match($System_,$Encabezado)){
        if(encabezadoRepetido($array,"System_")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("System_");
      }else if(preg_match($Hectare,$Encabezado)){
        if(encabezadoRepetido($array,"Hectare")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Hectare");
      }else if($Encabezado=="AÑO" || $Encabezado=="Año" || $Encabezado=="año"){
        if(encabezadoRepetido($array,"Investments_Date")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Investments_Date");
      }else if(preg_match($RFC,$Encabezado)){
        if(encabezadoRepetido($array,"RFC")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("RFC");
      }else if(preg_match($CURP,$Encabezado)){
        if(encabezadoRepetido($array,"CURP")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("CURP");
      }else if(preg_match($INE,$Encabezado)){
        if(encabezadoRepetido($array,"INE")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("INE");
      }else if(preg_match($Phone_Number,$Encabezado)){
        if(encabezadoRepetido($array,"Phone_Number")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Phone_Number");
      }else if(preg_match($Tenant,$Encabezado)){
        if(encabezadoRepetido($array,"Tenant")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Tenant");
      }else if(preg_match($Email,$Encabezado)){
        if(encabezadoRepetido($array,"Email")){return showError(4,$Encabezado);}
        $array[$indiceColumna]=array("Email");
      }else if($Encabezado != ""){
        return showError(1,$Encabezado,$indiceColumna);
      }else {
        return showError(2);
      }
  
    }
    return $array;
}
 function encabezadoRepetido($array,$Encabezado){
  if(isset($array)){
    foreach($array as $registro){
        if($registro[0] == $Encabezado){
          return true;
        }
    }
  }else{
    return false;
  }
}
 function formatExpression( $type, $expresion ){
  $expresion=preg_replace('/^[\s]+/', '', $expresion);
  $expresion=preg_replace('/([\s]+$)/', '', $expresion);
  $expresion=preg_replace('/[\'\"]/', '', $expresion);
  switch ($type) {
    case 'Latitude': return preg_replace('/[^\s\d]/', '', $expresion);               break;
    case 'Longitude':return preg_replace('/[^\s\d]/', '', $expresion);               break;
    case 'Type_User':  return preg_match("/(p.p)/i",$expresion) ? "Privado" : "Social";break;
    case 'Validity':$vigencia=preg_split("/[\s]+/", $expresion); return $vigencia[0];             break;
    case 'Initial_Date':
      $expresion=preg_replace('/[\s]+/', '', $expresion);
      $explode=preg_split("/(de)[l]*/i", $expresion);
      $day=$explode[0];
      $month= months($explode[1]);
      $year=$explode[2];
      return "$year-$month-$day";
    break;
  }
  return $expresion;
}
 function months($month){
  if(preg_match("/ene/i",$month)){return '01';}
  elseif(preg_match("/feb/i",$month)){return '02';}
  elseif(preg_match("/mar/i",$month)){return '03';}
  elseif(preg_match("/abr/i",$month)){return '04';}
  elseif(preg_match("/may/i",$month)){return '05';}
  elseif(preg_match("/jun/i",$month)){return '06';}
  elseif(preg_match("/jul/i",$month)){return '07';}
  elseif(preg_match("/ago/i",$month)){return '08';}
  elseif(preg_match("/sep/i",$month)){return '09';}
  elseif(preg_match("/oct/i",$month)){return '10';}
  elseif(preg_match("/nov/i",$month)){return '11';}
  elseif(preg_match("/dic/i",$month)){return '12';}
  return "01";
}
function FormatToFecha($date)
{
list($año, $mes, $dia) = explode('-', $date);

  switch ($mes){
    case "01":$mes="Enero";break;
    case "02":$mes="Febrero";break;
    case "03":$mes="Marzo";break;
    case "04":$mes="Abril";break;
    case "05":$mes="Mayo";break;
    case "06":$mes="Junio";break;
    case "07":$mes="Julio";break;
    case "08":$mes="Agosto";break;
    case "09":$mes="Septiembre";break;
    case "10":$mes="Octubre";break;
    case "11":$mes="Noviembre";break;
    case "12":$mes="Diciembre";break;
    
  }
  return "$dia de $mes del $año";
}
 function showError($num,$Encabezado="",$indiceColumna="",$indiceFila="",$expresion="",$numCaracteres=""){
    switch ($num){
      case 1:return "Error: No se puede leer el encabezado: ($Encabezado) columna($indiceColumna). No corresponde al formato de la tabla ".
                    ' <a href="#"type="button" class="btn btn-sm btn-outline-danger">Ver formato</a>';break;
      case 2:return "Error: No puede dejar encabezados vacios ni insertar información fuera de la tabla ".
                    '<a href="#"type="button" class="btn btn-sm btn-outline-danger">Ver formato</a>';break;
      case 3:return "Error: la expresión ($expresion) en Fila($indiceFila) y Columna($Encabezado) no es valida favor de revisar el formato".
                    ' <a href="#"type="button" class="btn btn-sm btn-outline-danger">Ver formato</a>';break;
      case 4:return "Error: El encabezado (<b>$Encabezado</b>) se ha repetido".
                    ' <a href="#"type="button" class="btn btn-sm btn-outline-danger">Ver formato</a>';break;
      case 5:return "Error: Fila($indiceFila) Columna($Encabezado) la expresión: ($expresion) puede tener $numCaracteres números de caracteres por máximo";break;
                  }
  }