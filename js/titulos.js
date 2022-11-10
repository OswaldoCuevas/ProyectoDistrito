import * as _Arraylist from "../Modules/Class/ArrayList.js"
$(document).ready(function () {
    titleRegister();
    var usuario_control_number ;
    var usuario_nombre ;
    var usuario_control_number_update=null ;
    var usuario_nombre_update=null ;
    function cleanUser(){
        usuario_control_number=null ;
        usuario_nombre =null;
        usuario_control_number_update=null ;
        usuario_nombre_update=null ;  
    }
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
                case "Water_Supply"         :num=10;break;
                case "Validity"             :num=10;break;
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
    function setInputUser(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude){
        $("#Title_Id").val(Title_Id);
        $("#User_Id").val(User_Id);
        $("#Location_Id").val(Location_Id);
        $("#User").html(Full_Name);
        $("#User_Name").val(Full_Name);
        $("#Tenant").val(Tenant);
        $("#Title_Number").val(Title_Number);
        $("#Water_Supply").val(Water_Supply);
        $("#Initial_Date").val(Initial_Date);
        $("#Validity").val(Validity);
        $("#Extend").val(Extend);
        $("#Cologne").val(Cologne);
        $("#Plot").val(Plot);
        $("#Longitude").val(Longitude);
        $("#Latitude").val(Latitude);

    }
    function cleanInputs(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude){
        $("#Title_Id").val(null);
        $("#User_Id").val(null);
        $("#Location_Id").val(null);
        $("#User").html("Selecciona usuario");
        $("#Tenant").val(null);
        $("#Title_Number").val(null);
        $("#Water_Supply").val(null);
        $("#Initial_Date").val(null);
        $("#Validity").val(null);
        $("#Extend").val(null);
        $("#Cologne").val(null);
        $("#Plot").val(null);
        $("#Longitude").val(null);
        $("#Latitude").val(null);

    }
    function jsonTitulo(){
        const user_id       = $("#User_id").val()           == "" ? "Sin registrar": $("#User_id").val();
        const title_number  = $("#Title_Number").val()      == "" ? "Sin registrar": $("#Title_Number").val();
        const water_supply  = $("#Water_Supply").val()      == "" ? "Sin registrar": $("#Water_Supply").val();
        const initial_date  = $("#Initial_Date").val()      == "" ? "Sin registrar": $("#Initial_Date").val();
        const validity      = $("#Validity").val()          == "" ? "Sin registrar": $("#Validity").val();
        const extend        = $("#Extend").val()            == "" ? "Sin registrar": $("#Extend").val();
        const cologne       = $("#Cologne").val()           == "" ? "Sin registrar": $("#Cologne").val();
        const plot          = $("#Plot").val()              == "" ? "Sin registrar": $("#Plot").val();
        const longitude     = $("#Longitude").val()         == "" ? "Sin registrar": $("#Longitude").val();
        const latitude      = $("#Latitude").val()          == "" ? "Sin registrar": $("#Latitude").val();
        const tenant        = $("#Tenant").val()            == "" ? "Sin registrar": $("#Tenant").val();
        const title_id      = $("#Title_Id").val()          == "" ? "Sin registrar": $("#Title_Id").val();
        const user_name     = $("#User_Name").val()         == "" ? "Sin registrar": $("#User_Name").val();

        const data = { 
                    'user_id'       :   user_id        ,       'title_number'  :   title_number     ,
                    'water_supply'  :   water_supply   ,       'initial_date'  :   initial_date     ,
                    'validity'      :   validity       ,       'extend'        :   extend           ,
                    'cologne'       :   cologne        ,       'plot'          :   plot             ,
                    'longitude'     :   longitude      ,       'latitude'      :   latitude         ,
                    'tenant'        :   tenant         ,       'title_id' : title_id                ,
                    'user_name'     :   user_name      
                            
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
    function noTitle(){
        Swal.fire({
                title: `No ha ingresado número de título`,
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
    function buscar(data){
        $.ajax({
    
        url : `Server/jsonTitles.php`,
        data : {"busqueda":$(".input_search").val()},
        type : 'POST',
        assynchronous : true,
        beforeSend: function () {
            $('.cargando').show();
            $(".load_users").hide();
        },
        success: function (response) {
            $('.cargando').hide();
            $(".load_users").show();
            ArrayListTitle.Titles= [];
            const json=JSON.parse(response)
            var html = ``;
            for(const register of json){
                setTitles(register.Title_Id,register.User_Id,register.Location_Id,register.Full_Name,register.Tenant,register.Title_Number,register.Water_Supply,register.Initial_Date,register.Validity,register.Extend,register.Cologne,register.Plot,register.Longitude,register.Latitude)
                
                const Title_Id          = register.Title_Id         == null ?   "Sin registrar" : register.Title_Id;
                const Title_Number      = register.Title_Number     == null ?   "Sin registrar" : register.Title_Number;
                const Full_Name         = register.Full_Name        == null ?   "Sin registrar" : register.Full_Name;
                const Plot              = register.Plot             == null ?   "Sin registrar" : register.Plot;
                const Cologne           = register.Cologne          == null ?   "Sin registrar" : register.Cologne;  
                const Initial_Date      = register.Initial_Date     == null ?   "Sin registrar" : register.Initial_Date;
                const Validity          = register.Validity         == null ?   "Sin registrar" : register.Validity;
                const Water_Supply      = register.Water_Supply     == null ?   "Sin registrar" : register.Water_Supply;
            
                html+=`
                    <tr class="users-tr" id='element_${Title_Id}'>
                        
                        <td>${Title_Number}</td>
                        <td>${Full_Name}</td>
                        <td>${Plot}</td>
                        <td>${Cologne}</td>
                        <td>${Validity}</td>
                        <td>${Initial_Date}</td>
                        <td>${Water_Supply}</td>
                        <td><button id="${Title_Id}" class="btn btn-sm btn-primary button_show"><i class="fa-solid fa-eye"></i></button></td>
                        <td><button id="${Title_Id}" class="btn btn-sm btn-warning button_show_update" style="color: #fff"><i class="fa-solid fa-pencil"></i></button></td>
                        <td><button id="${Title_Id}" class="btn btn-sm btn-danger button_delete"><i class="fa-solid fa-trash"></i></button></td>
                
                    </tr>
                `;
            }
                $(".users-tr").remove();
                $(".load_titles").html(html);
                $(".button_show").click(function() {
            $(".dashboard-content").load("components/Titulo.php",{"Title_Id":$(this).attr("id"),"previous":"Titulos"});
        });
            // $(".button_show").click(function() {
            //     $(".dashboard-content").load("components/Usuario.php",{"user_id":$(this).attr("id")});
            // });
            $(".button_show_update").click(function(){
           
                const $title = getTitle($(this).attr("id").toString())
                setInputUser($title.Title_Id,$title.User_Id,$title.Location_Id,$title.Full_Name,$title.Tenant,$title.Title_Number,$title.Water_Supply,$title.Initial_Date,$title.Validity,$title.Extend,$title.Cologne,$title.Plot,$title.Longitude,$title.Latitude)
                update()
            });
                $(".button_delete").click(function(){
        
            
                    alertDrop(getTitle($(this).attr("id").toString()));
            });
                }
                });
    } 
    function alertDrop(title){
        
        const $msg=`
        <table class="table">
        <tbody>
        <tr>
        <th scope="row">Titular</th>
        <td>${title.getFull_Name()  == null ?"Sin registrar":title.getFull_Name() }</td>
        </tr>
        <tr>
        <th scope="row">Colonia</th>
        <td>${title.Cologne == null ? "Sin registrar":title.Cologne}</td>
        </tr>
        <tr>
        <th scope="row">Lote</th>
        <td>${title.Plot == null ? "Sin registrar":title.Plot }</td>
        </tr>
        <tr>
        <th scope="row">Dotación</th>
        <td>${title.Water_Supply == null ? "Sin registrar":title.Water_Supply}</td>
        </tr>
        <tr>
        <th scope="row">Fecha de vigencia</th>
        <td>${title.Initial_Date == null ? "Sin registrar":title.Initial_Date}</td>
        </tr>


        </tbody>
        </table>
        `;
        Swal.fire({
                        title: `Eliminando Título <b>${title.getTitle_Number()}</b>`,
                        html: $msg,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                            bajas({'Title_Id':title.Title_Id});
                        }
                    });
    }
    function update(){
        $(".user_footer").html(`<button id="button_update" > Actualizar </button><button id="button_plus"> <i class="fa-solid fa-plus"></i> </button>`);  
        $(".text_operation").html(`<b>Editando título</b>`);
        $("#button_plus").on('click', function(e){
            cleanInputs();
            cleanUser();
            titleRegister();
        });
        $("#button_update").on('click', function() {
            //alertUpdate()
            comparaciones();
        });
    }
    function comparaciones(){

            const $Titulo = jsonTitulo();
            const input_titulo_update        = $Titulo.title_number;
            
            const input_nombre_update        = $Titulo.user_name;
            const input_arrendatario_update  = $Titulo.tenant;
            const input_vigencia_update      = $Titulo.validity;
            const input_inicio_update        = $Titulo.initial_date;
            const input_dotacion_update      = $Titulo.water_supply;
            const input_longitud_update      = $Titulo.longitude;
            const input_latitud_update       = $Titulo.latitude;
            const input_colonia_update       = $Titulo.cologne;
            const input_lote_update          = $Titulo.plot;
            const prorroga_update            = $Titulo.extend;

            const $infoTituloActual         =  getTitle($Titulo.title_id);
            const input_titulo       = $infoTituloActual.Title_Number;

            const input_nombre              = $infoTituloActual.Full_Name == null ?"Sin registrar":$infoTituloActual.Full_Name;
            const input_arrendatario        = $infoTituloActual.Tenant == null ? "Sin registrar" : $infoTituloActual.Tenant;
            const input_vigencia            = $infoTituloActual.Validity == null ? "Sin registrar" : $infoTituloActual.Validity;
            const input_inicio              = $infoTituloActual.Initial_Date == null ? "Sin registrar" : $infoTituloActual.Initial_Date;
            const input_dotacion            = $infoTituloActual.Water_Supply == null ? "Sin registrar" : $infoTituloActual.Water_Supply;
            const input_longitud            = $infoTituloActual.Longitude == null ? "Sin registrar" : $infoTituloActual.Longitude;
            const input_latitud             = $infoTituloActual.Latitude == null ? "Sin registrar" : $infoTituloActual.Latitude;
            const input_colonia             = $infoTituloActual.Cologne == null ? "Sin registrar" : $infoTituloActual.Cologne;
            const input_lote                = $infoTituloActual.Plot == null ? "Sin registrar" : $infoTituloActual.Plot;
            const prorroga                  =  $infoTituloActual.Extend == null ? "Sin registrar" : $infoTituloActual.Extend;
            // transfersTitle()
            const Iguales_Nombres           = input_nombre_update       == input_nombre         ;
            const Iguales_Arrendatarios     = input_arrendatario_update == input_arrendatario   ;
            const Iguales_Colonias          = input_colonia_update      == input_colonia        ;
            const Iguales_Lotes             = input_lote_update         == input_lote           ;
            const Iguales_Vigencias         = input_vigencia_update     == input_vigencia       ;
            const Iguales_Inicio            = input_inicio_update       == input_inicio         ;
            const Iguales_Dotacion          = input_dotacion_update     == input_dotacion       ;
            const Iguales_Longitud          = input_longitud_update     == input_longitud       ;
            const Iguales_Latitud           = input_latitud_update      == input_latitud        ;
            const Iguales_Prorroga          = prorroga_update           == prorroga             ;
            var html=``;
            if(!Iguales_Nombres){
                html += `<table class="table" style="margin-top:10px">
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="2">Editando usuario</th>
                        </tr>
                        <tr>
                        <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${input_nombre}</td>
                            <td style="color:blue">${input_nombre_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            if(!Iguales_Colonias ){
                html += `<table class="table" style="margin-top:10px" >
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="3">Editando ubicación</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Colonia</th>
                            <td>${input_colonia}</td>
                            <td style="color:blue">${input_colonia_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            if(!Iguales_Lotes ){
                html += `<table class="table" style="margin-top:10px" >
                <thead class="thead-dark">
                        <tr>
                        <th colspan="3">Editando ubicación</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                            <th scope="row">Lote</th>
                            <td>${input_lote}</td>
                            <td style="color:blue">${input_lote_update}</td>
                        </tr>
                        
                        
                    </tbody>
                </table> `;
            }
            if(!Iguales_Longitud ){
                html += `<table class="table" style="margin-top:10px" >
                <thead class="thead-dark">
                        <tr>
                        <th colspan="3">Editando ubicación</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <th scope="row">Longitud</th>
                            <td>${input_longitud}</td>
                            <td style="color:blue">${input_longitud_update}</td>
                        </tr>
                       
                        
                    </tbody>
                </table> `;
            }
             if(!Iguales_Latitud){
                html += `<table class="table" style="margin-top:10px" >
                <thead class="thead-dark">
                        <tr>
                        <th colspan="3">Editando ubicación</th>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <th scope="row">Latitud</th>
                            <td>${input_latitud}</td>
                            <td style="color:blue">${input_latitud_update}</td>
                        </tr>
                        
                    </tbody>
                </table> `;
            }

            if(!Iguales_Arrendatarios){
                html += `<table class="table" style="margin-top:10px">
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="2">Editando Arrendatario</th>
                        </tr>
                        <tr>
                        <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${input_arrendatario}</td>
                            <td style="color:blue">${input_arrendatario_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            if(!Iguales_Vigencias){
                html += `<table class="table" style="margin-top:10px">
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="2">Editando vigencia</th>
                        </tr>
                        <tr>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${input_vigencia}</td>
                            <td style="color:blue">${input_vigencia_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            if(!Iguales_Inicio){
                html += `<table class="table" style="margin-top:10px">
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="2">Editando fecha de inicio</th>
                        </tr>
                        <tr>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${input_inicio}</td>
                            <td style="color:blue">${input_inicio_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            if(!Iguales_Dotacion){
                html += `<table class="table" style="margin-top:10px">
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="2">Editando Dotación</th>
                        </tr>
                        <tr>
                            <th scope="col">Sin editar</th>
                            <th scope="col">Editada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${input_dotacion}</td>
                            <td style="color:blue">${input_dotacion_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            if(!Iguales_Prorroga){
                html += `<table class="table" style="margin-top:10px">
                    <thead class="thead-dark">
                        <tr>
                        <th colspan="2">Nueva prorroga</th>
                        </tr>
                        <tr>
                            <th scope="col">Antigua</th>
                            <th scope="col">Nueva</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${prorroga}</td>
                            <td style="color:blue">${prorroga_update}</td>
                        </tr>
                    </tbody>
                </table> `;
            }
            Swal.fire({
                        title: `Editando título <b>${input_titulo}</b>`,
                        html: html,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
            if(result.isConfirmed){
            if(!Iguales_Nombres){
               
                let title = jsonTitulo();
                UpdateInfoTitle('User_Id',title.user_id)
                
            }
            if(!Iguales_Colonias ){
                let title = jsonTitulo();
                let location = getTitle(title.title_id);
                const data = {  'Location_Id'      :  location.getLocation_Id()     ,
                                'Value'       :       title.cologne   ,
                                'Encabezado':          'Cologne'   
                                };  
                ChangeLocation(data)
            }
            if(!Iguales_Lotes){
                let title = jsonTitulo();
                let location = getTitle(title.title_id);
                const data = {  'Location_Id'      :       location.getLocation_Id(),       
                                'Value'          :       title.plot          ,
                                'Encabezado':     'Plot'        };  
                ChangeLocation(data)
            }
            if( !Iguales_Longitud ){
                let title = jsonTitulo();
                let location = getTitle(title.title_id);
                const data = {  'Location_Id'      :       location.getLocation_Id(),
                                'Value'     :       title.longitude    ,
                                'Encabezado':    'Latitude'          
                            };  
                ChangeLocation(data)
            }
            if(!Iguales_Latitud){
                let title = jsonTitulo();
                let location = getTitle(title.title_id);
                const data = {  'Location_Id'      :       location.getLocation_Id(),
                                'Value'      :       title.latitude,
                                'Encabezado':  'Latitude'     };  
                ChangeLocation(data)
            }
        
            if(!Iguales_Arrendatarios){
                UpdateInfoTitle('Tenant',input_arrendatario_update)
            }
            if(!Iguales_Vigencias){
                UpdateInfoTitle('Validity',input_vigencia_update)
            }
            if(!Iguales_Inicio){
                UpdateInfoTitle('Initial_Date',input_inicio_update)
            }
            if(!Iguales_Dotacion){
                UpdateInfoTitle('Water_Supply',input_dotacion_update)
            }
            if(!Iguales_Prorroga){    
                UpdateInfoTitle('Extend',prorroga_update)
            }  
                            
                        }
                    });
            
    }
    function UserTitle(data){
       
       $.ajax({
            url : `${link.Server}TransferTitle.php`,
            data : data,
            type : 'POST',
            success: data => {
                buscar({"busqueda":""});
                cleanInputs();
                cleanUser();
                titleRegister();
            }
        });
    }
    function ChangeLocation(data){
       
    
       $.ajax({
            url : `Server/ChangeUbication.php`,
            data : data,
            type : 'POST',
            success: data => {
                
                buscar({"busqueda":""});
                cleanInputs();
                cleanUser();
                titleRegister();
            }
        });
    }
    const UpdateInfoTitle = (Encabezado,value) =>{
        const title= jsonTitulo();
        const data = {  'Title_Id'      :       title.title_id,
                        'Encabezado'    :       Encabezado,
                        'Value'         :       value }; 
        $.ajax({
            url : `Server/updateInfoTitle.php`,
            data : data,
            type : 'POST',
            success: response => {
                
                buscar({"busqueda":""});
                cleanInputs();
                cleanUser();
                titleRegister();

            }
        });
        
        
    }
    function getTitle(id){
        return  ArrayListTitle.getTitleSpecific(id)
    }
    function setTitles(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude){
        console.clear();
        ArrayListTitle.setTitles(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude)
        
    }
    function titleRegister(){
        $(".user_footer").html(`<button id="button_register" > Registrar </button>`);
        $(".text_operation").html(`<b>Registrando título</b>`);  
        $("#button_register").click(function(){
            const Titulo = jsonTitulo();
            if(usuario_control_number==null){
                noFoundUser();
                
            }else if($("#Title_Number").val()=="" || $("#Title_Number").val()==null ){
                noTitle();
            }else{
                alertRegister()
            }
            //switchAlertSearchUser()
            //noFoundUser()
            //noTitle()
            //alertRegister();    
        });
    }    
    function alertRegister(){
        const titulo = jsonTitulo();
        const $msg=`
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">No. Título</th>
                <td>${ titulo.title_number}</td>
            </tr>
            <tr>
                <th scope="row">Usuario</th>
                <td>${titulo.user_name}</td>
            </tr>
            <tr>
                <th scope="row">No. control</th>
                <td>${titulo.user_id}</td>
            </tr>
            <tr>
                <th scope="row">Colonia</th>
                <td>${titulo.cologne}</td>
            </tr>
            <tr>
                <th scope="row">Lote</th>
                <td>${titulo.plot}</td>
            </tr>
            <tr>
                <th scope="row">Fecha de inicio</th>
                <td>${titulo.initial_date}</td>
            </tr>
            <tr>
                <th scope="row">Vigencia</th>
                <td>${titulo.validity}</td>
            </tr>
            <tr>
                <th scope="row">Dotación</th>
                <td>${titulo.water_supply}</td>
            </tr>
            <tr>
                <th scope="row">Prorroga</th>
                <td>${titulo.extend}</td>
            </tr>
            <tr>
                <th scope="row">Latitúd</th>
                <td>${titulo.latitude}</td>
            </tr>
            <tr>
                <th scope="row">Longitúd</th>
                <td>${titulo.longitude}</td>
            </tr>
            <tr>
                <th scope="row">Arrendatario</th>
                <td>${titulo.tenant}</td>
            </tr>
            </tbody>
        </table>
        `;
        Swal.fire({
                        title: `Registrando nuevo título:`,
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
    function altas(){
        $.ajax({
        
            url : `Server/addNewTitle.php`,
            data : jsonTitulo(),
            type : 'POST',
            success: function (response) {
                Swal.fire({
                    title: `Actualizado con exito`,
                    icon: "success",
                });
                buscar({"busqueda":""});
                cleanInputs();
                cleanUser();
                titleRegister();
            }
        });
    } 
   function bajas(data){
    $.ajax({
        
        url : `Server/dropTitle.php`,
        data : data,
        type : 'POST',
        success: function (response) 
        {
            buscar({"busqueda":""});
            cleanInputs();
            cleanUser();
            titleRegister();
        }
    });
    }
});