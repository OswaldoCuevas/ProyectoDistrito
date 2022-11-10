<?php

    Class Title extends Conexion{
        public function __construct(){
            parent::Conexion();
        }
      public function getTitleSpecific($Title_Number){
        $consulta ="SELECT * FROM view_titles_update where Title_Number='$Title_Number';";
        return  mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
      }
      public function getTitle($Title_Id){
        $consulta ="SELECT * FROM view_titles_update where Title_Id='$Title_Id';";
        return  mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
        
      }
      public function updateTitle($Title_Id, $Encabezado, $Value){
        $Value = $Value == "Sin registrar" ? "NULL" : "'$Value'";
        $this -> sistema -> query("UPDATE titles SET $Encabezado = $Value WHERE (Title_Id = '$Title_Id');");
      }
      public function existe($title){
        $consulta = "SELECT * FROM view_titles_update where Title_Number like '%$title%';";
        $fetch = $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
        
       return  $this -> sistema -> query($consulta) -> num_rows == 0 ? 0 :$fetch[0]['Title_Id'];
      }  
      public function addNewTitle($query,$cologne,$plot,$longitude,$latitude){
              $this -> sistema -> query("INSERT INTO titles $query ;");
                      
                  $id_=mysqli_query($this -> sistema,"SELECT LAST_INSERT_ID();");
                  $id=mysqli_fetch_assoc($id_);
                  $this -> addnewLocations($id['LAST_INSERT_ID()'],$cologne,$plot,$longitude,$latitude);
                        
      }
      public function addnewLocations($title,$cologne,$plot,$longitude,$latitude){
        $encabezado_location= "(Title_Id";
        $encabezado_location .= $cologne         == "Sin registrar" ? "" : ",cologne";
        $encabezado_location .= $plot            == "Sin registrar" ? "" : ",plot";
        $encabezado_location .= $longitude       == "Sin registrar" ? "" : ",longitude";
        $encabezado_location .= $latitude        == "Sin registrar" ? "" : ",latitude";
        $encabezado_location .= ")";
    
        $value_location="($title";
        $value_location .= $cologne         == "Sin registrar" ? "" : ",'".$cologne."'";
        $value_location .= $plot            == "Sin registrar" ? "" : ",'".$plot."'";
        $value_location .= $longitude       == "Sin registrar" ? "" : ",'".$longitude."'";
        $value_location .= $latitude        == "Sin registrar" ? "" : ",'".$latitude."'";
        $value_location .=")";
        $addLoactionTitle= "INSERT INTO location_title $encabezado_location VALUES $value_location;";
        $this -> sistema -> query($addLoactionTitle);
      }
      public function titleTransfer($title,$user_New){
        $Transfer_Date = date("Y-m-d H:i:s");
        $obtener_info_title = "SELECT * FROM titles where Title_Number='$title' AND Active = 1 ;";
        $fetch_obtener_info_title = $this -> sistema -> query($obtener_info_title) -> fetch_all(MYSQLI_ASSOC);
        $user_previous = $fetch_obtener_info_title[0]['User_Id'];
        $Title_Id= $fetch_obtener_info_title[0]['Title_Id'];
        $update_title="UPDATE titles SET User_Id = '$user_New' WHERE (Title_Id = '$Title_Id');";
        $insert_transfer = "INSERT INTO transfers_title (  Previous_User,     New_User,    Title_Id,   Transfer_Date  ) 
                            VALUES                      ( '$user_previous', '$user_New', '$Title_Id', '$Transfer_Date');";
        $this -> sistema -> query($insert_transfer) ;
        $this -> sistema -> query($update_title);

      }
      public function transfer_title($Title_Id,$New_User,$Previous_User,$Transfer_Date){
        $query1="UPDATE titles SET User_Id = '$New_User' WHERE (Title_Id = '$Title_Id');";
        $query2="UPDATE transfers_title SET Actual = '0' WHERE (Title_Id = '$Title_Id');";
        $query3="INSERT INTO transfers_title (Previous_User, New_User, Title_Id, Transfer_Date, Actual) 
                 VALUES ('$Previous_User', '$New_User', '$Title_Id', '$Transfer_Date', '1');";
                
        $this -> sistema -> query($query1);
        $this -> sistema -> query($query2);
        $this -> sistema -> query($query3);
       
       
       
      }
      public function saerchLocationWithtTitle($Title_Id){
        return $this -> sistema -> query(" SELECT * FROM location_title where Title_Id = '$Title_Id' AND Active = 1;") -> fetch_all(MYSQLI_ASSOC);
      }
      public function shotDownLocation ($Location_Id){
        $this -> sistema -> query("UPDATE location_title SET Active = '0' WHERE (Location_Id = '$Location_Id');");
      }
      public function changeLocationWhiteTitle($Title_Id, $Cologne, $Plot, $Longitude, $Latitude){
        $searchLocation = $this -> saerchLocationWithtTitle($Title_Id);
        $Location_Id =  $searchLocation[0]['Location_Id'];
        $this -> shotDownLocation ($Location_Id);
        $Encabezado = "(Title_Id";
            $Encabezado .= $Cologne         == "Sin registrar" ? "" : ",Cologne";
            $Encabezado .= $Plot            == "Sin registrar" ? "" : ",Plot";
            $Encabezado .= $Longitude       == "Sin registrar" ? "" : ",Longitude";
            $Encabezado .= $Latitude        == "Sin registrar" ? "" : ",Latitude";
        $Encabezado .= ")";

        $Value ="($Title_Id";
            $Value .= $Cologne         == "Sin registrar" ? "" : ",'$Cologne'";
            $Value .= $Plot            == "Sin registrar" ? "" : ",'$Plot'";
            $Value .= $Longitude       == "Sin registrar" ? "" : ",'$Longitude'";
            $Value .= $Latitude        == "Sin registrar" ? "" : ",'$Latitude'";
        $Value .= ")";
        $this -> sistema -> query("INSERT INTO location_title $Encabezado VALUES $Value;");
        $Transfer_Date = date("Y-m-d H:i:s");
        $new_location =  $this -> sistema -> query("SELECT LAST_INSERT_ID();") -> fetch_all(MYSQLI_ASSOC);
        $new_location_ID = $new_location[0]['LAST_INSERT_ID()'];
        $change = "INSERT INTO change_location ( Title_Id, Previous_Location, New_Location,Change_Date) VALUES ('$Title_Id', '$Location_Id', '$new_location_ID',' $Transfer_Date');";
        $this -> sistema -> query($change);
      } 
      public function changeLocationWhitDate($Title_Id, $Cologne, $Plot, $Longitude, $Latitude,  $Change_Date){
        $searchLocation = $this -> saerchLocationWithtTitle($Title_Id);
        $Location_Id =  $searchLocation[0]['Location_Id'];
        $this -> shotDownLocation ($Location_Id);
        $Encabezado = "(Title_Id";
            $Encabezado .= $Cologne         == "" ? "" : ",Cologne";
            $Encabezado .= $Plot            == "" ? "" : ",Plot";
            $Encabezado .= $Longitude       == "" ? "" : ",Longitude";
            $Encabezado .= $Latitude        == "" ? "" : ",Latitude";
        $Encabezado .= ")";

        $Value ="($Title_Id";
            $Value .= $Cologne         == "" ? "" : ",'$Cologne'";
            $Value .= $Plot            == "" ? "" : ",'$Plot'";
            $Value .= $Longitude       == "" ? "" : ",'$Longitude'";
            $Value .= $Latitude        == "" ? "" : ",'$Latitude'";
        $Value .= ")";
        $this -> sistema -> query("INSERT INTO location_title $Encabezado VALUES $Value;");
        $new_location =  $this -> sistema -> query("SELECT LAST_INSERT_ID();") -> fetch_all(MYSQLI_ASSOC);
        $new_location_ID = $new_location[0]['LAST_INSERT_ID()'];
        $change = "INSERT INTO change_location ( Title_Id, Previous_Location, New_Location,Change_Date) VALUES ('$Title_Id', '$Location_Id', '$new_location_ID','$Change_Date');";
        $this -> sistema -> query($change);
      } 
      public function changeLocation($Location_Id, $Encabezado, $Value){
        $this -> sistema -> query("UPDATE location_title SET $Encabezado = $Value WHERE (Location_Id = '$Location_Id');");
      }
      public function getTitles(){
        $consulta ="SELECT * FROM view_titles_update;";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);

      }
      public function jsonTitles($busqueda){
        $consulta ="SELECT * FROM view_titles_update 
                    where Title_Number  like '%$busqueda%'
                    or    Cologne       like '%$busqueda%'
                    or    Plot          like '%$busqueda%'
                    or    Full_Name     like '%$busqueda%';";
        return  json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
      }
      public function searchTitles($busqueda){
        $consulta ="SELECT * FROM view_titles_update 
                    where Title_Number  like '%$busqueda%'
                    or    Cologne       like '%$busqueda%'
                    or    Plot          like '%$busqueda%'
                    or    Full_Name     like '%$busqueda%';";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
      }
      public function dropTitle($Title_Id){
        $this -> sistema -> query("UPDATE titles SET Active = '0' WHERE (Title_Id = '$Title_Id');");
        echo "3";
      }
      public function consultTransferTitle($Title_Id){

        $consulta ="SELECT * FROM view_transfer_title where Title_Id='$Title_Id';";
        return  mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);;
      
      }
      public function getTransferThousandsSpecific($Title_Id){
        $consulta = "SELECT * FROM view_transfer_thousands where SetTitleId='$Title_Id' or GetTitleId='$Title_Id';";
        return mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);

      }
      public function getChangelocation($Title_Id){
        $consulta = "SELECT * FROM view_change_location where Title_Id = '$Title_Id';";
        return mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);

      }
      public function dropTransferTitle($Transfers_Id){
          $this -> sistema -> query("UPDATE transfers_title SET Actual = '0' WHERE (Transfers_Id = '$Transfers_Id');");
          $this -> sistema -> query("UPDATE transfers_title SET Active = '0' WHERE (Transfers_Id = '$Transfers_Id');");
      }
      public function dropTransferThousand($Transfers_Id){
        $this -> sistema -> query("UPDATE transfers_thousands SET Active = '0' WHERE (Transfers_Id = '$Transfers_Id');");
      }
      public function dropChangeLocation($Change_Id){
        $this -> sistema -> query("UPDATE change_location SET Active = '0' WHERE (Change_Id = '$Change_Id');");
      }
      public function transfer_thousand($SetTitle, $GetTitle, $Date_Start, $Date_End, $Amount){
        $query = "  INSERT INTO transfers_thousands(SetTitle, GetTitle,Date_Start, Date_End, Amount) 
                    VALUES ('$SetTitle', '$GetTitle', '$Date_Start', '$Date_End', '$Amount');";
        $this -> sistema -> query($query);
      }
      }
    
   
?>