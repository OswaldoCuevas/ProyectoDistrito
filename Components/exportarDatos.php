<?php require ('../Server/validityAdmin.php'); ?>
<link rel="stylesheet" href="css/exportarDatos.css">
<div class="cargar_archivo"></div>
<div class="container-principal">
    <div class="principal_header">
       <div class="text">
       <span><i class="fa-solid fa-arrow-up-from-bracket"> </i></span>
       <h4>Exportar archivo de Excel</h4>

       </div>
    </div>
    <div class="principal_body">
     <div class="buttons">
        <a target="_blank" href="Server/GenerarExcel.php?Document=Padron de usuarios" class="getDocument" id=""> <b>Padrón de usuarios</b> </a>
        <a target="_blank" href="Server/GenerarExcel.php?Document=Usuarios privados" class="getDocument" id=""> <b>Usuarios Privados</b></a>
        <a target="_blank" href="Server/GenerarExcel.php?Document=Usuarios sociales" class="getDocument" id=""> <b>Usuarios Sociales</b></a>
        <a target="_blank" href="Server/GenerarExcel.php?Document=Titulos" class="getDocument" id=""> <b>Titulos de concesión</b></a>
        <a target="_blank" href="Server/GenerarExcel.php?Document=Inversiones" class="getDocument" id=""> <b>Inversiones</b></a>
        <a target="_blank" href="Server/GenerarExcel.php?Document=Usuarios" class="getDocument" id=""> <b>Usuarios</b></a>
     </div>
        
    </div>
</div>