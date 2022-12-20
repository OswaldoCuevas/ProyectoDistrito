<?php
$section = isset($_GET['section'])?$_GET['section']:"titulos";
session_start();
if (!isset($_SESSION['Control_Num'])) {
    header('location: index.php');
}else{
    $Name = $_SESSION['Full_Name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" >
    <link rel="shortcut icon" href="../img/logo.png" />
    <title>Distrito066</title>
    
   
</head>
<script src="..\node_modules\jquery\dist\jquery.min.js"></script>
<script defer src="..\node_modules\@fortawesome\fontawesome-free\js\all.js"></script>

<script src="..\node_modules\@lottiefiles\lottie-player\dist\lottie-player.js"></script>
<link rel="stylesheet" href="..\node_modules\bootstrap\dist\css\bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>	
<link rel="stylesheet" href="../css/menu.css">
<style>
    .dashboard-content{
        background-color: #F6FAF9;
    }
</style>
<body>
<div class='dashboard dashboard-compact'>

    <div class='dashboard-app'>
        <header class='dashboard-toolbar'>
            <div class="section">
               
            </div>
        </header>
        <div class="status_sesion">
            <a href="#" class ="info-sesion"> <span><?php echo $Name ?></span> </a>
            <a href="#" class ="info-sesion2"> <span> <i class=" fa-solid fa-circle-user fa-2x"></i></span></a>
        </div>
            
      
    </div>
   
</div>
<div class="conten-salir">
    <a href="../Server/Cerrar_Sesion_Usuario.php" class="cerrar-sesion-content " style="text-decoration: none;"> 
        <span class="text">Cerrar Sesion</span> <span class="icon"> <i class="fas fa-sign-out-alt"></i></span>
    </a>
</div>


<div class='dashboard-content'></div>

</body>
<script  type="module" src="../js/menu.js"></script>
<script type="text/javascript">
    $(".dashboard-content").load("<?php echo $section;?>.php");
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
