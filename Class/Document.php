<?php
 
  require ('../Functions/FunctionDocuments.php');
  require ('../Library/vendor/autoload.php');

  use PhpOffice\PhpSpreadsheet\IOFactory;
  use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
  
  class Document extends Conexion{
  
    
      
      public function __construct(){
          parent::Conexion();
      }

      public function setInfoDocuments($document, $name, $type, $year){
        $Array =            $this -> AnalizarFormato($document,false);
        $id_documento =     $this -> setDocument($name,$type,$year);
        
        for($i=1;$i<count($Array[1]) ;$i++){
          $Info=    array();
          $Column=  array();

          for($k=1;$k<=count($Array); $k++){
            if($Array[$k][$i]!=" "){
              $Info[$k-1]="'".$Array[$k][$i]."'";
              $Column[$k-1]=$Array[$k][0];
            }
          }  
          $this -> insertInfo($id_documento,join(",",$Info),join(",",$Column));  
        }
        return "Analizado y Guardado";
      }

      public function editInfoDocument($Id_Info,$Value,$Encabezado){
        $consulta = "UPDATE document_info SET $Encabezado = $Value WHERE (Info_Id = '$Id_Info');";
        mysqli_query($this -> sistema  ,$consulta);
        return 0;
      }
      public function getTitles($id){
        
        $consulta ="SELECT * FROM document_type_titles where Document_Id='$id';";
        return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
      }

      public function getTitleSpecific($Info_Id){
        $consulta ="SELECT * FROM document_type_titles where Info_Id=$Info_Id;";
        return  json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
      }
      public function getUserSpecific($Info_Id){
        $consulta ="SELECT * FROM document_users where Info_Id=$Info_Id;";
        return  json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
      }

      public function getTitlesEspcific($search){
        return $this -> sistema -> query("SELECT * FROM document_info where Program = '$search';") -> fetch_all(MYSQLI_ASSOC);
      }

      public function ShowUpdatesTitle($Document_Id,$User,$Cologne,$Plot,$Title_Number,$Initial_Date,$Water_Supply,$Longitude,$Latitude,$Validity,$Extend){
              
           $User            =        $User          != "" ? "LIKE '%$User%'":"IS NULL";
           $Cologne         =        $Cologne       != "" ? "LIKE '%$Cologne%'":"IS NULL";
           $Plot            =        $Plot          != "" ? "LIKE '%$Plot%'":"IS NULL";
           $Title_Number    =        $Title_Number  != "" ? "LIKE '%$Title_Number%'":"IS NULL";
           $Initial_Date    =        $Initial_Date  != "" ? "LIKE '%$Initial_Date%'":"IS NULL";
           $Water_Supply    =        $Water_Supply  != "" ? "LIKE '%$Water_Supply%'":"IS NULL";
           $Longitude       =        $Longitude     != "" ? "LIKE '%$Longitude%'":"IS NULL";
           $Latitude        =        $Latitude      != "" ? "LIKE '%$Latitude%'":"IS NULL";
           $Validity        =        $Validity      != "" ? "LIKE '%$Validity%'":"IS NULL";
           $Extend          =        $Extend        != "" ? "LIKE '%$Extend%'":"IS NULL";

            $cons =  "SELECT * FROM  view_titles_update where 
                
                Full_Name       $User
            AND Cologne         $Cologne
            AND Plot            $Plot
            AND Title_Number    $Title_Number
            AND Initial_Date    $Initial_Date
            AND Water_Supply    $Water_Supply
            AND Longitude       $Longitude
            AND Latitude        $Latitude
            AND validity        $Validity
            AND Extend          $Extend
      ;";
      
               return  $this -> sistema -> query($cons) -> fetch_all(MYSQLI_ASSOC);
      
      }
      public function ShowUpdatesInvestments($User,$Cologne,$Plot,$Hectare,$Investments_Date,$System_  ){
              
        $User                         =        $User                      != "" ? "LIKE '%$User%'":"IS NULL";
        $Cologne                      =        $Cologne                   != "" ? "LIKE '%$Cologne%'":"IS NULL";
        $Plot                         =        $Plot                      != "" ? "LIKE '%$Plot%'":"IS NULL";
        $System_                      =        $System_                   != "" ? "LIKE '%$System_%'":"IS NULL";
        $Hectare                      =         $Hectare                  != "" ? "LIKE '%$Hectare%'":"IS NULL";
        $Investments_Date             =        $Investments_Date          != "" ? "LIKE '%$Investments_Date%'":"IS NULL";
    

         $cons =  "SELECT * FROM  view_investments where 
             
             Full_Name            $User
         AND Cologne              $Cologne
         AND Plot                 $Plot
         AND System_              $System_
         AND Hectare              $Hectare
         AND Investments_Date     $Investments_Date
   ;";
   
            return  $this -> sistema -> query($cons) -> fetch_all(MYSQLI_ASSOC);
   
   }
      public function ShowUpdatesUser($Document_Id,$Full_Name,$Phone_Number,$Email,$RFC,$CURP){
              
        $User               =        $Full_Name     != "" ? "LIKE '%$Full_Name%'":"IS NULL";
        $Phone_Number       =        $Phone_Number  != "" ? "LIKE '%$Phone_Number%'":"IS NULL";
        $Email              =        $Email         != "" ? "LIKE '%$Email%'":"IS NULL";
        $RFC                =        $RFC           != "" ? "LIKE '%$RFC%'":"IS NULL";
        $CURP               =        $CURP          != "" ? "LIKE '%$CURP%'":"IS NULL";
 

         $cons =  "SELECT * FROM  users where 
             
             Full_Name     $User
         AND Phone_Number  $Phone_Number
         AND Email         $Email
         AND RFC           $RFC
         AND CURP          $CURP
         ;
   ;";

            return  $this -> sistema -> query($cons) -> fetch_all(MYSQLI_ASSOC);
   
   }
      public function setUsers(){

      }

      public function getUsers($id){
        $consulta ="SELECT * FROM document_users where Document_Id='$id';";
        return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
      }
      public function searchUsers($id,$buscar){
        $consulta ="SELECT * FROM document_users 
        WHERE Document_Id='$id'
        AND
        (user 
        LIKE '%$buscar%'
        );";
      return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    }
      public function serInvestments(){
        
      }

      public function getInvestments($id){
        $consulta ="SELECT * FROM document_type_investments where Document_Id='$id';";
        return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    
      }

      public function setDocument($name, $type, $year ){
        mysqli_query($this -> sistema,"INSERT INTO Documents(Document_Name,Document_Type,Document_Year) 
        VALUES ('$name','$type',$year);");
        $id_=mysqli_query($this -> sistema,"SELECT LAST_INSERT_ID();");
        $id=mysqli_fetch_assoc($id_);
        return $id['LAST_INSERT_ID()'];  
      
      }

      public function getDocument($id){
        
        return $this -> sistema -> query("SELECT * FROM documents where Document_Id = '$id';") -> fetch_all(MYSQLI_ASSOC);
      }

      public function getDocumentTitles(){
        return $this -> sistema -> query("SELECT * FROM documents where Document_Type = 'Títulos'") -> fetch_all(MYSQLI_ASSOC);
      }
      public function getDocumentUsers(){
        return $this -> sistema -> query("SELECT * FROM documents where Document_Type = 'Padrón de usuarios'") -> fetch_all(MYSQLI_ASSOC);
      }
      public function getDocumentInvestments(){
        return $this -> sistema -> query("SELECT * FROM documents where Document_Type = 'Inversiones'") -> fetch_all(MYSQLI_ASSOC);
      }

      public function insertInfo($id,$info,$column){
        mysqli_query($this -> sistema,"INSERT INTO Document_Info(Document_Id,$column) VALUES ($id,$info);");
        
      }

      public function AnalizarFormato($document,$analizando){
        $document = IOFactory::load($document);
        $hoja = $document->getSheet(0);
        $letra = $hoja->getHighestColumn();


        $numeroColumnas = Coordinate::columnIndexFromString($letra);
        $numeroFilas=$hoja->getHighestDataRow();
        $Tabla= getEncabezado($hoja,$numeroColumnas);
        if(!is_array($Tabla)){
          return $Tabla;
        }
       
        
   
        $fila=1;
        for ($indiceFila = 2; $indiceFila <= $numeroFilas; $indiceFila++)
        {
          for($indiceColumna = 1; $indiceColumna <= $numeroColumnas; $indiceColumna++)
          {
            $registro = $hoja -> getCellByColumnAndRow($indiceColumna,$indiceFila); 
            if($registro!="")
            {
              
              $type = $Tabla[$indiceColumna][0];
              if(!formatCorrect($type , "".$registro))
              {
                return  showError(3,$Tabla[$indiceColumna][0],$indiceColumna,$indiceFila,$registro);
              }
 
                
                  if(strlen(formatExpression($type, $registro))>limitVarchar($type)){
                    return showError(5,$type,"",$indiceFila,$registro,limitVarchar($type));
                  }
              
              $Tabla[$indiceColumna][$fila]=formatExpression($type, $registro);
            
            }else if($indiceColumna==1){
              $fila--;
              break;
            }else{
              $Tabla[$indiceColumna][$fila]=" ";
            }
         }
         $fila++;
       }

        return $analizando ?"Analizado":$Tabla;
      }
   
      public function searchTitles($id,$buscar){
          $consulta ="SELECT * FROM document_type_titles 
          WHERE Document_Id='$id'
          AND
          (user 
          LIKE '%$buscar%'
          or Plot
          LIKE '%$buscar%'
          or Title_Number
          LIKE '%$buscar%'
          or Cologne
          LIKE '%$buscar%'
          );";
        return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
      }
      
  }   

?>