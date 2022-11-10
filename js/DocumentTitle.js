
    import * as link from "../Modules/links.js";
    import * as _ArrayList from "../Modules/Class/ArrayList.js";
    import * as _Title from "../Modules/Class/Title.js";
    
    $(document).ready(function () {
    $(".index").hide();
    busqueda("");//se onsulta la información sin parametros
    var indexCarousel=0;
    var ArrayListTitles = new _ArrayList.listDocument();
    var classTitle = new _Title.title();
    // ------------------- seccion de funciones ---------------------------
    function cambiarCaracter(CadenaAntigua,carcaterDeseado,caraterRemplazar){
        var CadenaNueva="";
        for(var i=0;i<CadenaAntigua.length;i++){
            var CaracterTomado=CadenaAntigua.charAt(i);
            CadenaNueva +=  CaracterTomado==caraterRemplazar ? carcaterDeseado:CaracterTomado;
        }
        return CadenaNueva;
    }
    function busqueda(buscar){ 
        var html;
                html=`
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"> Programa           </th>
                        <th scope="col"> Actualizado        </th>
                        <th scope="col"> Usuario            </th>
                        <th scope="col"> Número de título   </th>
                        <th scope="col"> Arrendatario       </th>
                        <th scope="col"> Sector             </th>
                        <th scope="col"> Colonia            </th>
                        <th scope="col"> Lote               </th>
                        <th scope="col"> Vigencia           </th>
                        <th scope="col"> Inicio             </th>
                        <th scope="col"> Dotación           </th>
                        <th scope="col"> Longitud           </th>
                        <th scope="col"> Latitud            </th>
                        <th scope="col"> Prórroga           </th>
                    </tr>
                </thead>
                <tbody>
                `;
        
        $.ajax({ // crea la tabla con los valores obtenidos de la basede datos
            
                url : `${link.Server}consulta_general_info_documento.php`,
                data : {'buscar' : buscar,'type': 'Títulos','id': $("#id_documento").val()},
                type : 'POST',
                async: true,
                beforeSend: function () {
                    $('.cargando').show();
                    $('.vacio').hide();
                    $('.container-tab').hide(); 
                },
                success: data => {
                    if(data.length!=0){
                        html+= data + "</tbody>";
                        $('.table').html(html);
                        $('.vacio').hide();
                        $('.cargando').hide();
                        $('.container-tab').show();
                        $(".seleccionar_todo").removeClass('runing_animation_reves').addClass("runing_animation");
                        selected_elements_array()
                        $(".getIdInfo").click(function(e) {
                            addTitles($(this).attr("id"))
                            $(".cancelar").click(function() { dropTitle(format_id($(this).attr("id"),2)); }); 
                        });

                            
                        }else{
                            $('.vacio').html("<b>0 datos encontrados</b>");
                            $('.vacio').show();
                            $('.cargando').hide();
                            $('.container-tab').hide();
                        }
                        
                
                },   
                error : function(jqXHR, status, error) {
                    alert('Disculpe, existió un problema');
                }, 
            });
        
            
    }
    function selected_elements_array(){
       const array = ArrayListTitles.getArrayElements();
       for(const element of array){
            $(`#${element.getId_Info()}`).removeClass('selected').addClass('selected');
       }
    }
    const updateInfoDocument = (Id_Info,Value,Encabezado) =>{ //actualiza la información de documentos info  en la base de datos
        const data = { 'Id_Info' : Id_Info, 'Value' : Value, 'Encabezado' : Encabezado };
        $.ajax({
            url : `${link.Server}update_document.php`,
            data : data,
            type : 'POST',
        });                               
    }
    const setUser = (user,type) =>{ //actualiza la información de documentos info  en la base de datos
        const data = { 'user' : user, 'type' : type };
        $.ajax({
            url : `${link.Server}addUserWithDocument.php`,
            data : data,
            type : 'POST',
        });                               
    }
    const existe = (value,type) =>{
        const data = { 'value' : value, 'type' : type };
            $.ajax({
            url : `${link.Server}existe.php`,
            data : data,
            type : 'POST',
            success : data => {
                switch(type){
                    case "user":
                        const $title =  $("#input_titulo_update").val() ;
                      
                        if(data==0 ){
                            noFoundUser()
                            
                        }else{
                            classTitle.setUser_Id(data);
                            existe($title,"title");
                        }
                    break;
                    case "title": 
                        if(data==0 ){
                            noFoundTitle(value)
                        }else{
                            classTitle.setTitle_Id(data);
                            comparaciones();
                            
                        }
                    break
                }
             
            }
        });
    }
    function comparaciones(){
        const input_titulo_update        = $("#input_titulo_update")   .val();

        const input_nombre_update        = $("#input_nombre_update")   .val();
        const input_arrendatario_update  = $("#input_arrendatario_update").val();
        const input_sector_update        = $("#input_sector_update")   .val();
        const input_vigencia_update      = $("#input_vigencia_update") .val();
        const input_inicio_update        = $("#input_inicio_update")   .val();
        const input_dotacion_update      = $("#input_dotacion_update") .val();
        const input_longitud_update      = $("#input_longitud_update") .val();
        const input_latitud_update       = $("#input_latitud_update")  .val();
        const input_colonia_update       = $("#input_colonia_update")  .val();
        const input_lote_update          = $("#input_lote_update")     .val();
        const prorroga_update            = $("#prorroga_update")       .val(); 

        const input_nombre               = $("#input_nombre")          .val();
        const input_arrendatario         = $("#input_arrendatario")    .val();
        const input_colonia              = $("#input_colonia")         .val();
        const input_lote                 = $("#input_lote")            .val();
        const input_vigencia             = $("#input_vigencia")        .val();
        const input_inicio               = $("#input_inicio")          .val();
        const input_dotacion             = $("#input_dotacion")        .val();
        const input_longitud             = $("#input_longitud")        .val();
        const input_latitud              = $("#input_latitud")         .val();
        const prorroga                   = $("#prorroga")              .val();
        // transfersTitle()
        const Iguales_Nombres           = input_nombre_update       == input_nombre         ? true:false;
        const Iguales_Arrendatarios     = input_arrendatario_update == input_arrendatario   ? true:false;
        const Iguales_Colonias          = input_colonia_update      == input_colonia        ? true:false;
        const Iguales_Lotes             = input_lote_update         == input_lote           ? true:false;
        const Iguales_Vigencias         = input_vigencia_update     == input_vigencia       ? true:false;
        const Iguales_Inicio            = input_inicio_update       == input_inicio         ? true:false;
        const Iguales_Dotacion          = input_dotacion_update     == input_dotacion       ? true:false;
        const Iguales_Longitud          = input_longitud_update     == input_longitud       ? true:false;
        const Iguales_Latitud           = input_latitud_update      == input_latitud        ? true:false;
        const Iguales_Prorroga          = prorroga_update           == prorroga             ? true:false;
        var html=``;
        if(!Iguales_Nombres){
            html += `<table class="table" style="margin-top:10px">
                <thead class="thead-dark">
                    <tr>
                    <th colspan="2">Transferencia de titulos</th>
                    </tr>
                    <tr>
                        <th scope="col">Usuario previo</th>
                        <th scope="col">Usuario nuevo</th>
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
        if(!Iguales_Colonias || !Iguales_Lotes || !Iguales_Longitud || !Iguales_Latitud){
            html += `<table class="table" style="margin-top:10px" >
                <thead class="thead-dark">
                    <tr>
                    <th colspan="3">Cambio de ubicación</th>
                    </tr>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Ubicación anterior</th>
                        <th scope="col">Ubicación nueva</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Colonia</th>
                        <td>${input_colonia}</td>
                        <td style="color:blue">${input_colonia_update}</td>
                    </tr>
                    <tr>
                        <th scope="row">Lote</th>
                        <td>${input_lote}</td>
                        <td style="color:blue">${input_lote_update}</td>
                    </tr>
                    <tr>
                        <th scope="row">Longitud</th>
                        <td>${input_longitud}</td>
                        <td style="color:blue">${input_longitud_update}</td>
                    </tr>
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
                    <th colspan="2">Nuevo Arrendatario</th>
                    </tr>
                    <tr>
                        <th scope="col">Arrendatario previo</th>
                        <th scope="col">Arrendatario nuevo</th>
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
                    <th colspan="2">Nueva vigencia</th>
                    </tr>
                    <tr>
                        <th scope="col">Antigua</th>
                        <th scope="col">Nueva</th>
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
                    <th colspan="2">cambio de fecha de inicio</th>
                    </tr>
                    <tr>
                        <th scope="col">Antigua</th>
                        <th scope="col">Nueva</th>
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
                    <th colspan="2">Cambio de Dotación</th>
                    </tr>
                    <tr>
                        <th scope="col">Antigua</th>
                        <th scope="col">Nueva</th>
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
                    title: `Operaciones para título <b>${input_titulo_update}</b>`,
                    html: html,
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if(result.isConfirmed){
                        if(!Iguales_Nombres){
                            $("#input_nombre").val($("#input_nombre_update").val());
                            transfersTitle()
        }
        if(!Iguales_Colonias || !Iguales_Lotes || !Iguales_Longitud || !Iguales_Latitud){
            $("#input_longitud") .val($("#input_longitud_update") .val());
            $("#input_latitud")  .val($("#input_latitud_update")  .val());
            $("#input_colonia")  .val($("#input_colonia_update")  .val());
            $("#input_lote")     .val($("#input_lote_update")     .val());
            ChangeLocation()
           
        }
        if(!Iguales_Arrendatarios){
           $("#input_arrendatario").val($("#input_arrendatario_update").val());
            UpdateInfoTitle('Tenant',input_arrendatario_update)
        }
        if(!Iguales_Vigencias){
      
        $("#input_vigencia").val($("#input_vigencia_update").val());
            UpdateInfoTitle('Validity',input_vigencia_update)
        }
        if(!Iguales_Inicio){
         $("#input_inicio").val($("#input_inicio_update").val());
            UpdateInfoTitle('Initial_Date',input_inicio_update)
        }
        if(!Iguales_Dotacion){
     
         $("#input_dotacion").val( $("#input_dotacion_update").val());
            UpdateInfoTitle('Water_Supply',input_dotacion_update)
        }
        if(!Iguales_Prorroga){
         
            $("#prorroga").val($("#prorroga_update").val());
            UpdateInfoTitle('Extend',prorroga_update)
        }  
                        
                    }
                });
        
    }
    
    function transfersTitle(){
        const data = { 'Title_Number'   :   $("#input_titulo_update").val(), 
                       'Control_Num'    :   classTitle.getUser_Id() };
       $.ajax({
            url : `${link.Server}TransferTitleWithDocument.php`,
            data : data,
            type : 'POST',
            success: data => {lottiesSuccessActives ();}
        });
    }
    function ChangeLocation(){
        const Longitude      = $("#input_longitud_update") .val();
        const Latitude       = $("#input_latitud_update")  .val();
        const Cologne        = $("#input_colonia_update")  .val();
        const Plot           = $("#input_lote_update")     .val();
        const data = {  'Title_Id'      :   classTitle.getTitle_Id(),
                        'Cologne'       :   Cologne             ,
                        'Plot'          :   Plot                ,
                        'Longitude'     :   Longitude           ,
                        'Latitude'      :   Latitude};  
       $.ajax({
            url : `${link.Server}ChangeUbicationWithDocument.php`,
            data : data,
            type : 'POST',
            success: data => {lottiesSuccessActives ();}
        });
    }
    const UpdateInfoTitle = (Encabezado,value) =>{
       

        
        const data = {  'Title_Id'      :       classTitle.getTitle_Id(),
                        'Encabezado'    :       Encabezado,
                        'Value'         :       value }; 
        $.ajax({
            url : `${link.Server}updateInfoTitle.php`,
            data : data,
            type : 'POST',
            success: data => {lottiesSuccessActives ();}
        });
        
        
    }
    const addNewTitle = (user_id, title_number, water_supply, initial_date, validity, extend, cologne, plot, longitude, latitude,tenant) => {
        const data = { 
                        'user_id'       :   user_id        ,       'title_number'  :   title_number     ,
                        'water_supply'  :   water_supply   ,       'initial_date'  :   initial_date     ,
                        'validity'      :   validity       ,       'extend'        :   extend           ,
                        'cologne'       :   cologne        ,       'plot'          :   plot             ,
                        'longitude'     :   longitude      ,       'latitude'      :   latitude         ,
                        'tenant'        :   tenant
        };
        return $.ajax({
            url : `${link.Server}addNewTitle.php`,
            data : data,
            type : 'POST',
            success : data => {
                $("#input_nombre")       .val($("#input_nombre_update")          .val());
                $("#input_titulo")       .val($("#input_titulo_update")          .val());
                $("#input_arrendatario") .val($("#input_arrendatario_update")    .val());
                $("#input_sector")       .val($("#input_sector_update")          .val());
                $("#input_colonia")      .val($("#input_colonia_update")         .val());
                $("#input_lote")         .val($("#input_lote_update")            .val());
                $("#input_vigencia")     .val($("#input_vigencia_update")        .val());
                $("#input_inicio")       .val($("#input_inicio_update")          .val());
                $("#input_dotacion")     .val($("#input_dotacion_update")        .val());
                $("#input_longitud")     .val($("#input_longitud_update")        .val());
                $("#input_latitud")      .val($("#input_latitud_update")         .val());
                $("#prorroga")           .val($("#prorroga_update")              .val()); 
                lottiesSuccessActives ();
      
            }
            });
        
    }
    const noFoundTitle = title =>{
        const $msg=`

        `;
        Swal.fire({
                    title: `Título <b>${title}</b> no encontrado ¿Desea registrarlo?`,
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if(result.isConfirmed){
                        switRegisterTitle(title)
                    }
                });
    }
    const switRegisterTitle = title =>{
        
        const $msg=`
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Título</th>
                    <td>    ${$("#input_titulo_update")   .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Usuario</th>
                    <td>    ${ $("#input_nombre_update")   .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Arrendatario</th>
                    <td>    ${$("#input_arrendatario_update").val()}</td>
                </tr>
                <tr>
                    <th scope="row">Colonia</th>
                    <td>    ${$("#input_colonia_update")  .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Lote</th>
                    <td>    ${$("#input_lote_update")     .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Vigencia</th>
                    <td>    ${$("#input_vigencia_update") .val()}</td>
                </tr>
                    <th scope="row">Inicio</th>
                    <td>    ${$("#input_inicio_update")   .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Dotación</th>
                    <td>    ${$("#input_dotacion_update") .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Longitud</th>
                    <td>    ${$("#input_longitud_update") .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Latitud</th>
                    <td>    ${$("#input_latitud_update")  .val()}</td>
                </tr>
                <tr>
                    <th scope="row">Prorroga</th>
                    <td>    ${$("#prorroga_update")       .val()}</td>
                </tr>
            </tbody>
        </table>
        `;
        Swal.fire({
                    title: `Se registrará el título:`,
                    html: $msg,
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if(result.isConfirmed){

                        addNewTitle(classTitle.getUser_Id()                 ,     $("#input_titulo_update")     .val(),
                                    $("#input_dotacion_update")     .val()  ,     $("#input_inicio_update")     .val(),
                                    $("#input_vigencia_update")     .val()  ,     $("#prorroga_update")         .val(), 
                                    $("#input_colonia_update")      .val()  ,     $("#input_lote_update")       .val(), 
                                    $("#input_longitud_update")     .val()  ,     $("#input_latitud_update")    .val(),
                                    $("#input_arrendatario_update") .val()
                                    );
                        Swal.fire('Título registrado con exito!', '', 'success')
                    }
                });
    }
    const addTitles = id =>{ // manda a añadir a los usuarios y añae vista a los usuarios
        $(".sin_seleccionar").hide();
                            $(`#${id}`).toggleClass("selected");
                            $(".index").show();
                            
                            var newElement = `
                            <div class="title_seleccionado " id="id_title_seleccionado_${id}">
                                <h6> ${$(`#${format_id(id,5)}`).val()} </h6>
                                <a href="#${id}" style="color:white" class="cancelar" id="cancelar_${id}"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                            `
                            if( !ElementExist (id) ){
                            $(".object").after(newElement);
                            }
                            
                            ElementsAddUpdate(id,$(`#${format_id(id,5)}`).val());
                         
                            ElementsShowUpdate();

                            ;
    }

    const dropTitle = id => { // manda a borrar los elementos
             
             $(`#${id}`).removeClass("selected");
            $(`#${format_id(id,3)}`).removeClass("title_seleccionado").addClass("deseleccionar ");
            ElementsDropUpdate(id);
            
           
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
    const ElementsAddUpdate = (Id_Info,Title) => {// añade los elementos al array list
      
                    if( ElementExist (Id_Info) ){
                        dropTitle(Id_Info);
                    }else{
                        ArrayListTitles.setArrayElements(Id_Info,Title);
                      

                    }
                    
                }
                const ElementsDropUpdate = (Id_Info) => { // borra los elementos del array list
                    ArrayListTitles.dropTitle(Id_Info);
                    
                }
                const ElementsShowUpdate = () => { // muestra los elementos del arraylist
                    
                    ArrayListTitles.getArrayElements().forEach(title => {
                    console.log(`id: ${title.Id_Info} numero: ${title.Elements} posicion: ${ArrayListTitles.searchTitle(title.Id_Info)}`);
                    
                });
                }
                const ElementExist = Id_Info =>{
                    
                    var Existe=false;
                   ArrayListTitles.getArrayElements().forEach(title => {
                    if(title.Id_Info == Id_Info){
                        Existe=true;
                    }   
                })
                return Existe;
                
                }
   
    const elementCarousel = (array,index)=> { // se crea el elemento de carousel y se meuestra 
      const title=array[index].getElements();
      const id=array[index].getId_Info();
        var html = `
           <div class="container_update" id="${format_id(index,6)}">
                        <div class="user_previous">
                            <div class="class_img_user">
                                <div class="circulo">
                                    <span><i class="fa-solid fa-question"></i></span>
                                </div>
                            </div>
                            <div  id="form_user"  class="class_info_user">
                            
                                <div class="titulos_update"><label for="input_nombre">Nombre de Usuario</label></div>
                                <div class="content_input_update"><input id="input_nombre"        name="input_nombre"         type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_titulo">Número de título</label></div>
                                <div class="content_input_update"><input id="input_titulo"        name="input_titulo"         type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_arrendatario">Arrendatario</label></div>
                                <div class="content_input_update"><input id="input_arrendatario"  name="input_arrendatario"   type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_sector">Sector</label></div>
                                <div class="content_input_update"><input id="input_sector"        name="input_sector"         type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_colonia">Colonia</label></div>
                                <div class="content_input_update"><input id="input_colonia"       name="input_colonia"        type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_lote">Lote</label></div>
                                <div class="content_input_update"> <input id="input_lote"          name="input_lote"           type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"> <label for="input_vigencia">Vigencia</label></div>
                                <div class="content_input_update"><input id="input_vigencia"      name="input_vigencia"       type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_inicio">Inicio</label></div>
                                <div class="content_input_update"><input id="input_inicio"        name="input_inicio"         type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_dotacion">Dotación</label></div>
                                <div class="content_input_update"><input id="input_dotacion"      name="input_dotacion"       type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_longitud">Longitud</label></div>
                                <div class="content_input_update"><input id="input_longitud"      name="input_longitud"       type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="input_latitud">Latitude</label></div>
                                <div class="content_input_update"> <input id="input_latitud"       name="input_latitud"        type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update"><label for="prorroga">Prorroga</label></div>
                                <div class="content_input_update"><input  id="prorroga"      name="input_latitud"        type="text"     class="input_user_update" value="Sin regisrar" disabled></div>
                            </div>
                        </div>
                        <div class="user_separator">
                            <span> <p class="status_update">Actualizando...</p></span>
                            <div class="player_lottie">
                            <lottie-player  src="animations/update_user.json"  background="transparent"  speed="0.5"  ></lottie-player>
                            </div>
                        </div>
                        <div class="user_new">
                            <div class="class_img_user">
                                <div class="circulo">
                                    <span><i class="fa-solid fa-users"></i></span>
                                </div>
                            </div>
                            <div  class="class_info_user">
                        
                                <div class="titulos_update">        <label for  ="input_nombre_update"          >Nombre de Usuario</label></div>
                                <div class="content_input_update">  <input id   ="input_nombre_update"        name="input_nombre"         type="text"     class="input_user_update" value="Sin regisrar" disabled> </div>

                                <div class="titulos_update">        <label for  ="input_titulo_update"          >Número de título</label> </div>
                                <div class="content_input_update">  <input id   ="input_titulo_update"        name="input_titulo"         type="text"     class="input_user_update" value="Sin regisrar" disabled> </div>
                               
                                <div class="titulos_update">        <label for  ="input_arrendatario_update"    >Arrendatario</label>  </div>
                                <div class="content_input_update">  <input id   ="input_arrendatario_update"  name="input_arrendatario"   type="text"     class="input_user_update" value="Sin regisrar" disabled> </div>

                                <div class="titulos_update">        <label for  ="input_sector_update"          >Sector</label></div>
                                <div class="content_input_update">  <input id   ="input_sector_update"        name="input_sector"         type="text"     class="input_user_update" value="Sin regisrar" disabled> </div>

                                <div class="titulos_update">        <label for  ="input_colonia_update">Colonia</label></div>
                                <div class="content_input_update">  <input id   ="input_colonia_update"       name="input_colonia"        type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update">        <label for  ="input_lote_update">Lote</label> </div>
                                <div class="content_input_update">  <input id   ="input_lote_update"          name="input_lote"           type="text"     class="input_user_update" value="Sin regisrar" disabled> </div>

                                <div class="titulos_update">        <label for  ="input_vigencia_update">Vigencia</label> </div>
                                <div class="content_input_update">  <input id   ="input_vigencia_update"      name="input_vigencia"       type="text"     class="input_user_update" value="Sin regisrar" disabled>     </div>

                                <div class="titulos_update">        <label for  ="input_inicio_update">Inicio</label></div>
                                <div class="content_input_update">  <input id   ="input_inicio_update"        name="input_inicio"         type="text"     class="input_user_update" value="Sin regisrar" disabled>     </div>

                                <div class="titulos_update">        <label for  ="input_dotacion_update">Dotación</label></div>
                                <div class="content_input_update">  <input id   ="input_dotacion_update"      name="input_dotacion"       type="text"     class="input_user_update" value="Sin regisrar" disabled></div>

                                <div class="titulos_update">        <label for  ="input_longitud_update">Longitud</label></div>
                                <div class="content_input_update">  <input id   ="input_longitud_update"      name="input_longitud"       type="text"     class="input_user_update" value="Sin regisrar" disabled>      </div>

                                <div class="titulos_update">        <label for  ="input_latitud_update">Latitude</label> </div>
                                <div class="content_input_update">  <input id   ="input_latitud_update"       name="input_latitud"        type="text"     class="input_user_update" value="Sin regisrar" disabled>      </div>

                                <div class="titulos_update">        <label for  ="prorroga_update">Prorroga</label>  </div>
                                <div class="content_input_update">  <input  id  ="prorroga_update"      name="input_latitud"        type="text"     class="input_user_update" value="Sin regisrar" disabled>     </div>
                            </div>
                        </div>
                    </div>
           `; 
        
           $(".actualizar_body_actual").append(html);
        setTimeout(() => {title_update_document  ({'Id_Info':id},{'title':title});
                          $(".class_info_user").scroll(function() {
                            const valor = $(".class_info_user").scrollTop();
                             $(".class_info_user").scrollTop(valor);
                          });
                                   },1580)
           
          
           
    }   
    const carouselvalidity = (array,index,entrada) => { // comprueba si estas en algun extremo
        const size = array.length;
        switch (entrada){
            case "izquierdo":   return      index <= 0      ? false:true;
            case "derecho":     return      index >= size-1   ? false:true; 
        }
        return false;
           
    }
   
    const carousel= (array,entrada) =>{ // conrola los eventos del carousel
        switch(entrada){
            case "izquierdo":
                if(carouselvalidity(array,indexCarousel,"izquierdo")){
                    indexCarousel--;
                    numCarousel(numCarousel)
                    elementCarousel(ArrayListTitles.getArrayElements(),indexCarousel)
                    $(`#${format_id(indexCarousel+1,6)}`).removeClass("").addClass("salida_por_derecha");
                    $(`#${format_id(indexCarousel,6)}`).removeClass("").addClass("entrada_por_izquierda");
                    $(".actualizar_body_next").prop("disabled",true);
                    $(".actualizar_body_previous").prop("disabled",true);
                    $("#button_update").prop("disabled",true);
                    setTimeout(() => {
                        $(`#${format_id(indexCarousel+1,6)}`).remove();
                        $(".actualizar_body_next").prop("disabled",false);
                        $(".actualizar_body_previous").prop("disabled",false);
                        $("#button_update").prop("disabled",false);
                    }, 1500);
                }
                break;
            case "derecho":
                if(carouselvalidity(array,indexCarousel,"derecho")){
                    indexCarousel++;
                    numCarousel(numCarousel)
                    elementCarousel(ArrayListTitles.getArrayElements(),indexCarousel)
                    $(`#${format_id(indexCarousel-1,6)}`).removeClass("").addClass("salida_por_izquierda");
                    $(`#${format_id(indexCarousel,6)}`).removeClass("").addClass("entrada_por_derecha");
                    $(".actualizar_body_next").prop("disabled",true);
                    $(".actualizar_body_previous").prop("disabled",true);
                    $("#button_update").prop("disabled",true);
                    setTimeout(() => {
                        $(`#${format_id(indexCarousel-1,6)}`).remove();
                        $(".actualizar_body_next").prop("disabled",false);
                        $(".actualizar_body_previous").prop("disabled",false);
                        $("#button_update").prop("disabled",false);
                        
                    }, 1500);
                }
                break;
        }

        function numCarousel()  {
            $("#num_total").html(`${indexCarousel+1} de ${ArrayListTitles.getArrayElements().length}`);   
        }
    }
    const title_update_document = (data,data2) => {// toma los valores que se encontraron en documentos y los muestra en el carousel
        $.ajax({
            
            url : `${link.Server}consult_update_title.php`,
            data : data,
            type : 'POST',
            beforeSend: function () {
                
            },
            success: data => {
                var json = JSON.parse(data)
                const Title_Number      = json[0].Title_Number      == null ? "Sin registrar":json[0].Title_Number;
                const User              = json[0].User              == null ? "Sin registrar":json[0].User;
                const Type_User         = json[0].Type_User         == null ? "Sin registrar":json[0].Type_User;
                const Initial_Date      = json[0].Initial_Date      == null ? "Sin registrar":json[0].Initial_Date;
                const Water_Supply      = json[0].Water_Supply      == null ? "Sin registrar":json[0].Water_Supply;
                const Longitude         = json[0].Longitude         == null ? "Sin registrar":json[0].Longitude;
                const Latitude          = json[0].Latitude          == null ? "Sin registrar":json[0].Latitude;
                const Validity          = json[0].Validity          == null ? "Sin registrar":json[0].Validity;
                const Extend            = json[0].Extend            == null ? "Sin registrar":json[0].Extend;
                const Tenant            = json[0].Tenant            == null ? "Sin registrar":json[0].Tenant;
                const Cologne           = json[0].Cologne           == null ? "Sin registrar":json[0].Cologne;
                const Plot              = json[0].Plot              == null ? "Sin registrar":json[0].Plot;

                $("#input_nombre_update").val(User);
                $("#input_titulo_update").val(Title_Number);
                $("#input_arrendatario_update").val(Tenant);
                $("#input_sector_update").val(Type_User);
                $("#input_colonia_update").val(Cologne);
                $("#input_lote_update").val(Plot);
                $("#input_vigencia_update").val(Validity);
                $("#input_inicio_update").val(Initial_Date);
                $("#input_dotacion_update").val(Water_Supply);
                $("#input_longitud_update").val(Longitude);
                $("#input_latitud_update").val(Latitude);
                $("#prorroga_update").val(Extend);

                title_update(data2)
            },   
            error : function(jqXHR, status, error) {
                alert('Disculpe, existió un problema');
            }, 
        });
    }
    const title_update = data => {// toma los valores que se encontraron en la base de datos y los muestra en el carousel
        $.ajax({
            
            url : `${link.Server}consult_update_title.php`,
            data : data,
            type : 'POST',
            beforeSend: function () {
                
            },
            success: data => {
                if(data!=0){
                var json = JSON.parse(data)
                const Title_Number      = json[0].Title_Number      == null ? "Sin registrar":json[0].Title_Number;
                const User              = json[0].Full_Name         == null ? "Sin registrar":json[0].Full_Name;
                const Type_User         = json[0].Type_User         == null ? "Sin registrar":json[0].Type_User;
                const Initial_Date      = json[0].Initial_Date      == null ? "Sin registrar":json[0].Initial_Date;
                const Water_Supply      = json[0].Water_Supply      == null ? "Sin registrar":json[0].Water_Supply;
                const Longitude         = json[0].Longitude         == null ? "Sin registrar":json[0].Longitude;
                const Latitude          = json[0].Latitude          == null ? "Sin registrar":json[0].Latitude;
                const Validity          = json[0].Validity          == null ? "Sin registrar":json[0].Validity;
                const Extend            = json[0].Extend            == null ? "Sin registrar":json[0].Extend;
                const Tenant            = json[0].Tenant            == null ? "Sin registrar":json[0].Tenant;
                const Cologne           = json[0].Cologne           == null ? "Sin registrar":json[0].Cologne;
                const Plot              = json[0].Plot              == null ? "Sin registrar":json[0].Plot;

                $("#input_nombre")          .val(User);
                $("#input_titulo")          .val(Title_Number);
                $("#input_arrendatario")    .val(Tenant);
                $("#input_sector")          .val(Type_User);
                $("#input_colonia")         .val(Cologne);
                $("#input_lote")            .val(Plot);
                $("#input_vigencia")        .val(Validity);
                $("#input_inicio")          .val(Initial_Date);
                $("#input_dotacion")        .val(Water_Supply);
                $("#input_longitud")        .val(Longitude);
                $("#input_latitud")         .val(Latitude);
                $("#prorroga")              .val(Extend);
                }else{
                $("#input_nombre")          .val("Sin registrar");
                $("#input_titulo")          .val("Sin registrar");
                $("#input_arrendatario")    .val("Sin registrar");
                $("#input_sector")          .val("Sin registrar");
                $("#input_colonia")         .val("Sin registrar");
                $("#input_lote")            .val("Sin registrar");
                $("#input_vigencia")        .val("Sin registrar");
                $("#input_inicio")          .val("Sin registrar");
                $("#input_dotacion")        .val("Sin registrar");
                $("#input_longitud")        .val("Sin registrar");
                $("#input_latitud")         .val("Sin registrar");
                $("#prorroga")              .val("Sin registrar");
                }
                lottiesSuccessActives ();

                
            },   
            error : function(jqXHR, status, error) {
                alert('Disculpe, existió un problema');
            }, 
        });
    }
    function lottiesSuccessActives ()  {//Muestra si el usuario ya está actualizado con loties

        if($("#input_sector_update").val() == "Sin Registrar"){
            $("#input_sector_update").val($("#input_sector").val());
        }
        const input_nombre_update        = $("#input_nombre_update")   .val();
        const input_titulo_update        = $("#input_titulo_update")   .val();
        const input_arrendatario_update  = $("#input_arrendatario_update").val();
        const input_sector_update        = $("#input_sector_update")   .val();
        const input_colonia_update       = $("#input_colonia_update")  .val();
        const input_lote_update          = $("#input_lote_update")     .val();
        const input_vigencia_update      = $("#input_vigencia_update") .val();
        const input_inicio_update        = $("#input_inicio_update")   .val();
        const input_dotacion_update      = $("#input_dotacion_update") .val();
        const input_longitud_update      = $("#input_longitud_update") .val();
        const input_latitud_update       = $("#input_latitud_update")  .val();
        const prorroga_update            = $("#prorroga_update")       .val(); 

        const input_nombre               = $("#input_nombre")          .val();
        const input_titulo               = $("#input_titulo")          .val();
        const input_arrendatario         = $("#input_arrendatario")    .val();
        const input_sector               = $("#input_sector")          .val();
        const input_colonia              = $("#input_colonia")         .val();
        const input_lote                 = $("#input_lote")            .val();
        const input_vigencia             = $("#input_vigencia")        .val();
        const input_inicio               = $("#input_inicio")          .val();
        const input_dotacion             = $("#input_dotacion")        .val();
        const input_longitud             = $("#input_longitud")        .val();
        const input_latitud              = $("#input_latitud")         .val();
        const prorroga                   = $("#prorroga")              .val();

       
        $(".lottie-player-success").remove();
        const lottie = `<lottie-player class="lottie-player-success" src="animations/success.json"  background="transparent"  speed="1"   autoplay></lottie-player>`;
        const lottieUpdate = `<lottie-player  src="animations/update_user.json"  background="transparent"  speed="0.25"   autoplay></lottie-player>`;
        var update = true;
        if(input_nombre == input_nombre_update)                 {       $("#input_nombre")      .after(lottie);     }else{update = false;}
        if(input_titulo == input_titulo_update)                 {       $("#input_titulo")      .after(lottie);     }else{update = false;}
        if(input_arrendatario == input_arrendatario_update)     {       $("#input_arrendatario").after(lottie);     }else{update = false;}
        if(input_sector == input_sector_update)                 {       $("#input_sector")      .after(lottie);     }else{update = false;}
        if(input_colonia == input_colonia_update)               {       $("#input_colonia")     .after(lottie);     }else{update = false;}
        if(input_lote == input_lote_update)                     {       $("#input_lote")        .after(lottie);     }else{update = false;}
        if(input_vigencia == input_vigencia_update)             {       $("#input_vigencia")    .after(lottie);     }else{update = false;}
        if(input_inicio == input_inicio_update)                 {       $("#input_inicio")      .after(lottie);     }else{update = false;}
        if(input_dotacion == input_dotacion_update)             {       $("#input_dotacion")    .after(lottie);     }else{update = false;}
        if(input_longitud == input_longitud_update)             {       $("#input_longitud")    .after(lottie);     }else{update = false;}
        if(input_latitud == input_latitud_update)               {       $("#input_latitud")     .after(lottie);     }else{update = false;}
        if(prorroga == prorroga_update)                         {       $("#prorroga")          .after(lottie);     }else{update = false;}
                                                    
                                                
        if(update == true){
            $(".player_lottie").html(lottieUpdate);
            $(".status_update").html("Actualizado");
            $("#button_update").prop("disabled",true);
        }else{
            $("#button_update").prop("disabled",false);
        }
        }
   
    function noFoundUser(){
        const input_nombre_update        = $("#input_nombre_update")   .val();
        const textHtml =`
            <p>El usuario <b> ${input_nombre_update}</b> no pertenece al padrón de usuarios</p>
        `;
        Swal.fire({
        title: 'Usuario no encotrado',
        icon: 'info',
        html: textHtml,
        buttonsStyling: false,
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Registrar',
        cancelButtonText: 'Salir',
        denyButtonText: `Buscar`,
        customClass: {
            
            confirmButton: 'class_swit_button' ,//insert class here
            denyButton: 'class_swit_button',
            cancelButton: 'class_swit_button'
        }
        }).then((result) => {
            if (result.isConfirmed) {
                registerUser()
            }else if(result.isDenied){
                switchAlertSearchUser()
            }
        })
    }
    function registerUser(){
        const user_name        = $("#input_nombre_update")   .val();
        const type             = $("#input_sector_update")   .val();
        Swal.fire({
            title: '',
            icon: 'question',
            html: '<p>Seguro que desea registrar el usuario <b>'+user_name+'</b> en el padrón de usuarios</p>',
            showDenyButton: true,
            confirmButtonText: 'Confirmar',
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
               
                setUser(user_name,type)
                Swal.fire('Usuario registrado con exito!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Usuario no registrado', '', 'info')
            }
        })
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
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Regresar',
                    denyButtonText: `Cancelar`,
                    width: '700px',
                }).then((result) => {
                               
                    if (result.isConfirmed) {
                        if($("#input_search_user").val()!=""){
                            const array_document_info = ArrayListTitles.getArrayElements();
                            const Id_Info = array_document_info[indexCarousel].Id_Info;
                            const Value = $("#input_search_user").val();

                            updateInfoDocument(Id_Info,`'${Value}'`,"User");
                            $("#input_nombre_update").val(Value);
                            lottiesSuccessActives ();

                            Swal.fire('Guardado!', '', 'success')
                        }else{
                            Swal.fire('No selecciono ningun usuario', '', 'info') .then((result) => {switchAlertSearchUser()})
                        }

                    } else if (result.isDenied) {
                                   
                    } else {
                        switchAlertSearchUser();
                    }
                            })
    }
    //----------------------- Sección de eventos -----------------------
    $(document).on('keyup','.input_search',function(){
        var valor= $(this).val();
      
            busqueda(valor,'Títulos');    
       

   
    });  
   
    $(".seleccionar_todo").click(function(){
        $(`.seleccionar_todo`).removeClass("runing_animation").addClass("runing_animation_reves");
            var ids = [...document.querySelectorAll('.reg_sin_actualizar')].map(e => e.id);
            ArrayListTitles.Elements=[]
            var newElement=""
            for(var id of ids) 
                {
                     newElement += `
                            <div class=" title_seleccionado " id="id_title_seleccionado_${id}">
                                <h6> ${$(`#${format_id(id,5)}`).val()} </h6>
                                <a href="#${id}" style="color:white" class="cancelar" id="cancelar_${id}"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                            `;  
                    ElementsAddUpdate(id,$(`#${format_id(id,5)}`).val());
                   
                 
                }      
                            

                            $(".sin_seleccionar").hide();
                            $(".index").show();
                            $(".object").after(newElement);
                            $(`.getIdInfo`).removeClass("selected").addClass("");
                            $(`.reg_sin_actualizar`).removeClass("selected").addClass("selected");
                            $(".cancelar").click(function() { dropTitle(format_id($(this).attr("id"),2)); }); 
                            $(`.remover_seleccion`).removeClass("runing_animation_reves").addClass("runing_animation");
              
    });
    $(".remover_seleccion").click(function(){
        $(`.remover_seleccion`).removeClass("runing_animation").addClass("runing_animation_reves");
        
        setTimeout(() => { $(`.selected`).removeClass("selected");},1000);
        setTimeout(() => { $(`.title_seleccionado`).removeClass("title_seleccionado").addClass("deseleccionar");},500);
        setTimeout(() => {  ArrayListTitles.Elements=[];$(`.seleccionar_todo`).removeClass("runing_animation_reves").addClass("runing_animation");},1300);
       
    }); 
        $(".actualizar_body_previous").click(function(){
          carousel(ArrayListTitles.getArrayElements(),"izquierdo")
        });
         
        $(".actualizar_body_next").click(function(){
          
          carousel(ArrayListTitles.getArrayElements(),"derecho")
        });
        $("#actualizar_show").click(function(){
            if(ArrayListTitles.getArrayElements().length > 0){
                elementCarousel(ArrayListTitles.getArrayElements(),indexCarousel)
                $(".Actualizaciones").removeClass("salida_actualizar").addClass("entrada_actualizar");
                $("#num_total").html(`${indexCarousel+1} de ${ArrayListTitles.getArrayElements().length}`);    
            }
        
        });
        $(".exit_updates").click(function(){
            $(".Actualizaciones").removeClass("entrada_actualizar").addClass("salida_actualizar");
            $(".container_update").remove();
            busqueda("");
        });
        $("#button_update").click(function(){
            const user        = $("#input_nombre_update")   .val();
          existe (user,"user")
    
          

        });
});
