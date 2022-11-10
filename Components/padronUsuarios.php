<?php require ('../Server/validityAdmin.php'); ?>
<link rel="stylesheet" href="css/padronUsuarios.css">
<script type="module" src ="js/padronUsuarios.js">

</script>
<input type="hidden" id="user-get" value="<?php echo empty($_POST['user']) ? "Sin usuario":$_POST['user'];?>">
<div class="primary-container">
<div class="container-tables">
		<div class="tables-user " >
            <h2 class=" title-tables-user" id="titulosConcesion">Padrón de usuarios</h2>
            <input type="search" class="input_search" placeholder="Buscar usuario ...">
            <div class="scroll-tables-user ">
            <table class="table table-hover " style=" margin-top: 10px; font-size:12px;">
                <thead class="thead-dark">
                    <tr>  
                      <th scope="col"> No.control             </th>
                      <th scope="col"> Usuario                </th>
                      <th scope="col"> Sector                 </th>
                      <th scope="col"> CURP                   </th>
                      <th scope="col"> RFC                    </th>
                      <th scope="col"> Ver                    </th>
                      <th scope="col"> Editar                 </th>
                      <th scope="col"> Eliminar               </th>
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

            <label for="Phone_Number" class="label_input">Teléfono</label>
            <input id="Phone_Number" name="Phone_Number" type="text" class="inputs_user" placeholder="Introduce el teléfono" required>
            <span class="message_num" id="Num_Phone_Number">0 / 200</span>

            <label for="Type_User" class="label_input"> Sector </label>
            <select id="Type_User"name="select" class="inputs_user">
              <option value="Privado" >Privado</option>
              <option value="Social" >Social</option>
            </select>
            <label for="RFC" class="label_input">RFC</label>
            <input id="RFC" name="RFC" type="text" class="inputs_user" placeholder="Introduce el RFC" required>
            <span class="message_num" id="Num_RFC">0 / 200</span>
 
            <label for="CURP" class="label_input">CURP</label>
            <input id="CURP" name="CURP" type="text" class="inputs_user" placeholder="Introduce el CURP" required>
            <span class="message_num" id="Num_CURP">0 / 200</span>

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