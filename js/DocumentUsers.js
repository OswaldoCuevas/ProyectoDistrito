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
function limitLetters(limit, expresion){
let array = expresion.split("");
array.length = array.length > limit ? limit: array.length;
return array.join("")+"...";

}
function busqueda(buscar){ 
    var html;
            html=`
            <thead class="thead-dark">
                <tr>
                    <th scope="col"> No.                </th>
                    <th scope="col"> Actualizado        </th>
                    <th scope="col"> Usuario            </th>
                    <th scope="col"> RFC                </th>
                    <th scope="col"> CURP               </th>
                    <th scope="col"> Teléfono           </th>
                    <th scope="col"> Correo             </th>
                </tr>
            </thead>
            <tbody>
            `;
    
    $.ajax({ // crea la tabla con los valores obtenidos de la basede datos
        
            url : `${link.Server}consulta_general_info_documento.php`,
            data : {'buscar' : buscar,'type': 'Padrón de usuarios','id': $("#id_documento").val()},
            type : 'POST',
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
 const updateInfoDocument = (Id_Info,Value,Encabezado,id) =>{ //actualiza la información de documentos info  en la base de datos
     const data = { 'Id_Info' : Id_Info, 'Value' : `'${Value}'`, 'Encabezado' : Encabezado };
     $.ajax({
         url : `${link.Server}update_document.php`,
         data : data,
         type : 'POST',
         success: response => {
            $(id).val(Value);
            lottiesSuccessActives ();
         },
     });                               
 }
 
 const setUser = (user) =>{ //actualiza la información de documentos info  en la base de datos
     const data = { 'user' : user };
     $.ajax({
         url : `${link.Server}addUserWithDocument.php`,
         data : data,
         type : 'POST',
         success: data => {
            $("#input_nombre").val($("#input_nombre_update").val())   
            lottiesSuccessActives ();
            
        },
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
                     //const $title =  $("#input_titulo_update").val() ;
                   
                     if(data==0 ){
                         noFoundUser()
                     
                     }else{
                        
                         classTitle.setUser_Id(data);
                         comparaciones();
                     }
                 break;
             }
          
         }
     });
 }
 function comparaciones(){

    const input_telefono_update             = $("#input_telefono_update")        .val();
    const  input_RFC_update                 = $("#input_RFC_update")             .val();
    const  input_Correo_update              = $("#input_correo_update")          .val();
    const  input_CURP_update                = $("#input_CURP_update")            .val();


    const input_telefono                    = $("#input_telefono")               .val();
    const  input_RFC                        = $("#input_RFC")                    .val();
    const  input_Correo                     = $("#input_correo")                 .val();
    const  input_CURP                       = $("#input_CURP")                   .val();
    
 
     // transfersTitle()
     const Iguales_Telefono          = input_telefono_update     == input_telefono      ? true:false;
     const Iguales_RFC               = input_RFC_update          == input_RFC           ? true:false;
     const Iguales_Correo            = input_Correo_update       == input_Correo         ? true:false;
     const Iguales_CURP              = input_CURP_update         == input_CURP           ? true:false;

     const array_document_info = ArrayListTitles.getArrayElements();
     const Id_Info = array_document_info[indexCarousel].Id_Info;
     var html=``;
Iguales_CURP
   
     if(!Iguales_Telefono && input_telefono_update != "Sin registrar"){
         html += `<table class="table" style="margin-top:10px">
             <thead class="thead-dark">
                 <tr>
                 <th colspan="2">Nuevo teléfono</th>
                 </tr>
                 <tr>
                     <th scope="col">teléfono previo</th>
                     <th scope="col">teléfono nuevo</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>${input_telefono}</td>
                     <td style="color:blue">${input_telefono_update}</td>
                 </tr>
             </tbody>
         </table> `;
     }
     if(!Iguales_RFC && input_RFC_update != "Sin registrar" ){
         html += `<table class="table" style="margin-top:10px">
             <thead class="thead-dark">
                 <tr>
                 <th colspan="2">Cambio RFC</th>
                 </tr>
                 <tr>
                     <th scope="col">Antiguo RFC</th>
                     <th scope="col">Nuevo RFC</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>${input_RFC}</td>
                     <td style="color:blue">${input_RFC_update}</td>
                 </tr>
             </tbody>
         </table> `;
     }
     if(!Iguales_Correo &&input_Correo_update != "Sin registrar"){
         html += `<table class="table" style="margin-top:10px">
             <thead class="thead-dark">
                 <tr>
                 <th colspan="2">Nuevo correo</th>
                 </tr>
                 <tr>
                     <th scope="col">Antiguo correo</th>
                     <th scope="col">Nuevo correo</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>${input_Correo}</td>
                     <td style="color:blue">${input_Correo_update}</td>
                 </tr>
             </tbody>
         </table> `;
     }
     if(!Iguales_CURP && input_CURP_update != "Sin registrar"){
         html += `<table class="table" style="margin-top:10px">
             <thead class="thead-dark">
                 <tr>
                 <th colspan="2">Cambio de CURP</th>
                 </tr>
                 <tr>
                     <th scope="col">Antigua</th>
                     <th scope="col">Nueva</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>${input_CURP}</td>
                     <td style="color:blue">${input_CURP_update}</td>
                 </tr>
             </tbody>
         </table> `;
     }

     Swal.fire({
                 title: `Actualizaciones para usuario <b>${ $("#input_nombre_update").val() } </b>`,
                 html: html,
                 showDenyButton: true,
                 confirmButtonText: 'Confirmar',
                 denyButtonText: `Cancelar`,
             }).then((result) => {
                
                 if(result.isConfirmed){
     if(!Iguales_Telefono){
        if(input_telefono_update == "Sin registrar"){
            updateInfoDocument(Id_Info,input_telefono,"Phone_Number","#input_telefono_update")
        }else{
            $("#input_telefono").val($("#input_telefono_update").val());
            UpdateInfoUser('Phone_Number',input_telefono_update )
        }
        
        
        
     }
     if(!Iguales_RFC ){
        if(input_RFC_update == "Sin registrar"){
            updateInfoDocument(Id_Info,input_RFC,"RFC","#input_RFC_update")
        }else{
            $("#input_RFC").val($("#input_RFC_update").val());
            UpdateInfoUser('RFC',input_RFC_update)
        }
      
     }
     if(!Iguales_Correo ){
        if(input_Correo_update == "Sin registrar"){
            updateInfoDocument(Id_Info,input_Correo,"Email","#input_Correo_update")
        }else{
            $("#input_correo").val( $("#input_correo_update").val());
            UpdateInfoUser('Email',input_Correo_update)
        }
      
     }
     if(!Iguales_CURP ){
      if( input_CURP_update == "Sin registrar"){
        updateInfoDocument(Id_Info,input_CURP,"CURP","#input_CURP_update")
      }else{
        $("#input_CURP").val($("#input_CURP_update").val());
        UpdateInfoUser('CURP',input_CURP_update)
      }
      
     }  
                     
                 }
             });
     
 }
 
 const UpdateInfoUser = (Encabezado,value) =>{
    

     
     const data = {  'User_Id'      :       classTitle.getUser_Id(),
                     'Encabezado'    :       Encabezado,
                     'Value'         :       value }; 
     $.ajax({
         url : `${link.Server}updateInfoUser.php`,
         data : data,
         type : 'POST',
         success: data => {lottiesSuccessActives ();}
     });
     
     
 }
 

 const addTitles = id =>{ // manda a añadir a los usuarios y añae vista a los usuarios
     $(".sin_seleccionar").hide();
                         $(`#${id}`).toggleClass("selected");
                         $(".index").show();
                         
                         var newElement = `
                         <div class="title_seleccionado " id="id_title_seleccionado_${id}">
                             <h6> ${limitLetters(20, $(`#${format_id(id,5)}`).val())} </h6>
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
         case 5:                                                     return "name_"+id;                 break;
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
                             <div class="content_input_update"><input id="input_nombre"        name="input_nombre"         type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                             <div class="titulos_update"><label for="input_RFC">RFC</label></div>
                             <div class="content_input_update"><input id="input_RFC"           name="input_RFC"            type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                             <div class="titulos_update"><label for="input_CURP">CURP</label></div>
                             <div class="content_input_update"><input id="input_CURP"  name="input_CURP"   type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                             <div class="titulos_update"><label for="input_telefono">Teléfono</label></div>
                             <div class="content_input_update"><input id="input_telefono"        name="input_telefono"         type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                             <div class="titulos_update"><label for="input_correo">Correo</label></div>
                             <div class="content_input_update"><input id="input_correo"       name="input_correo"        type="text"     class="input_user_update" value="Sin registrar" disabled></div>

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
                     
                        
                         <div class="titulos_update"><label for="input_nombre_update">Nombre de Usuario</label></div>
                         <div class="content_input_update"><input id="input_nombre_update"        name="input_nombre_update"         type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                         <div class="titulos_update"><label for="input_RFC_update">RFC</label></div>
                         <div class="content_input_update"><input id="input_RFC_update"           name="input_RFC_update"            type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                         <div class="titulos_update"><label for="input_CURP_update">CURP</label></div>
                         <div class="content_input_update"><input id="input_CURP_update"  name="input_CURP_update"   type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                         <div class="titulos_update"><label for="input_telefono_update">Teléfono</label></div>
                         <div class="content_input_update"><input id="input_telefono_update"        name="input_telefono_update"         type="text"     class="input_user_update" value="Sin registrar" disabled></div>

                         <div class="titulos_update"><label for="input_correo_update">Correo</label></div>
                         <div class="content_input_update"><input id="input_correo_update"       name="input_correo_update"        type="text"     class="input_user_update" value="Sin registrar" disabled></div>
</div>
                     </div>
                 </div>
        `; 
     
        $(".actualizar_body_actual").append(html);
        setTimeout(() => {title_update_document  ({'Id_Info':id},{'User':title});
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
         
         url : `${link.Server}consult_update_user.php`,
         data : data,
         type : 'POST',
         beforeSend: function () {
             
         },
         success: response => {
      
             var json = JSON.parse(response)
             
             const Phone_Number             =    json[0].Phone_Number      == null ? "Sin registrar":json[0].Phone_Number;
             const User                     =    json[0].User              == null ? "Sin registrar":json[0].User;
             const RFC                      =    json[0].RFC               == null ? "Sin registrar":json[0].RFC;
             const Email                    =    json[0].Email             == null ? "Sin registrar":json[0].Email;
             const CURP                     =    json[0].CURP              == null ? "Sin registrar":json[0].CURP;


             $("#input_nombre_update")       .val(User);
             $("#input_telefono_update")     .val(Phone_Number);
             $("#input_RFC_update")          .val(RFC);
             $("#input_correo_update")       .val(Email);
             $("#input_CURP_update")         .val(CURP);
             title_update           (data2)
         },   
         error : function(jqXHR, status, error) {
             alert('Disculpe, existió un problema');
         }, 
     });
 }
 const title_update = data => {// toma los valores que se encontraron en la base de datos y los muestra en el carousel
     $.ajax({
         
         url : `${link.Server}consult_update_user.php`,
         data : data,
         type : 'POST',
         beforeSend: function () {
             
         },
         success: data => {
             if(data!=0){
                var json = JSON.parse(data)
             
                const Phone_Number             =    json[0].Phone_Number      == null ? "Sin registrar":json[0].Phone_Number;
                const Full_Name                =    json[0].Full_Name         == null ? "Sin registrar":json[0].Full_Name;
                const RFC                      =    json[0].RFC               == null ? "Sin registrar":json[0].RFC;
                const Email                    =    json[0].Email             == null ? "Sin registrar":json[0].Email;
                const CURP                     =    json[0].CURP              == null ? "Sin registrar":json[0].CURP;
   
   
                $("#input_nombre")       .val(Full_Name);
                $("#input_telefono")     .val(Phone_Number);
                $("#input_RFC")          .val(RFC);
                $("#input_correo")       .val(Email);
                $("#input_CURP")         .val(CURP);
   
             }else{
               
           
             }
             lottiesSuccessActives ( )

             
         },   
         error : function(jqXHR, status, error) {
             alert('Disculpe, existió un problema');
         }, 
     });
 }
 function lottiesSuccessActives ( )  {
              //Muestra si el usuario ya está actualizado con loties
     const input_nombre_update               = $("#input_nombre_update")          .val();
     const input_telefono_update             = $("#input_telefono_update")        .val();
     const  input_RFC_update                 = $("#input_RFC_update")             .val();
     const  input_Correo_update              = $("#input_correo_update")          .val();
     const  input_CURP_update                = $("#input_CURP_update")            .val();

     const input_nombre                      = $("#input_nombre")                 .val();
     const input_telefono                    = $("#input_telefono")               .val();
     const  input_RFC                        = $("#input_RFC")                    .val();
     const  input_Correo                     = $("#input_correo")                 .val();
     const  input_CURP                       = $("#input_CURP")                   .val();

    
     $(".lottie-player-success").remove();
     const lottie = `<lottie-player class="lottie-player-success" src="animations/success.json"  background="transparent"  speed="1"   autoplay></lottie-player>`;
     const lottieUpdate = `<lottie-player  src="animations/update_user.json"  background="transparent"  speed="0.25"   autoplay></lottie-player>`;
     var update = true;
     
     if(input_nombre    ==  input_nombre_update)                    {       $("#input_nombre")      .after(lottie);     }else{update = false;}
     if(input_telefono  ==  input_telefono_update)                  {       $("#input_telefono")    .after(lottie);     }else{update = false;}
     if(input_CURP      ==  input_CURP_update)                      {       $("#input_CURP")        .after(lottie);     }else{update = false;}
     if(input_RFC       ==  input_RFC_update)                       {       $("#input_RFC")         .after(lottie);     }else{update = false;}
     if(input_Correo    ==  input_Correo_update)                    {       $("#input_correo")      .after(lottie);     }else{update = false;}                      
                                             
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
            $("#input_nombre")   .val($("#input_nombre_update")   .val());
             setUser(user_name)
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

                         updateInfoDocument(Id_Info,Value,"User","#input_nombre_update");
                         $("#input_nombre").val(Value)
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
                             <h6> ${limitLetters(20, $(`#${format_id(id,5)}`).val())} </h6>
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
         const user = $("#input_nombre_update").val();
       existe (user,"user")
 
       

     });
});
