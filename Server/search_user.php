<?php
$user = $_GET['user'];
require ('conexion.php');
require('../Class/Users.php');
$Users = new Users();
$registros = $Users -> getUserForName($user);
if(is_array($registros)){
   
   
    
    $imprimir = '
                    <table class="table table_swat2">
                    <thead>
                        <tr>
                        <th scope="col">Número de control</th>
                        <th scope="col">Nombre del Usuario</th>
                        </tr>
                    </thead>
                    <tbody>';
    foreach($registros as $registro){
        $user = $registro['Full_Name'];
        $Control_Num = $registro['Control_Num'];
        $imprimir .='  <tr class="selected_user" id="user_'.$Control_Num.'">
                            <th scope="row">2022001</th>
                            <th scope="row">'.$user.'</th>
                        </tr>
                        <input type="hidden" id="value_input_search_user_'.$Control_Num.'" value="'.$user.'">
                        <input type="hidden" id="input_search_user" value="">';
    }
        $imprimir .='    
    </tbody>
    </table>';
}else{
$imprimir= "No se encontraron coincidencias";
}

echo json_encode(array('ok' => $imprimir));
?>