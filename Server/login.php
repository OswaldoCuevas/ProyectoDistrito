<?php
    require ('conexion.php');
    require('../Class/Users.php');

    $User = new Users();
    $response = $User-> loginAdmin($_POST['Email'],$_POST['Password']);
 
    if($response != "2" && $response != "3"){
      session_start();
      $_SESSION['Control_Num'] = $response[0]['Control_Num'];
      $_SESSION['Full_Name'] = $response[0]['Full_Name'];
      $_SESSION['Type_User'] = $response[0]['Type_User'];
      echo "1";
    }else{
        echo $response;
    }
?>