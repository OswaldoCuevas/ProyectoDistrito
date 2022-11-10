<?php
    require ('conexion.php');
    require('../Class/Users.php');
    require ('validityAdmin.php');

if (isset($_POST['Operation'])){
  
    switch ($_POST['Operation']){
        case 'Register' :   register(); break;
        case 'Update'   :   update();   break;
        case 'Delete'   :   drop();     break;
    }
}
function register(){
    $User   = new Users();
    $Control_Num    = $_POST['Control_Num'];
    $Full_Name      = $_POST['Full_Name'];
    $Email          = $_POST['Email'];
    $Password_User  = $_POST['Password_User'];
    $Phone_Number   = $_POST['Phone_Number'];
    $Type_User      = $_POST['Type_User'];
    $CURP           = $_POST['CURP'];
    $RFC            = $_POST['RFC'];
    $User -> insertUser($Full_Name, $Email, $Password_User,$Phone_Number,$Type_User,$CURP,$RFC) ;
  
}
function update(){
    $User   = new Users();
    $Control_Num    = $_POST['Control_Num'];
    $Full_Name      = $_POST['Full_Name'];
    $Email          = $_POST['Email'];
    $Password_User  = $_POST['Password_User'];
    $Phone_Number   = $_POST['Phone_Number'];
    $Type_User      = $_POST['Type_User'];
    $CURP           = $_POST['CURP'];
    $RFC            = $_POST['RFC'];
    $User -> AlterUser($Control_Num,$Full_Name, $Email, $Password_User,$Phone_Number,$Type_User,$CURP,$RFC) ;
  
}
function drop(){
    $User   = new Users();
    $Control_Num    = $_POST['Control_Num'];
    $User -> dropUser($Control_Num);
  
}
