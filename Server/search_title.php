<?php
$busqueda = $_GET['busqueda'];
require ('conexion.php');
require('../Class/Title.php');
$Title = new Title();
$registros = $Title -> searchTitles($busqueda);
if(is_array($registros)){
   
   
    
    $imprimir = '
                    <table class="table table_swat2">
                    <thead>
                        <tr>
                        <th scope="col">No. título</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Colonia</th>
                        <th scope="col">lote</th>
                        </tr>
                    </thead>
                    <tbody>';
    foreach($registros as $registro){
        $title_number   = $registro['Title_Number'];
        $title_id       = $registro['Title_Id'];
        $user           = $registro['Full_Name'];
        $cologne        = $registro['Cologne'];
        $plot           = $registro['Plot'];

        $imprimir .='  <tr class="selected_user" id="user_'.$title_id.'">
                            <th scope="row">'.$title_number.'</th>
                            <th scope="row">'.$user.'</th>
                            <th scope="row">'.$cologne.'</th>
                            <th scope="row">'.$plot.'</th>
                        </tr>
                        <input type="hidden" id="value_input_search_user_'.$title_id.'" value="'.$title_number.'">
                        <input type="hidden" id="input_search_user" value="">
                        <input type="hidden" id="user_name_'.$title_id.'" value="'.$user.'">';
                        
    }
        $imprimir .='    
    </tbody>
    </table>';
}else{
$imprimir= "No se encontraron coincidencias";
}

echo json_encode(array('ok' => $imprimir));
?>