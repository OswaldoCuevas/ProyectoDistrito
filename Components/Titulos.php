<link rel="stylesheet" href="css/Titulos.css">
<script type = "module">
    import * as _Arraylist from "./Modules/Class/ArrayList.js"
    $(document).ready(function () {
        register();
        buscar({"busqueda":""});
        var ArrayListTitle = new _Arraylist.Title();
        $(document).on('keydown','.inputs_user',function(){
            setTimeout(() => {
                const    id=$(this).attr("id");
                const    val= $(this).val();
                var expresion = val.toString().split("");
                var num=0;
                switch(id){
                    case "Title_Number"         :num=40;break
                    case "Plot"                 :num=20;break
                    case "Cologne"              :num=30;break
                    case "Longitude"            :num=20;break;
                    case "Latitude"             :num=20;break;
                    case "Extend"               :num=1000;break;
                    case "Tenant"               :num=400;break;
                }
                expresion.length = maxLetters(expresion,num) ? expresion.length:num; $(this).val(expresion.join(""));
                $(`#Num_${id}`).html(`${expresion.length} / ${num}`);
            },20);
                    
           
        });
        $(document).on('keyup','.input_search',function(){
            buscar({"busqueda":$(this).val().toString()})
        }); 

        function maxLetters(expresion,limit){
            return expresion.length <= limit;
        }

        function limit(val,id){

            var expresion = val.toString().split("");
            var num=0;
            switch(id){
                    case "Title_Number"         :num=40;break
                    case "Plot"                 :num=20;break
                    case "Cologne"              :num=30;break
                    case "Longitude"            :num=20;break;
                    case "Latitude"             :num=20;break;
                    case "Extend"               :num=1000;break;
                    case "Tenant"               :num=400;break;

            }
            expresion.length = maxLetters(expresion,num) ? expresion.length:num; $(this).val(expresion.join(""));
            $(`#Num_${id}`).html(`${expresion.length} / ${num}`);
        }

        function register(){
            $(".user_footer").html(`<button id="button_register" > Registrar </button>`);
            $(".text_operation").html(`<b>Registrando título</b>`);  
            $("#button_register").click(function(){
                //alertRegister();    
            });
        }
        
        function buscar(data){
            $.ajax({
        
            url : `Server/jsonTitles.php`,
            data : data,
            type : 'POST',
            beforeSend: function () {
                $('.cargando').show();
                $(".load_users").hide();
            },
            success: function (response) {
                $('.cargando').hide();
                $(".load_users").show();
    
                const json=JSON.parse(response)
                var html = ``;
                for(register of json){
                    setTitles(register.Title_Id,register.User_Id,register.Location_Id,register.Full_Name,register.Tenant,register.Title_Number,register.Water_Supply,register.Initial_Date,register.Validity,register.Extend,register.Cologne,register.Plot,register.Longitude,register.Latitude)
                  
                    const Title_id          = register.Title_id         == null ?   "Sin registrar" : register.Title_id;
                    const Title_Number      = register.Title_Number     == null ?   "Sin registrar" : register.Title_Number;
                    const Full_Name         = register.Full_Name        == null ?   "Sin registrar" : register.Full_Name;
                    const Plot              = register.Plot             == null ?   "Sin registrar" : register.Plot;
                    const Cologne           = register.Cologne          == null ?   "Sin registrar" : register.Cologne;   
                    // setUser(register.Control_Num, register.Full_Name, register.Email, register.Password_User, register.RFC, register.CURP, register.Type_User, register.Phone_Number)
                //   const Full_Name       = register.Full_Name        == null ?   "Sin registrar" : register.Full_Name;
                //   const Phone_Number    = register.Phone_Number     == null ?   "Sin registrar" : register.Phone_Number;
                //   const Email           = register.Email            == null ?   "Sin registrar" : register.Email;
                //   const Password_User   = register.Password_User    == null ?   "Sin registrar" : register.Password_User;
                //   const CURP            = register.CURP             == null ?   "Sin registrar" : register.CURP;
                //   const RFC             = register.RFC              == null ?   "Sin registrar" : register.RFC;
                //   const Type_User       = register.Type_User        == null ?   "Sin registrar" : register.Type_User;
                //   const Control_Num     = register.Control_Num      == null ?   "Sin registrar" : register.Control_Num;
                
                //     const activo = Password_User == "Sin registrar"?"<div class='No_activo'></div>":"<div class='Activo'></div>"; 
                
                   html+=`
                   <tr class="users-tr" id='element_${Title_id}'>
                           
                            <td>${Title_Number}</td>
                            <td>${Full_Name}</td>
                            <td>${Plot}</td>
                            <td>${Cologne}</td>
                            <td><button id="${Title_id}" class="btn btn-sm btn-primary button_show"><i class="fa-solid fa-eye"></i></button></td>
                            <td><button id="${Title_id}" class="btn btn-sm btn-warning button_show_update " style="color: #fff"><i class="fa-solid fa-pencil"></i></button></td>
                            <td><button id="${Title_id}" class="btn btn-sm btn-danger button_delete"><i class="fa-solid fa-trash"></i></button></td>
                    
                        </tr>
                   `;
                }
                 $(".load_titles").html(html);
                // $(".button_show").click(function() {
                //     $(".dashboard-content").load("components/Usuario.php",{"user_id":$(this).attr("id")});
                // });
                // $(".button_show_update").click(function(){
                //   const $user = getUser($(this).attr("id").toString())
                //   const Full_Name       = $user.getFull_Name()         == null ?   "" : $user.getFull_Name() ;
                //   const Phone_Number    = $user.getPhone_Number()      == null ?   "" : $user.getPhone_Number() ;
                //   const Email           = $user.getEmail()             == null ?   "" : $user.getEmail() ;
                //   const Password_User   = $user.getPassword_User()     == null ?   "" : $user.getPassword_User() ;
                //   const CURP            = $user.getCURP()              == null ?   "" : $user.getCURP() ;
                //   const RFC             = $user.getRFC()               == null ?   "" : $user.getRFC() ;
                //   const Type_User       = $user.getType_User()         == null ?   "" : $user.getType_User() ;
                //   const Control_Num     = $user.getControl_Num()       == null ?   "" : $user.getControl_Num() ;
                //    setInputUser(Control_Num,Full_Name ,Email,Password_User,RFC,CURP,Type_User,Phone_Number);
                //    update()
                // });
                // $(".button_delete").click(function(){
            
                
                //     alertDrop(getUser($(this).attr("id").toString()));
                    }
                 });
        }
        
        function setTitles(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude){
            console.clear();
            ArrayListTitle.setTitles(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude)
         
        }
    });

</script>
<div class="container-tables">
		<div class="tables-user " >
            <h2 class=" title-tables-user" id="titulosConcesion">Títulos de concesión</h2>
            <input type="search" class="input_search" placeholder="Buscar usuario ...">
            <div class="scroll-tables-user ">
            <table class="table table-hover " style=" margin-top: 10px;">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col"> Título       </th>
                      <th scope="col"> Usuario      </th>
                      <th scope="col"> Lote         </th>
                      <th scope="col"> Colonia      </th>
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
            <label for="Title_Id" class="label_input">Id de título</label>
            <input id="Title_Id" name="Title_Id" type="text" class="inputs_user" placeholder="Generado automaticamente" disabled>

            <label for="Title_Number" class="label_input">Número de título</label>
            <input id="Title_Number" name="Title_Number" type="text" class="inputs_user" placeholder="Introduce el número de título" >
            <span class="message_num" id="Num_Title_Number">0 / 40</span>
            
            <label for="User" class="label_input">Usuario del padrón</label>
            <button id="User" name="User" type="text" class="inputs_user" style="background-color:white; text-align: left;">Selecciona usuario</button>
            <input type="hidden" id="User_id">
            
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