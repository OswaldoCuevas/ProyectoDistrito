<?php require ('../Server/validityAdmin.php'); ?>
<link rel="stylesheet" href="css/menuSection.css">
<script type="module">
 $(".option").click(function(){
    window.location.href = `menu.php?section=${$(this).attr("id")}`;
 });
</script>
<div class="container-divs">
    <div class="section-divs">
        <div class="option" id="padronUsuarios">
            <div class="container-option span-primary-1" >
                <div class="icon"><span class="primary-1"><i class="fas fa-users"></i></span></div>
                <div class="info"><span> Padron de Usuarios</span></div>
            </div>
        </div>
        <div class="option" id="Titulos">
            <div class="container-option span-secondary-1" >
                <div class="icon"><span class="secondary-1"><i class="fa-solid fa-scroll"> </i></span></div>
                <div class="info"><span> Títulos de concesión</span></div>
            </div>
        </div>
        <div class="option" id="actualizaciones">
            <div class="container-option span-third-1" >
                <div class="icon"><span class="third-1"><i class="fa-solid fa-arrow-down"> </i></span></div>
                <div class="info"><span> Actualizaciones</span></div>
            </div>
        </div>
    </div>
    <div class="section-divs">
        <div class="option" id="Administradores">
            <div class="container-option span-primary-2">
                <div class="icon"><span class="primary-2"><i class="fa-solid fa-users-gear"></span></i></div>
                <div class="info"><span> Administradores</span></div>
            </div>
        </div>
        <div class="option" id="inversiones">
            <div class="container-option span-secondary-2" >
                <div class="icon"><span class="secondary-2"><i class="fa-solid fa-handshake-simple"> </i></span></div>
                <div class="info"><span> Inversiones</span></div>
            </div>
        </div>
        <div class="option" id="cargarArchivo">
            <div class="container-option span-third-2" >
                <div class="icon"><span class="third-2"><i class="fa-solid fa-arrow-up-from-bracket"> </i></span></div>
                <div class="info"><span> Cargar archivo</span></div>
            </div>
        </div>
        
    </div>
</div>