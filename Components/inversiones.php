<link rel="stylesheet" href="css/Titulos.css">
<script type = "module">
    import * as _Arraylist from "./Modules/Class/ArrayList.js"
    $(document).ready(function () {
        register();
        buscar({"busqueda":""});
        var ArrayListInvestments = new _Arraylist.Investment();
        $(document).on('keydown','.inputs_user',function(){
            setTimeout(() => {
                const    id=$(this).attr("id");
                const    val= $(this).val();
                var expresion = val.toString().split("");
                var num=0;
                switch(id){
                    case "Plot"                 :num=30;break
                    case "Cologne"              :num=30;break
                    case "System_"              :num=100;break;
                    case "Hectare"              :num=20;break;
                    case "Investments_Date"     :num=4;break;
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
                    case "Plot"                 :num=30;break
                    case "Cologne"              :num=30;break
                    case "System_"              :num=100;break;
                    case "Hectare"              :num=20;break;
                    case "Investments_Date"     :num=4;break;

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
        
            url : `Server/jsonInvestments.php`,
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
                    setInvestment(register.Control_Num, register.Investments_Id, register.Full_Name, register.Plot, register.Cologne, register.System_, register.Hectare, register.Investments_Date)
 
                    const Control_Num       = register.Control_Num            == null ?   "Sin registrar" : register.Control_Num;
                    const Investments_Id    = register.Investments_Id         == null ?   "Sin registrar" : register.Investments_Id;
                    const Full_Name         = register.Full_Name              == null ?   "Sin registrar" : register.Full_Name;
                    const Plot              = register.Plot                   == null ?   "Sin registrar" : register.Plot;
                    const Cologne           = register.Cologne                == null ?   "Sin registrar" : register.Cologne;   
                    const System_           = register.System_                == null ?   "Sin registrar" : register.System_;
                    const Hectare           = register.Hectare                == null ?   "Sin registrar" : register.Hectare;
                    const Investments_Date  = register.Investments_Date       == null ?   "Sin registrar" : register.Investments_Date; 
                 
                 
                    
                 
                   html+=`
                   <tr class="users-tr" id='element_${Investments_Id}'>
                           
                            <td>${Full_Name}</td>
                            <td>${Plot}</td>
                            <td>${Cologne}</td>
                            <td>${System_}</td>
                            <td>${Hectare}</td>
                            <td>${Investments_Date}</td>
                            <td><button id="${Investments_Id}" class="btn btn-sm btn-warning button_show_update " style="color: #fff"><i class="fa-solid fa-pencil"></i></button></td>
                            <td><button id="${Investments_Id}" class="btn btn-sm btn-danger button_delete"><i class="fa-solid fa-trash"></i></button></td>
                    
                        </tr>
                   `;
                }
             
                  $(".load_titles").html(html);
        //         // $(".button_show").click(function() {
        //         //     $(".dashboard-content").load("components/Usuario.php",{"user_id":$(this).attr("id")});
        //         // });
        //         // $(".button_show_update").click(function(){
        //         //   const $user = getUser($(this).attr("id").toString())
        //         //   const Full_Name       = $user.getFull_Name()         == null ?   "" : $user.getFull_Name() ;
        //         //   const Phone_Number    = $user.getPhone_Number()      == null ?   "" : $user.getPhone_Number() ;
        //         //   const Email           = $user.getEmail()             == null ?   "" : $user.getEmail() ;
        //         //   const Password_User   = $user.getPassword_User()     == null ?   "" : $user.getPassword_User() ;
        //         //   const CURP            = $user.getCURP()              == null ?   "" : $user.getCURP() ;
        //         //   const RFC             = $user.getRFC()               == null ?   "" : $user.getRFC() ;
        //         //   const Type_User       = $user.getType_User()         == null ?   "" : $user.getType_User() ;
        //         //   const Control_Num     = $user.getControl_Num()       == null ?   "" : $user.getControl_Num() ;
        //         //    setInputUser(Control_Num,Full_Name ,Email,Password_User,RFC,CURP,Type_User,Phone_Number);
        //         //    update()
        //         // });
        //         // $(".button_delete").click(function(){
            
                
        //         //     alertDrop(getUser($(this).attr("id").toString()));
                    }
                 });
        }
        
        function setInvestment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date){
            console.clear();
            ArrayListInvestments.setInvestment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date)
         
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
                      <th scope="col"> Usuario      </th>
                      <th scope="col"> Lote         </th>
                      <th scope="col"> Colonia      </th>
                      <th scope="col"> Sistema      </th>
                      <th scope="col"> Hectareas    </th>
                      <th scope="col"> Año          </th>
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
            <label for="Title_Id" class="label_input">Id de inversion</label>
            <input id="Title_Id" name="Title_Id" type="text" class="inputs_user" placeholder="Generado automaticamente" disabled>

            <label for="User" class="label_input">Usuario del padrón</label>
            <button id="User" name="User" type="text" class="inputs_user" style="background-color:white; text-align: left;">Selecciona usuario</button>
            <input type="hidden" id="Control_Num">
            
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
            <input id="Hectare" name="Hectare" type="text" class="inputs_user" placeholder="Introduce las hectareas " >
            <span class="message_num" id="Num_Hectare">0 / 20</span>

            <label for  = "Investments_Date" class="label_input">Año</label>
            <input type = "Number" value="2015" min = "1000" id="Investments_Date" name="Investments_Date" type="text" class="inputs_user" placeholder="Introduce el año con 4 digitos" >
            <span class="message_num" id="Num_Investments_Date">4 / 4</span>

   
            </div>
        </div>
        <div class="user_footer">
        </div>
   
</div>