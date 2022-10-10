<?php
    require ('conexion.php');
    require('../Class/Users.php');
if (isset($_POST['Operation'])){
  
    switch ($_POST['Operation']){
        case 'Register' :   register(); break;
        case 'Update'   :   update();   break;
        case 'Delete'   :   drop();     break;
    }
}
function register(){
    $User   = new Users();
    $Full_Name      = $_POST['Full_Name'];
    $Email          = $_POST['Email'];
    $Password_User  = $_POST['Password_User'];
    $User -> insertAdmin($Full_Name, $Email, $Password_User) ;
  
}
function update(){
    $User   = new Users();
    $Control_Num    = $_POST['Control_Num'];
    $Full_Name      = $_POST['Full_Name'];
    $Email          = $_POST['Email'];
    $Password_User  = $_POST['Password_User'];

    $User -> AlterAdmin($Control_Num,$Full_Name, $Email, $Password_User) ;
  
}
function drop(){
    $User   = new Users();
    $Control_Num    = $_POST['Control_Num'];
    $User -> dropAdmin($Control_Num);
  
}
