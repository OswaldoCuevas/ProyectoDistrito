<?php
class Users extends Conexion{

    public function __construct(){
        parent::Conexion();
    }

    public function getUserForName($name){
        $consulta ="SELECT * FROM Users where Full_Name like '%$name%';";

        return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    }
    public function addUserWithName($name){
       
        $consulta =" INSERT INTO users (Full_Name) VALUES ('$name');";
        return $this -> sistema -> query($consulta) ;
    }
    public function addUserWithNameAndType($name ,$type){
       
        $consulta =" INSERT INTO users (Full_Name, Type_User) VALUES ('$name', '$type');";
        return $this -> sistema -> query($consulta) ;
    }

    public function existe($user_name){
       $consulta = "SELECT * FROM users where Full_Name like '%$user_name%';";
       $fetch = $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
       
      return  $this -> sistema -> query($consulta) -> num_rows == 0 ? 0 :$fetch[0]['Control_Num'];
    }

    public function searchControlNumberWithName($name){

    }
    public function getUserSpecific($User){
        $consulta ="SELECT * FROM users where Full_Name='$User';";
        return  mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
        
        }
    
        public function updateUser($User_Id, $Encabezado, $Value){
            $Value = $Value == "Sin registrar" ? "NULL" : "'$Value'";
            $this -> sistema -> query("UPDATE users SET $Encabezado = $Value WHERE (Control_Num = '$User_Id');");
            }
}
?>