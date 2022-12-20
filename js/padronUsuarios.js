import * as passwordGenerate from "../Modules/passwordGenerate.js"
import * as _Arraylist from "../Modules/Class/ArrayList.js"
function preloadFunc(){
  if($("#user-get").val()!='Sin usuario'){
    $(".dashboard-content").load("components/Usuario.php",{"user_id":$("#user-get").val(),"previous":"padronUsuarios"});
  }
}

window.onpaint = preloadFunc();
$(document).ready(function () {
    buscar()
    register()
    var ArrayListUser = new _Arraylist.User();

    function setUser(Control_Num,Full_Name ,Email,Password_User,RFC,CURP,Type_User,Phone_Number){
        console.clear();
        ArrayListUser.setUser(Control_Num,Full_Name,Email,Password_User,RFC,CURP,Type_User,Phone_Number)  
        console.log(ArrayListUser.UsersLength() )
        ArrayListUser.ShowUsers();
    }
    function jsonInfo(Operation){
        const Control_Num   = $("#Control_Num")     .val() == "" ? null : $("#Control_Num").val();
        const Full_Name     = $("#Full_Name")       .val() == "" ? null : $("#Full_Name").val();
        const Email         = $("#Email")           .val() == "" ? null : $("#Email").val();
        const Phone_Number  = $("#Phone_Number")    .val() == "" ? null : $("#Phone_Number").val();
        const Password_User = $("#Password_User")   .val() == "" ? null : $("#Password_User").val()
        const Type_User     = $("#Type_User")       .val() == "" ? null : $("#Type_User").val()
        const CURP          = $("#CURP")            .val() == "" ? null : $("#CURP").val()
        const RFC           = $("#RFC")             .val() == "" ? null : $("#RFC").val()
        return {
                "Operation"         :       Operation       ,
                "Control_Num"       :       Control_Num     ,
                "Full_Name"         :       Full_Name       ,
                "Email"             :       Email           ,
                "Phone_Number"      :       Phone_Number    ,
                "Password_User"     :       Password_User   ,
                "Type_User"         :       Type_User       ,
                "CURP"              :       CURP            ,
                "RFC"               :       RFC 

                };
    }
    function getUser(id){
    return  ArrayListUser.getUserSpecific(id)
    }
    function setInputUser(Control_Num,Full_Name ,Email,Password_User,RFC,CURP,Type_User,Phone_Number){
        $("#Control_Num").val(Control_Num);
        $("#Full_Name").val(Full_Name);
        $("#Email").val(Email);

        $("#CURP").val(CURP);

        if(Type_User == "Social"){
            $("#Type_User option[value='Privado']").attr("selected", false);
            $("#Type_User option[value='Social']").attr("selected", true);
        
        }else{
            $("#Type_User option[value='Social']").attr("selected", false);
            $("#Type_User option[value='Privado']").attr("selected", true);
        }
        $("#Phone_Number").val(Phone_Number);
        $("#RFC").val(RFC);
    }
    function cleanInputs(){
        $("#Control_Num").val("");
        $("#Full_Name").val("");
        $("#Email").val("");
        $("#Password_User").val("");
        $("#CURP").val("");
        $("#Phone_Number").val("");
        $("#RFC").val("");
    }
    function buscar(data){
        $.ajax({
        
            url : `Server/jsonUsers.php`,
            data : {"Full_Name":$(".input_search").val()},
            type : 'POST',
            async: true,
            beforeSend: function () {
                $('.cargando').show();
                $(".load_users").hide();
            },
            success: function (response) {
                $('.cargando').hide();
                $(".load_users").show();
                ArrayListUser.vacio();
                const json=JSON.parse(response)
                var html = ``;
                for(register of json){
                setUser( register.Control_Num, register.Full_Name, register.Email, register.Password_User, register.RFC, register.CURP, register.Type_User, register.Phone_Number)
                const Full_Name       = register.Full_Name        == null ?   "Sin registrar" : register.Full_Name;
                const Phone_Number    = register.Phone_Number     == null ?   "Sin registrar" : register.Phone_Number;
                const Email           = register.Email            == null ?   "Sin registrar" : register.Email;
                const Password_User   = register.Password_User    == null ?   "Sin registrar" : register.Password_User;
                const CURP            = register.CURP             == null ?   "Sin registrar" : register.CURP;
                const RFC             = register.RFC              == null ?   "Sin registrar" : register.RFC;
                const Type_User       = register.Type_User        == null ?   "Sin registrar" : register.Type_User;
                const Control_Num     = register.Control_Num      == null ?   "Sin registrar" : register.Control_Num;
                
                    const activo = Password_User == "Sin registrar"?"<div class='No_activo'></div>":"<div class='Activo'></div>"; 
                
                html+=`
                <tr class="users-tr" id='element_${Control_Num}'>
                            <td class="td_activo"><div class="center">${activo}</div></td>
                            <td>${Control_Num}</td>
                            <td>${Full_Name}</td>
                            <td>${Type_User}</td>
                            <td>${CURP}</td>
                            <td>${RFC}</td>
                            <td><button id="${Control_Num}" class="btn btn-sm btn-primary button_show"><i class="fa-solid fa-eye"></i></button></td>
                            <td><button id="${Control_Num}" class="btn btn-sm btn-warning button_show_update " style="color: #fff"><i class="fa-solid fa-pencil"></i></button></td>
                            <td><button id="${Control_Num}" class="btn btn-sm btn-danger button_delete"><i class="fa-solid fa-trash"></i></button></td>
                    
                        </tr>
                `;
                }
                $(".load_users").html(html);
                $(".button_show").click(function() {
                    $(".dashboard-content").load("components/Usuario.php",{"user_id":$(this).attr("id"),"previous":"padronUsuarios"});
                });
                $(".button_show_update").click(function(){
                const $user = getUser($(this).attr("id").toString())
                const Full_Name          = $user.getFull_Name()         == null ?   "" : $user.getFull_Name() ;
                const Phone_Number    = $user.getPhone_Number()      == null ?   "" : $user.getPhone_Number() ;
                const Email           = $user.getEmail()             == null ?   "" : $user.getEmail() ;
                const Password_User   = $user.getPassword_User()     == null ?   "" : $user.getPassword_User() ;
                const CURP            = $user.getCURP()              == null ?   "" : $user.getCURP() ;
                const RFC             = $user.getRFC()               == null ?   "" : $user.getRFC() ;
                const Type_User       = $user.getType_User()         == null ?   "" : $user.getType_User() ;
                const Control_Num     = $user.getControl_Num()       == null ?   "" : $user.getControl_Num() ;
                setInputUser(Control_Num,Full_Name ,Email,Password_User,RFC,CURP,Type_User,Phone_Number);
                update()
                });
                $(".button_delete").click(function(){
            
                
                    alertDrop(getUser($(this).attr("id").toString()));

                });
            }
        });
    
    } 
    function limit(val,id){

        var expresion = val.toString().split("");
        var num=0;
        switch(id){
            case "Full_Name"        :num=400;break
            case "Phone_Number"     :num=200;break
            case "Email"            :num=200;break
            case "Password_User"    :num=50;break;
            case "RFC"              :num=200;break;
            case "CURP"             :num=200;break;
        }
        expresion.length = maxLetters(expresion,num) ? expresion.length:num; $(this).val(expresion.join(""));
        $(`#Num_${id}`).html(`${expresion.length} / ${num}`);
    }
    function update(){
        $(".user_footer").html(`<button id="button_update" > Actualizar </button><button id="button_plus"> <i class="fa-solid fa-plus"></i> </button>`);  
        $(".text_operation").html(`<b>Editando usuario</b>`);
        $("#button_plus").on('click', function(e){
            cleanInputs();
            $(".user_footer").html(`<button id="button_register" > Registrar </button>`);
            $(".text_operation").html(`<b>Registrando usuario</b>`);
            $("#button_register").click(function(){
                alertRegister()
                });
        });
        $("#button_update").on('click', function() {
            alertUpdate()
        });
    }
    function register(){
        $(".user_footer").html(`<button id="button_register" > Registrar </button>`);
        $(".text_operation").html(`<b>Registrando usuario</b>`);  
        $("#button_register").click(function(){
                alertRegister()
            
                });
    }
    function maxLetters(expresion,limit){
        return expresion.length <= limit;
    }
    function CRUDUser(data){
    
        $.ajax({
        
            url : `Server/CRUDUser.php`,
            data : data,
            type : 'POST',
            success: function (response) {
                if(response == "0"){
                    Swal.fire({
                        title: `Registrado con exito`,
                        icon: "success",
                    });
                    cleanInputs();
                    buscar({"Full_Name":$(".input_search").val()  == null ?"":$(".input_search").val()})
                }else if(response == "1"){
                    Swal.fire({
                        title: `Error al registrar usuario`,
                        icon: "error",
                        text: `${data.Full_Name} ya se encuentra registrado`,
                    });
                }else if(response == "2"){
                    Swal.fire({
                        title: `Actualizado Con exito`,
                        icon: "success",
                    });
                    cleanInputs();
                    buscar({"Full_Name":$(".input_search").val()  == null ?"":$(".input_search").val()})
                }else if(response == "3"){
                    Swal.fire({
                        title: `Usuario <b>${data.Full_Name}</b>Actualizado Con exito`,
                        icon: "success",
                    });
                    $("#element_"+data.Control_Num).remove();
                }
            
            }
        });
    }
    function alertRegister(){
        const user =jsonInfo();
        const $msg=`
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">Nombre</th>
                <td>${user.Full_Name  == null ?"Sin registrar":user.Full_Name }</td>
            </tr>
            <tr>
                <th scope="row">Sector</th>
                <td>${user.Type_User == null ?"Sin registrar":user.Type_User}</td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Teléfono</th>
                <td>${user.Phone_Number == null ?"Sin registrar":user.Phone_Number}</td>
            </tr>
                <th scope="row">RFC</th>
                <td>${user.RFC == null ?"Sin registrar":user.RFC } </td>
            </tr>
            <tr>
                <th scope="row">Curp</th>
                <td>${user.CURP == null ?"Sin registrar":user.CURP}</td>
            </tr>
            <tr>
                <th scope="row">Correo</th>
                <td>${user.Email == null ?"Sin registrar":user.Email}</td>
            </tr>
            <tr>
                <th scope="row">Contraseña</th>
                <td>${user.Password_User == null ?"Sin registrar":user.Password_User }</td>
            </tr>
            
            </tbody>
        </table>
        `;
        Swal.fire({
                        title: `Registrando nuevo usuario:`,
                        html: $msg,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                            CRUDUser(jsonInfo("Register"))
                        }
                    });
    }
    function alertUpdate(){
        const user =jsonInfo();
        const $msg=`
        <table class="table">
    <tbody>
        <tr>
        <th scope="row">Nombre</th>
        <td>${user.Full_Name  == null ?"Sin registrar":user.Full_Name }</td>
        </tr>
        <tr>
        <th scope="row">Sector</th>
        <td>${user.Type_User == null ?"Sin registrar":user.Type_User}</td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Teléfono</th>
        <td>${user.Phone_Number == null ?"Sin registrar":user.Phone_Number}</td>
        </tr>
        <th scope="row">RFC</th>
        <td>${user.RFC == null ?"Sin registrar":user.RFC } </td>
        </tr>
        <tr>
        <th scope="row">Curp</th>
        <td>${user.CURP == null ?"Sin registrar":user.CURP}</td>
        </tr>
        <tr>
        <th scope="row">Correo</th>
        <td>${user.Email == null ?"Sin registrar":user.Email}</td>
        </tr>
        <tr>
        <th scope="row">Contraseña</th>
        <td>${user.Password_User == null ?"Sin registrar":user.Password_User }</td>
        </tr>
    
    </tbody>
        </table>
        `;
        Swal.fire({
                        title: `Actualizando Usuario <b>${user.Full_Name}</b>`,
                        html: $msg,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                            CRUDUser(jsonInfo("Update"))
                        }
                    });
    }
    function alertDrop(user){

        const $msg=`
        <table class="table">
    <tbody>
        <tr>
        <th scope="row">Nombre</th>
        <td>${user.getFull_Name()  == null ?"Sin registrar":user.getFull_Name() }</td>
        </tr>
        <tr>
        <th scope="row">Sector</th>
        <td>${user.getType_User() == null ?"Sin registrar":user.getType_User()}</td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Phone_Number</th>
        <td>${user.getPhone_Number() == null ?"Sin registrar":user.getPhone_Number()}</td>
        </tr>
        <th scope="row">RFC</th>
        <td>${user.getRFC() == null ?"Sin registrar":user.getRFC() } </td>
        </tr>
        <tr>
        <th scope="row">Curp</th>
        <td>${user.getCURP() == null ?"Sin registrar":user.getCURP()}</td>
        </tr>
        <tr>
        <th scope="row">Correo</th>
        <td>${user.getEmail() == null ?"Sin registrar":user.getEmail()}</td>
        </tr>
    
    </tbody>
        </table>
        `;
        Swal.fire({
                        title: `Eliminando Usuario <b>${user.getFull_Name()}</b>`,
                        html: $msg,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                            CRUDUser({Operation:'Delete','Control_Num':user.getControl_Num(),"Full_Name":user.getFull_Name()});
                        }
                    });
    }
    $(document).on('keydown','.inputs_user',function(){
        setTimeout(() => {
            const         id=$(this).attr("id");
            const    val= $(this).val();
            var expresion = val.toString().split("");
            var num=0;
            switch(id){
                case "Full_Name"        :num=400;break
                case "Phone_Number"     :num=200;break
                case "Email"            :num=200;break
                case "Password_User"    :num=50;break;
                case "RFC"              :num=200;break;
                case "CURP"             :num=200;break;
            }
            expresion.length = maxLetters(expresion,num) ? expresion.length:num; $(this).val(expresion.join(""));
            $(`#Num_${id}`).html(`${expresion.length} / ${num}`);
        },20);
        

    });
    $(document).on('keyup','.input_search',function(){
    buscar({"Full_Name":$(this).val().toString()})
    }); 
    $("#generar_password").click(function(){
        $("#Password_User").val(passwordGenerate.generar_contraseña());
        limit($("#Password_User").val(),"Password_User")
    });
    $(".user_specific").click(function(){
        $(".dashboard-content").load("components/Usuario.php",{"user_id":$(this).attr("id")});
    });
});