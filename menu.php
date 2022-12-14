<?php
$section = isset($_GET['section'])?$_GET['section']:"menuSection";
session_start();
if (!isset($_SESSION['Control_Num'])) {
    header('location: index.html');
}else{
    $Name = $_SESSION['Full_Name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport">
    <link rel="shortcut icon" href="img/logo.png" />
    <title>Distrito066</title>
    
   
</head>
<script src=".\node_modules\jquery\dist\jquery.min.js"></script>
<script defer src=".\node_modules\@fortawesome\fontawesome-free\js\all.js"></script>
<link rel="stylesheet" href="css/menu.css">
<script src=".\node_modules\@lottiefiles\lottie-player\dist\lottie-player.js"></script>
<link rel="stylesheet" href=".\node_modules\bootstrap\dist\css\bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>	
<style>
    .dashboard-content{
        background-color: #F6FAF9;
    }
</style>
<body>
<div class='dashboard dashboard-compact'>
    <div class="dashboard-nav">

        <header>
            <a class="menu-toggle" id="desplegar" style="color:white; cursor:pointer"> <i class="fas fa-bars"></i></a>
            <a href="#"class="brand-logo"> <span><i class="fa-solid fa-droplet"> </i> Distrito 066</span></a>
            
        </header>
        
            <nav class="dashboard-nav-list">
            <a href="menu.php" class="dashboard-nav-item " id="home"><span><i class="fas fa-home"></i> Inicio</span></a>
            <a href="menu.php?section=titulos" class="dashboard-nav-item " id="titulos"><span><i class="fa-solid fa-scroll"> </i> Títulos </a>
            <a href="menu.php?section=inversiones" class="dashboard-nav-item " id="inversiones"><span><i class="fa-solid fa-handshake-simple"> </i> Inversiones </span> </a>
            <a href="menu.php?section=actualizaciones" class="dashboard-nav-item " id="actualizaciones"><span><i class="fa-solid fa-arrow-down"> </i> Actualizaciones </span> </a>
            <a href="menu.php?section=cargarArchivo" class="dashboard-nav-item " id="cargarArchivo"><span><i class="fa-solid fa-arrow-up-from-bracket"> </i> Cargar archivo</span> </a>
            <a href="menu.php?section=exportarDatos" class="dashboard-nav-item " id="exportarDatos"><span><i class="fa-solid fa-arrow-up-from-bracket"> </i> Exportar Datos</span> </a>
        
            <div class='dashboard-nav-dropdown' >
                <a href="#" id="usuarios" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><span><i class="fas fa-users"> </i>  Usuarios </span></a>
                <div class='dashboard-nav-dropdown-menu' >
                    <a href="menu.php?section=Administradores" class="dashboard-nav-dropdown-item" id="option7">Administradores</a>
                    <a href="menu.php?section=padronUsuarios" class="dashboard-nav-dropdown-item" id="padronUsuarios">Padrón de usuarios</a>
                </div>
            </div>
        
            <div class="nav-item-divider">

            </div>
          <a href="Server/Cerrar_Sesion.php" class="dashboard-nav-item" id="option21"><span><i class="fas fa-sign-out-alt"> </i> Cerrar sesión</span> </a>
        </nav>
    </div>
    <div class='dashboard-app'>
        <header class='dashboard-toolbar'>
            <a href="#" class="menu-toggle " id="toglee"> <i class="fas fa-bars"></i></a>
            
            <div class="section">
               
            </div>
        </header>
        <div class="status_sesion">
            <a href="#" class="info-sesion"> <span><?php echo $Name ?></span> </a>
            <a href="#" class ="info-sesion2"> <span> <i class=" fa-solid fa-circle-user fa-2x"></i></span></a>
        </div>
            
      
    </div>
   
</div>
<div class='dashboard-content'></div>
<div class="cont"></div> 
</body>
<script  type="module" src="js/menu.js"></script>
<script type="text/javascript">
    $('#<?php echo $section;?>').removeClass("").addClass("active");
    <?php 
     if( isset($_GET['user'])){
        ?>
        $(".dashboard-content").load("components/<?php echo $section;?>.php",{'user':'<?php echo $_GET['user'];?>'});
        <?php
     }else{
        ?>
        $(".dashboard-content").load("components/<?php echo $section;?>.php");
        <?php
     }
    ?>
    function caraterSpecial(expersion){
        let expresionNew = expersion.replace(/[^a-zA-Z0-9$+=?@_., ]/i, "")
        return expresionNew == expersion ? expresionNew:caraterSpecial(expresionNew);	
	}
    $(document).on('keydown','input',function(){
        setTimeout(() => {
            $(this).val(caraterSpecial($(this).val()))
        },30);
    });
</script>

</html>
