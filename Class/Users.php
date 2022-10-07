<?php
class Users extends Conexion{

    public function __construct(){
        parent::Conexion();
    }

    public function getUserForName($name){
        $consulta ="SELECT * FROM Padron_de_Usuarios where Full_Name like '%$name%';";

        return $this -> sistema -> query($consulta) -> num_rows < 1 ? 0 : $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    }
    public function getUser($Control_Num){
        $consulta ="SELECT * FROM Padron_de_Usuarios where Control_Num='$Control_Num';";
        $user = $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
        return  $user[0];
    }
    public function getUsers(){
        $consulta ="SELECT * FROM Padron_de_Usuarios;";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    }
    public function getUsersPrivados(){
        $consulta ="SELECT * FROM Padron_de_Usuarios WHERE Type_User='Privado';";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    }
    
    public function getUsersSociales(){
        $consulta ="SELECT * FROM Padron_de_Usuarios WHERE Type_User='Social';";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
    }
    public function getTitlesUser($User_Id){
      return $this -> sistema -> query("SELECT * from view_titles_update WHERE User_Id = '$User_Id';") -> fetch_all(MYSQLI_ASSOC);  
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
       $consulta = "SELECT * FROM Padron_de_Usuarios where Full_Name like '%$user_name%';";
       $fetch = $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
       
      return  $this -> sistema -> query($consulta) -> num_rows == 0 ? 0 :$fetch[0]['Control_Num'];
    }

    public function searchControlNumberWithName($name){

    }
    public function getUserSpecific($User){
        $consulta ="SELECT * FROM Padron_de_Usuarios where Full_Name='$User';";
        return  mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) <= 0 ? 0 : json_encode($this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC));
        
        }
    
        public function updateUser($User_Id, $Encabezado, $Value){
            $Value = $Value == "Sin registrar" ? "NULL" : "'$Value'";
            $this -> sistema -> query("UPDATE users SET $Encabezado = $Value WHERE (Control_Num = '$User_Id');");
            }
        public function jsonUsers($busqueda){
            return  json_encode($this -> sistema -> query("SELECT * FROM Padron_de_Usuarios where Full_Name like '%$busqueda%';") -> fetch_all(MYSQLI_ASSOC));
        }

        public function insertUser($Full_Name, $Email, $Password_User,$Phone_Number,$Type_User,$CURP,$RFC){
            $Encabezado  = "(Full_Name";
            $Encabezado .= $Email           == null ?   "":",Email";
            $Encabezado .= $Password_User   == null ?   "":",Password_User";
            $Encabezado .= $Phone_Number    == null ?   "":",Phone_Number";
            $Encabezado .= $Type_User       == null ?   "":",Type_User";
            $Encabezado .= $CURP            == null ?   "":",CURP";
            $Encabezado .= $RFC             == null ?  "":",RFC";
            $Encabezado .= ")";
        
            $Values = "('$Full_Name'";
            $Values.= $Email           == null ?   "":",'$Email'";
            $Values.= $Password_User   == null ?   "":",SHA('$Password_User')";
            $Values.= $Phone_Number    == null ?   "":",'$Phone_Number'";
            $Values.= $Type_User       == null ?   "":",'$Type_User'";
            $Values.= $CURP            == null ?   "":",'$CURP'";
            $Values.= $RFC             == null ?   "":",'$RFC'";
            $Values.= ")";

           
             if(mysqli_num_rows(mysqli_query($this -> sistema,"SELECT * FROM Padron_de_Usuarios Where Full_Name ='$Full_Name'")) > 0){
               
                echo "1";
             }else{
                echo "0";
                $this -> sistema -> query("INSERT INTO Users $Encabezado VALUES $Values;");
             }
           
        }

        public function AlterUser($Control_Num, $Full_Name, $Email, $Password_User,$Phone_Number,$Type_User,$CURP,$RFC){
         
            $Full_Name      = $Full_Name        == null ? "null":"'$Full_Name'";
            $Email          = $Email            == null ? "null":"'$Email'";
            $Password_User  = $Password_User    == null ? "null":"SHA('$Password_User')";
            $Phone_Number   = $Phone_Number     == null ? "null":"'$Phone_Number'";
            $Type_User      = $Type_User        == null ? "null":"'$Type_User'";
            $CURP           = $CURP             == null ? "null":"'$CURP'";
            $RFC            = $RFC              == null ? "null":"'$RFC'";

            $update="UPDATE users SET 
                            Full_Name       = $Full_Name,
                            Phone_Number    = $Phone_Number, 
                            Email           = $Email, 
                            Password_User   = $Password_User, 
                            RFC             = $RFC , 
                            CURP            = $CURP, 
                            Type_User       = $Type_User 
                            WHERE (Control_Num = '$Control_Num');";
            $this -> sistema -> query($update);
            echo "2";
   
    }
    public function dropUser($Control_Num){
        $this -> sistema -> query("UPDATE users SET Activo = '0' WHERE (Control_Num = '$Control_Num');");
        echo "3";
    }
    public function loginAdmin($id,$password){
        

            $consulta="SELECT * FROM Administradores 
                       WHERE (Email = '$id' AND Email IS NOT NULL) 
                       OR    (Control_Num = '$id' AND Control_Num IS NOT NULL);";
            if(mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) > 0){
          
                $consulta="SELECT * FROM Administradores 
                           WHERE (Password_User = SHA('$password') 
                           AND    Password_User IS NOT NULL) ;";
               if(mysqli_num_rows(mysqli_query($this -> sistema,$consulta)) > 0){
               return $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);
               } else{
               return "3";
               }

            }else{
                return "2";
            }
        
    }
    public function getPadronDeUsuarios(){
        $consulta ="SELECT * FROM consult_Padron;";
        return  $this -> sistema -> query($consulta) -> fetch_all(MYSQLI_ASSOC);

    }
}
?>