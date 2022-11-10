<?php require ('../Server/validityAdmin.php'); ?>
<link rel="stylesheet" href="css/Titulos.css">
<script type = "module" src="js/titulos.js"></script>
<div class="primary-container">
    <div class="container-tables">
            <div class="tables-user " >
                <h2 class=" title-tables-user" id="titulosConcesion">Títulos de concesión</h2>
                <input type="search" class="input_search" placeholder="Buscar usuario ...">
                <div class="scroll-tables-user ">
                <table class="table table-hover " style=" margin-top: 10px; font-size:12px;">
                    <thead class="thead-dark" >
                        <tr>
                        <th scope="col"> Título       </th>
                        <th scope="col"> Usuario      </th>
                        <th scope="col"> Lote         </th>
                        <th scope="col"> Colonia      </th>
                        <th scope="col"> Vigencia      </th>
                        <th scope="col"> Fecha de inicio      </th>
                        <th scope="col"> Dotación      </th>
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
    <div class="user_info ">
        
        
            <div class="user_header"><h4 class="text_operation"></h4></div>
            <div class="user_body">
            <div class="container_body">
                <label for="Title_Id" class="label_input">Id de título</label>
                <input id="Title_Id" name="Title_Id" type="text" class="inputs_user" placeholder="Generado automaticamente" disabled>

                <label for="Title_Number" class="label_input">Número de título</label>
                <input id="Title_Number" name="Title_Number" type="text" class="inputs_user" placeholder="Introduce el número de título" >
                <span class="message_num" id="Num_Title_Number">0 / 40</span>
                
                <label for="User" class="label_input">Usuario del padrón</label>
                <button id="User" name="User" type="text" class="inputs_user" style="background-color:white; text-align: left;">Selecciona usuario</button>
                <input type="hidden" id="User_id">
                <input type="hidden" id="User_Name">
                
                <label for="Plot" class="label_input">Lote</label>
                <input id="Plot" name="Plot" type="text" class="inputs_user" placeholder="Introduce el lote" required>
                <span class="message_num" id="Num_Plot">0 / 20</span>
                
                <label for="Cologne" class="label_input">Colonia</label>
                <input id="Cologne" name="Cologne" type="text" class="inputs_user" placeholder="Introduce la colonia" required>
                <span class="message_num" id="Num_Cologne">0 / 20</span>
                
                <label for="Initial_Date" class="label_input">Fecha de inicio</label>
                <input type="date" id="Initial_Date" name="Initial_Date" type="text" class="inputs_user" placeholder="Escoge una fecha" required>
    
                <label for="Validity" class="label_input">Vigencia</label>
                <input type="Number" min="0" id="Validity" name="Validity" type="text" class="inputs_user" placeholder="introduce el número de años" required>

                <label for="Water_Supply" class="label_input">Dotación</label>
                <input type="Number" min="0" id="Water_Supply" name="Water_Supply" type="text" class="inputs_user" placeholder="Introduce la dotación" required>
                <span class="message_num" id="Num_Longitude">0 / 20</span>

                <label for="Longitude" class="label_input">Longitúd</label>
                <input  id="Longitude" name="Longitude" type="text" class="inputs_user" placeholder="Introduce longitúd (cordenada)" required>
                <span class="message_num" id="Num_Longitude">0 / 20</span>

                <label for="Latitude" class="label_input">Latitúd</label>
                <input id="Latitude" name="" type="text" class="inputs_user" placeholder="Introduce latitúd (cordenada)" required>
                <span class="message_num" id="Num_Latitude">0 / 20</span>

                <label for="Extend" class="label_input">Prorroga</label>
                <input id="Extend" name="Extend" type="text" class="inputs_user" placeholder="Describe la prorroga" required >
                <span class="message_num" id="Num_Extend">0 / 1000</span>

                <label for="Tenant" class="label_input">Arrendatario</label>
                <input id="Tenant" name="Tenant" type="text" class="inputs_user" placeholder="Introduce el encargado" required>
                <span class="message_num" id="Num_Tenant">0 / 400</span>
            
    
                </div>
            </div>
            <div class="user_footer">
            </div>
    
    </div>
</div>