<?php
include '../Server/conexion.php';
include '../Class/Users.php';
require ('../Server/validityAdmin.php');
$Users = new Users();
if($Users -> getNumRowsAdmin($_SESSION['Control_Num'])==0){
    header('location: menu.php');
}
?>
<link rel="stylesheet" href="css/padronUsuarios.css">
<script type="module" src="js/administradores.js"></script>
<div class="primary-container">
<div class="container-tables">
		<div class="tables-user " >
            <h2 class=" title-tables-user" id="titulosConcesion">Administradores</h2>
            <input type="search" class="input_search" placeholder="Buscar usuario ...">
            <div class="scroll-tables-user ">
            <table class="table table-hover " style=" margin-top: 10px;">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col"> Activo           </th>
                      <th scope="col"> No. Control    </th>
                      <th scope="col"> Administrador        </th>
                      <th scope="col"> Correo           </th>
                      <th scope="col"> Editar           </th>
                      <th scope="col"> Eliminar         </th>
                    </tr>
                </thead>
                <tbody class="load_users">
                    
                          
                </tbody>
            </table>
            <div class="cargando">
            <lottie-player src="animations/load.json"   style="width: 200px; height: 200px;" loop  autoplay></lottie-player>
            </div>
            
               
          
        </div>
           
	</div>     
</div>
<div class="user_info">
    
       
        <div class="user_header"><h4 class="text_operation"></h4></div>
        <div class="user_body">
          <div class="container_body">
            <label for="Control_Num" class="label_input">Número de control</label>
            <input id="Control_Num" name="Control_Num" type="text" class="inputs_user" placeholder="Generado automaticamente" disabled>

            <label for="Full_Name" class="label_input">Nombre</label>
            <input id="Full_Name" name="Full_Name" type="text" class="inputs_user" placeholder="Introduce el nombre" required>
            <span class="message_num" id="Num_Full_Name">0 / 400</span>

            <label for="Email" class="label_input"> Correo electrónico</label>
            <input id="Email" name="Email" type="text" class="inputs_user" placeholder="Introduce el Correo electrónico" required>
            <span class="message_num" id="Num_Email">0 / 200</span>

            <label for="Password_User" class="label_input">Contraseña</label>
              <div class="password">
                  <input id="Password_User" name="Password_User" type="text" class="inputs_user" placeholder="Introduce la contraseña" required>
                  <button id="generar_password"><i class="fa-solid fa-key"></i></button>
              </div>
              <span class="message_num" id="Num_Password_User">0 / 50</span>
   
            </div>
        </div>
        <div class="user_footer">
        </div>
   
</div>
</div>