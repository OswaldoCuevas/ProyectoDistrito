<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="#ffffff">
    <meta name=”theme-color” content=” />
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<script src="https://kit.fontawesome.com/6791667e6d.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/padronUsuarios.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<div class='dashboard'>
    <div class="dashboard-nav">

        <header>
            <a class="menu-toggle" id="desplegar" style="color:white; cursor:pointer"><i class="fas fa-bars"></i></a>
            <a href="#"class="brand-logo"><i class="fa-solid fa-droplet"></i> <span>Distrito 066</span></a>
        </header>
        
            <nav class="dashboard-nav-list">
            <a href="#" class="dashboard-nav-item " id="home"><i class="fas fa-home"></i>Inicio</a>
            <a href="#" class="dashboard-nav-item " id="titulos"><i class="fa-solid fa-scroll"></i> Títulos</a>
            <a href="#" class="dashboard-nav-item " id="pozos"><i class="fa-solid fa-layer-group"></i>Lotes </a>
            <a href="#" class="dashboard-nav-item " id="invesiones"><i class="fa-solid fa-handshake-simple"></i>Inversiones </a>
            <a href="#" class="dashboard-nav-item " id="actualizaciones"><i class="fa-solid fa-arrow-down"></i> Actaulizaciones  </a>
            <a href="#" class="dashboard-nav-item " id="cargarArchivo"><i class="fa-solid fa-arrow-up-from-bracket"></i> Cargar archivo </a>
            <div class='dashboard-nav-dropdown' >
                <a href="#!" id="transferencias" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-photo-video"></i> Transferencias </a>
                <div class='dashboard-nav-dropdown-menu' >
                    <a href="#" class="dashboard-nav-dropdown-item" id="option5">Titulos</a>
                    <a href="#" class="dashboard-nav-dropdown-item" id="option6">Temporales</a>
                </div>
            </div>
            <div class='dashboard-nav-dropdown' >
                <a href="#!" id="usuarios" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-users"></i>  Usuarios </a>
                <div class='dashboard-nav-dropdown-menu' >
                    <a href="#" class="dashboard-nav-dropdown-item" id="option7">Administradores</a>
                    <a href="#" class="dashboard-nav-dropdown-item" id="padronUsuarios">Padrón de usuarios</a>
                </div>
            </div>
        
            <div class="nav-item-divider">

            </div>
          <a href="#" class="dashboard-nav-item" id="option21"><i class="fas fa-sign-out-alt"></i> Cerrar sesión </a>
        </nav>
    </div>
    <div class='dashboard-app'>
        <header class='dashboard-toolbar'>
            <a href="#" class="menu-toggle"><i class="fas fa-bars"></i></a>
            
        </header>
        <div class="status_sesion">
            <a href="#" class="info-sesion"> <span>Oswaldo Cuevas</span> </a>
            <a href="#" class ="info-sesion2"><i class=" fa-solid fa-circle-user fa-2x"></i></a>
        </div>
            
        <div class='dashboard-content'>
           
        </div>
    </div>
</div> 
</body>
<script >
    const mobileScreen = window.matchMedia("(max-width: 990px )");
$(document).ready(function () {
   
    $(".dashboard-nav-dropdown-toggle").click(function () {
        $(this).closest(".dashboard-nav-dropdown")
            .toggleClass("show")
            .find(".dashboard-nav-dropdown")
            .removeClass("show");
        $(this).parent()
            .siblings()
            .removeClass("show");
    });
    $(".menu-toggle").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
            $(".status_sesion").toggleClass("mobile-status-sesion-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
   var idAux1=null;
    $(".dashboard-nav-item").click(function() {
        id=$(this).attr("id");
 
        if(idAux1==null){
$(".dashboard-content").load("componentes/"+id+".php");
 $('#'+id+'').removeClass("").addClass("active");
 if(idAux2!=null){
    $('#'+idAux2+'').removeClass("active").addClass("");

}  
        }else{
 $('#'+idAux1+'').removeClass("active").addClass(""); 
$('#'+id+'').removeClass("").addClass("active");
$(".dashboard-content").load("componentes/"+id+".php");
if(idAux2!=null){
    $('#'+idAux2+'').removeClass("active").addClass("");

}         
        }
        if (mobileScreen.matches) {
            if(id.toString()!="transferencias" && id.toString()!="usuarios"){

            
            $(".dashboard-nav").toggleClass("mobile-show");
            $(".status_sesion").toggleClass("mobile-status-sesion-show");
            }
        } else {
            
        }
        idAux1=id;
 });
 var idAux2=null;
    $(".dashboard-nav-dropdown-item").click(function() {
        id=$(this).attr("id");
 
        if(idAux2==null){
            $(".dashboard-content").load("componentes/"+id+".php");
 $('#'+id+'').removeClass("").addClass("active");
 if(idAux1!=null){
    $('#'+idAux1+'').removeClass("active").addClass("");

}
        }else{
            $(".dashboard-content").load("componentes/"+id+".php");
$('#'+idAux2+'').removeClass("active").addClass("");  
$('#'+id+'').removeClass("").addClass("active");
if(idAux1!=null){
    $('#'+idAux1+'').removeClass("active").addClass("");

}
         
        }
        idAux2=id;
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
            $(".status_sesion").toggleClass("mobile-status-sesion-show");

           
        } else {
            
        }
 });
});
</script>
<script>
    //padron de usuarios
    $(".dashboard-nav-dropdown-item").click(function() {
        id=$(this).attr("id");}
        
        );
</script>
</html>