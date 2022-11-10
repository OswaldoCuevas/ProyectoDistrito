<?php require ('../Server/validityAdmin.php'); ?>
<link rel="stylesheet" href="css/Titulos.css">
<script type = "module" src="js/inversiones.js"></script>
<input type="hidden" id="user-get" value="<?php echo empty($_POST['user']) ? "Sin usuario":$_POST['user'];?>">
<div class="primary-container">
    <div class="container-tables">
        <div class="tables-user" >
            <h2 class=" title-tables-user" id="titulosConcesion">Inversiones</h2>
            <input type="search" class="input_search" placeholder="Buscar usuario ...">
            <div class="scroll-tables-user ">
                <table class="table table-hover " style=" margin-top: 10px; font-size:12px;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">    </th>
                            <th scope="col"> Usuario      </th>
                            <th scope="col"> Lote         </th>
                            <th scope="col"> Colonia      </th>
                            <th scope="col"> Sistema      </th>
                            <th scope="col"> Hectareas    </th>
                            <th scope="col"> Año          </th>
                            <th scope="col"> Ver          </th>
                            <th scope="col"> Editar       </th>
                            <th scope="col"> Eliminar     </th>
                            
                        </tr>
                    </thead>
                    <tbody class="load_titles">
                        
                            
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
                <label for="Investments_Id" class="label_input">Id de inversion</label>
                <input id="Investments_Id" name="Investments_Id" type="text" class="inputs_user" placeholder="Generado automaticamente" disabled>

                <label for="User" class="label_input">Usuario del padrón</label>
                <button id="User" name="User" type="text" class="inputs_user" style="background-color:white; text-align: left;">Selecciona usuario</button>
                <input type="hidden" id="User_id">
                <input type="hidden" id="User_Name">
                
                <label for="Plot" class="label_input">Lote</label>
                <input id="Plot" name="Plot" type="text" class="inputs_user" placeholder="Introduce el lote" >
                <span class="message_num" id="Num_Plot">0 / 30</span>

                <label for="Cologne" class="label_input">Colonia</label>
                <input id="Cologne" name="Cologne" type="text" class="inputs_user" placeholder="Introduce la colonia" >
                <span class="message_num" id="Num_Cologne">0 / 30</span>

                <label for="System_" class="label_input">Sistema</label>
                <input id="System_" name="System_" type="text" class="inputs_user" placeholder="Introduce el sistema" >
                <span class="message_num" id="Num_System_">0 / 100</span>

                <label for="Hectare" class="label_input">Hectarea</label>
                <input type = "Number" id="Hectare" name="Hectare" type="text" class="inputs_user" placeholder="Introduce las hectareas " >
                <span class="message_num" id="Num_Hectare">0 / 20</span>

                <label for  = "Investments_Date" class="label_input">Año</label>
                <input type = "Number" value="2015" min = "1000" id="Investments_Date" name="Investments_Date" type="text" class="inputs_user" placeholder="Introduce el año con 4 digitos" >
                <span class="message_num" id="Num_Investments_Date">4 / 4</span>

    
            </div>
        </div>
        <div class="user_footer"></div>
    </div>
</div>