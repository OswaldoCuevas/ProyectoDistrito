<?php 
require ('../Server/conexion.php');
include("../Class/Document.php");
$id=$_POST['id'];
$Document = new Document();
$Document_Specific = $Document -> getDocument($id);
$Type = $Document_Specific[0]['Document_Type'];
switch ($Type) {
    case "Títulos":?><script class="Script_Document_Type" src='js/DocumentTitle.js' type='module'></script><?php break;
    case "Padrón de usuarios":?><script class="Script_Document_Type" src='js/DocumentUsers.js' type='module'></script><?php break;
    case "Inversiones":?><script class="Script_Document_Type" src='js/DocumentInvestments.js' type='module'></script><?php break;
}
?>


<link rel="stylesheet" href="css/titulos.css">
<input type="hidden" id="id_documento" value="<?php echo $id ?>">
<div class="container-tables-titulos">
    <div class="filtros-titulos" >
    <input type="search" placeholder="Buscar ..." class="input_search" >
    </div>
		<div class="tables-user "  >
            <div class="scroll-tables-user">
            <table class="table" style=" margin-top: 10px; border-spacing: 100px" >
            </table>
            <div class="vacio"></div>
            <div class="cargando">
            <lottie-player src="animations/load.json"   style="z-index:10000000000"   speed="1"   loop  autoplay></lottie-player>
            </div>
            <button class="seleccionar_todo">Seleccionar no actualizados</button>
            <button class="remover_seleccion">Remover selección</button>
        </div>
    </div>
       
        
</div>
<div class="ver_titulo">
    <div class="ver_titulo_header">
        <h3>Actualizar</h3>
    </div>
    <div class="ver_titulo_body">
        <h5 class="sin_seleccionar">Sin seleccionar</h5>
        <div class="index">
            <div class="object"></div>
        </div>
    </div>
    <div class="ver_titulo_footer">
            <button class="btn btn-outline-primary" id="actualizar_show">Actualizar</button>
            
    </div>
    
</div>
<div class=" Actualizaciones" > 
    <div class="Hoja_Actualizar">
        <div class="actualizar_header">
            <span class="exit_updates"><i class="fa-solid fa-xmark"></i></span>
            <span class="num_total" id="num_total">5 de 840</span>
        </div>
        <div class="actualizar_body">
            <button class="actualizar_body_previous"><span><i class="fa-solid fa-angle-left"></i></span></button>
                <div class="actualizar_body_actual ">
                    
                </div>
                <button class="actualizar_body_next"><span><i class="fa-solid fa-angle-right"></i></span>
                </button>
            </div>
            <div class="actualizar_footer">
                <button id="button_update">Actualizar</button>
            </div>
        </div>
    </div> 
</div>
