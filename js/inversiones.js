import * as _Arraylist from "../Modules/Class/ArrayList.js"
window.onpaint = preloadFunc();
function preloadFunc(){
        if($("#user-get").val()!='Sin usuario'){
        $(".dashboard-content").load("components/Usuario.php",{"user_id":$("#user-get").val(),"previous":"inversiones"});
        }
    }
$(document).ready(function () {
    var usuario_control_number ;
    var usuario_nombre ;
    var usuario_control_number_update=null ;
    var usuario_nombre_update=null ;
    investmentsRegister()
    
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
    $("#User").on('click',function(){
        switchAlertSearchUser()
    });
    
    function cleanUser(){
        usuario_control_number=null ;
        usuario_nombre =null;
        usuario_control_number_update=null ;
        usuario_nombre_update=null ;  
    }
    function cleanInputs(){
        $("#Investments_Id").val(null);
        $("#User_id").val(null);
        $("#User").html("Selecciona usuario");
        $("#User_Name").val(null);
        $("#Cologne").val(null);
        $("#Plot").val(null);
        $("#System_").val(null);
        $("#Hectare").val(null);
        $("#Investments_Date").val(null);
    }
    function maxLetters(expresion,limit){
        return expresion.length <= limit;
    }
    function setInputInvestemnt(Control_Num, Investments_Id, Full_Name, Plot, Cologne, System_, Hectare, Investments_Date){
        $("#Investments_Id").val(Investments_Id);
        $("#User_id").val(Control_Num);
        $("#User").html(Full_Name);
        $("#User_Name").val(Full_Name);
        $("#Cologne").val(Cologne);
        $("#Plot").val(Plot);
        $("#System_").val(System_);
        $("#Hectare").val(Hectare);
        $("#Investments_Date").val(Investments_Date);


    }
    function getInvestments(id){
        return  ArrayListInvestments.getInvestmentSpecific(id)
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
    function buscar(data){
        $.ajax({
    
            url : `Server/jsonInvestments.php`,
            data : {"busqueda":$(".input_search").val()},
            type : 'POST',
            beforeSend: function () {
                $('.cargando').show();
                $(".load_users").hide();
            },
            success: function (response) {
                $('.cargando').hide();
                $(".load_users").show();
                ArrayListInvestments.vacio();
                const json=JSON.parse(response)
            var html = ``;
            var cont=0;
                for(const register of json){
                    cont++;
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
                            <th> ${cont}</th>
                            <td>${Full_Name}</td>
                            <td>${Plot}</td>
                            <td>${Cologne}</td>
                            <td>${System_}</td>
                            <td>${Hectare}</td>
                            <td>${Investments_Date}</td>
                            <td><button id="${Control_Num}" class="btn btn-sm btn-primary button_show"><i class="fa-solid fa-eye"></i></button></td>
                            <td><button id="${Investments_Id}" class="btn btn-sm btn-warning button_show_update " style="color: #fff"><i class="fa-solid fa-pencil"></i></button></td>
                            <td><button id="${Investments_Id}" class="btn btn-sm btn-danger button_delete"><i class="fa-solid fa-trash"></i></button></td>
                    
                        </tr>
                `;
                }
            
                $(".load_titles").html(html);
                $(".button_show").click(function() {
                    $(".dashboard-content").load("components/Usuario.php",{"user_id":$(this).attr("id"),"previous":"inversiones"});
                });
                $(".button_show_update").click(function(){
                        const $investment = getInvestments($(this).attr("id").toString());
                        const Control_Num       = $investment._Control_Num           ;
                        const Investments_Id    = $investment._Investments_Id        ;
                        const Full_Name         = $investment._Full_Name             ;
                        const Plot              = $investment._Plot                  ; 
                        const Cologne           = $investment._Cologne               ;    
                        const System_           = $investment._System_               ;   
                        const Hectare           = $investment._Hectare               ;   
                        const Investments_Date  = $investment._Investments_Date      ;    
                        setInputInvestemnt(Control_Num, Investments_Id, Full_Name, Plot, Cologne, System_, Hectare, Investments_Date) 
                        update()
                    });
                $(".button_delete").click(function(){
                        const $investment = getInvestments($(this).attr("id").toString());
                        alertDrop($investment);
                });
            }
        });
    }    
    function update(){
        $(".user_footer").html(`<button id="button_update" > Actualizar </button><button id="button_plus"> <i class="fa-solid fa-plus"></i> </button>`);  
        $(".text_operation").html(`<b>Editando inversión</b>`);
        $("#button_plus").on('click', function(e){
            cleanInputs();
            cleanUser();
            investmentsRegister();

        });
        $("#button_update").on('click', function() {
            alertUpdate();
            //comparaciones();
        });
    }
    function setInvestment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date){
        console.clear();
        ArrayListInvestments.setInvestment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date)
     
    }
    function investmentsRegister(){
        $(".user_footer").html(`<button id="button_register" > Registrar </button>`);
        $(".text_operation").html(`<b>Registrando inversión</b>`);  
        $("#button_register").click(function(){
            if(usuario_control_number==null){
                noFoundUser();
               
            }else {
                alertRegister()
            }
            //switchAlertSearchUser()
            //noFoundUser()
            //noTitle()
            //alertRegister();    
        });
    }
    function alertRegister(){
        const Investment = jsonInvestments();
        const $msg=`
        <table class="table">
            <tbody>
            
            <tr>
                <th scope="row">Usuario</th>
                <td>${Investment.user_name}</td>
            </tr>
            <tr>
                <th scope="row">No. control</th>
                <td>${Investment.User_Id}</td>
            </tr>
            <tr>
                <th scope="row">Colonia</th>
                <td>${Investment.Cologne}</td>
            </tr>
            <tr>
                <th scope="row">Lote</th>
                <td>${Investment.Plot}</td>
            </tr>
            <tr>
                <th scope="row">Sistema</th>
                <td>${Investment.System_}</td>
            </tr>
            <tr>
                <th scope="row">Hectareas</th>
                <td>${Investment.Hectare}</td>
            </tr>
            <tr>
                <th scope="row">Año</th>
                <td>${Investment.Investments_Date}</td>
            </tr>
            
            </tbody>
        </table>
        `;
        Swal.fire({
                    title: `Registrando nueva inversión:`,
                    html: $msg,
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if(result.isConfirmed){
                        altas();

                    }
                });
    } 
    function jsonInvestments(){
        const Control_Num       = $("#User_id")         .val() == "" ? "Sin registrar": $("#User_id").val();
        const Investments_Id    = $("#Investments_Id")  .val() == "" ? "Sin registrar": $("#Investments_Id").val();
        const Full_Name         = $("#User_Name")       .val() == "" ? "Sin registrar": $("#User_Name").val();
        const Plot              = $("#Plot")            .val() == "" ? "Sin registrar": $("#Plot").val();
        const Cologne           = $("#Cologne")         .val() == "" ? "Sin registrar": $("#Cologne").val();  
        const System_           = $("#System_")          .val() == "" ? "Sin registrar": $("#System_").val(); 
        const Hectare           =  $("#Hectare")        .val() == "" ? "Sin registrar": $("#Hectare").val();
        const Investments_Date  =  $("#Investments_Date") .val() == "" ? "Sin registrar": $("#Investments_Date").val();  

       

        const data = { 
                    'User_Id'           : Control_Num           ,     
                    'Cologne'           : Cologne               ,
                    'Plot'              : Plot                  ,
                    'System_'           : System_               ,
                    'Hectare'           : Hectare               ,
                    'Investments_Date'  : Investments_Date      ,
                    'Investments_Id'  : Investments_Id      ,
                    'user_name'         : Full_Name  
                          
                    };

        return data;
    }
    function noFoundUser(){
        Swal.fire({
                title: `No ha seleccionado un usuario`,
                confirmButtonText: 'Regresar',
                icon: 'error',
            });
    }
    function switchAlertSearchUser(){// muestra un alert con  input en el cual s puede buscar un usuario en la base de datos
        Swal.fire({
                    title: 'Introducir el nombre del usuario',
                    input: 'text',
                    inputAttributes: {
                    autocapitalize: 'off'
                },
                    showCancelButton: true,
                    confirmButtonText: 'Buscar',
                    showLoaderOnConfirm: true,
                preConfirm: (user) => {
                    return fetch(`Server/search_user.php?user=${user}`).then(response => {return response.json();})
                },
                    allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                
                if (result.isConfirmed) {
                    switchAlertUsers(result);
                    $(".selected_user").click(function() {
                        const id = $(this).attr("id")
                        const value = $(`#${format_id(format_id(id,8),9)}`).val();
                        usuario_control_number=id;
                        usuario_nombre=value;
                        $(".selected_user").removeClass("selected");
                        $("#"+id+"").removeClass("").addClass("selected");
                        $("#input_search_user").val(value);
                    })
                }
            })
    }
    function switchAlertUsers(result){// muestra un alertcon una tabla  en el cual s puede seleccionar el usuario y cambiar el nombre del usuario en el documento
        Swal.fire({
                    title: `Usuarios Encontrados`,
                    html:   result.value.ok,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Seleccionar',
                    cancelButtonText: 'Buscar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                            
                    if (result.isConfirmed) {
                        if($("#input_search_user").val()!=""){
                            $("#User").html(usuario_nombre);
                            $("#User_Name").val(usuario_nombre);
                            $("#User_id").val(format_id(usuario_control_number,8));
                        
                        }else{
                            Swal.fire('No selecciono ningun usuario', '', 'info') .then((result) => {switchAlertSearchUser()})
                        }

                    } else if (result.isDenied) {
                                
                    } else {
                        switchAlertSearchUser();
                    }
                            })
    }
    const format_id = (id,option) => { // función para tomar y crear ids para los elementos
        var split;
        switch (option){
            case 1:split=id.split("seleccionado_");                     return id+split[1];                 break;
            case 2:split=id.split("cancelar_");                         return split[1];                    break;
            case 3:                                                     return "id_title_seleccionado_"+id; break;
            case 4:                                                     return "cancelar_"+id;              break;
            case 5:                                                     return "input_"+id;                 break;
            case 6:                                                     return "reg_"+id;                   break;
            case 7:                                                     return "user_"+id;                  break;
            case 8:split=id.split("user_");                             return  split[1];                   break;
            case 9:                                                     return "value_input_search_user_"+id; break;
            
        }
    }
    function alertDrop(Investment)
    {
        
        const $msg=`
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">Usuario</th>
                <td>${Investment._Full_Name == null ? "Sin registrar": Investment._Full_Name}</td>
            </tr>
            <tr>
                <th scope="row">No. control</th>
                <td>${Investment._Control_Num == null ? "Sin registrar": Investment._Control_Num}</td>
            </tr>
            <tr>
                <th scope="row">Colonia</th>
                <td>${Investment._Cologne == null ? "Sin registrar":Investment._Cologne}</td>
            </tr>
            <tr>
                <th scope="row">Lote</th>
                <td>${Investment._Plot == null ? "Sin registrar":Investment._Plot}</td>
            </tr>
            <tr>
                <th scope="row">Sistema</th>
                <td>${Investment._System_ == null ? "Sin registrar":Investment._System_}</td>
            </tr>
            <tr>
                <th scope="row">Hectareas</th>
                <td>${Investment._Hectare == null ? "Sin registrar":Investment._Hectare}</td>
            </tr>
            <tr>
                <th scope="row">Año</th>
                <td>${Investment._Investments_Date == null ? "Sin registrar":Investment._Investments_Date}</td>
            </tr>
            
            </tbody>
        </table>
        
        `;
        Swal.fire({
                        title: `Eliminando inversión`,
                        html: $msg,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                            bajas({'Investments_Id':Investment._Investments_Id});
                        }
                    });
    }
    function alertUpdate()
    {
        const Investment = jsonInvestments();
        const $msg=`
        <table class="table">
            <tbody>
            
            <tr>
                <th scope="row">Usuario</th>
                <td>${Investment.user_name}</td>
            </tr>
            <tr>
                <th scope="row">No. control</th>
                <td>${Investment.User_Id}</td>
            </tr>
            <tr>
                <th scope="row">Colonia</th>
                <td>${Investment.Cologne}</td>
            </tr>
            <tr>
                <th scope="row">Lote</th>
                <td>${Investment.Plot}</td>
            </tr>
            <tr>
                <th scope="row">Sistema</th>
                <td>${Investment.System_}</td>
            </tr>
            <tr>
                <th scope="row">Hectareas</th>
                <td>${Investment.Hectare}</td>
            </tr>
            <tr>
                <th scope="row">Año</th>
                <td>${Investment.Investments_Date}</td>
            </tr>
            
            </tbody>
        </table>
        `;
        Swal.fire({
                    title: `Registrando nueva inversión:`,
                    html: $msg,
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if(result.isConfirmed){
                        edit();

                    }
                }); 
        
    }
    function altas(){
        $.ajax({
        
            url : `Server/updateInfoInvestments.php`,
            data : jsonInvestments(),
            type : 'POST',
            success: function (response) {
                cleanInputs();
                buscar({"busqueda":$(".input_search").val()});

            }
        });
    }
    function edit(){
        $.ajax({
        
            url : `Server/editInvestment.php`,
            data : jsonInvestments(),
            type : 'POST',
            success: function (response) {
                
                cleanInputs();
                cleanUser();
                investmentsRegister();
                buscar({"busqueda":$(".input_search").val()});
              
            }
        });
    }
    function bajas(data){
    $.ajax({
        
        url : `Server/dropInvestments.php`,
        data : data,
        type : 'POST',
        success: function (response) 
        {
            buscar({"busqueda":$(".input_search").val()});
            cleanInputs();
            cleanUser();
            investmentsRegister();
        }
    });
    }
});