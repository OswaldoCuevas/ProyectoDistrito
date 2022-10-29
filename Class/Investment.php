<?php
class Investment extends Conexion{
    public function __construct(){
        parent::Conexion();
    }
    public function getInvestmentSpecific($User,$Cologne,$Plot,$Investments_Date){
        $consulta ="SELECT * FROM view_investments where Full_Name='$User' AND Cologne LIKE '%$Cologne%' AND Plot LIKE '%$Plot%' AND Investments_Date='$Investments_Date';";
        return  mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
        
        }
    public function updateInvestment($Investments_Id,$User_Id, $Cologne,$Plot,$System_,$Hectare,$Investments_Date){
        $Encabezado  = "User_Id = '$User_Id'  ";
        $Encabezado .= $Cologne             == "Sin registrar" ? ", Cologne          = null" : ", Cologne           = '$Cologne'";
        $Encabezado .= $Plot                == "Sin registrar" ? ", Plot             = null" : ", Plot              = '$Plot'";
        $Encabezado .= $System_             == "Sin registrar" ? ", System_          = null" : ", System_           = '$System_'";
        $Encabezado .= $Hectare             == "Sin registrar" ? ", Hectare          = null" : ", Hectare           = '$Hectare'";
        $Encabezado .= $Investments_Date    == "Sin registrar" ? ", Investments_Date = null" : ", Investments_Date  = '$Investments_Date'";
        $cons ="UPDATE investments SET  $Encabezado WHERE (Investments_Id = '$Investments_Id');";
        echo $cons;
        $this -> sistema -> query($cons);
        }
         
    public function addUserWithId($id_user){
    $this -> sistema -> query("INSERT INTO investments (User_Id) VALUES ('$id_user');");
        $id_=mysqli_query($this -> sistema,"SELECT LAST_INSERT_ID();");
        $id=mysqli_fetch_assoc($id_);
        return $id['LAST_INSERT_ID()']; 
    }
    
    
    public function getInversiones(){
        $consulta ="SELECT * FROM inversiones;";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);

    }
    public function jsonInvestments($busqueda){
        $consulta ="SELECT * FROM inversiones 
                    where Cologne       like '%$busqueda%'
                    or    Plot          like '%$busqueda%'
                    or    Full_Name     like '%$busqueda%';";
        return  json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
      }
      public function dropInvestment($Investments_Id){
        $this -> sistema -> query("UPDATE investments SET Active = '0' WHERE (Investments_Id = '$Investments_Id');");
      }
}