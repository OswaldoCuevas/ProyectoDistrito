<?php
require ('../Server/conexion.php');
include("../Class/Document.php");

$Document = new Document();
?>
<script type="module"> 
import * as link from "./Modules/links.js";
 $(document).ready(function () {
   
    $(".file-container").click(function() {
        const id = $(this).attr("id");
        $(".dashboard-content").load(link.components+"Document.php",{'id':id});
        
    })
 });

   
</script>
<link rel="stylesheet" href="css/actualizaciones.css">
<div class="archivos_actualizacion">
    <div class="titulo_archivos_actualizacion">
    <h3>Actualizaciones</h3>
    </div>
    <div class="contenido_actualizacion">
        <div class="archivos_titulos">
            <h3>Títulos</h3>
            <div class="contenido_scroll_excel">
                <?php foreach($Document -> getDocumentTitles() as $filas){
                    $Document_Id=$filas['Document_Id'];
                    $Document_Name=$filas['Document_Name'];
                    $Document_Year=$filas['Document_Year'];
                ?>
                    <div id="<?php echo $Document_Id?>" class="file-container">
                        <div class="img_excel"> <img src="img/excel_alert.png" alt="<?php echo $Document_Name?>" width="60px" height="60px"> </div>
                        <div class="cont_excel">
                            
                            <div class="cont_excel_header"><span><i class="fa-solid fa-xmark"></i></span></div>
                            <div class="cont_excel_body"><span><?php echo $Document_Name?></span></div>
                            <div class="cont_excel_footer"><span> Año: <?php echo  $Document_Year?></span></div>
                        </div>	
                    </div>  
                <?php }?>
            </div>
        </div>
        
        <div class="archivos_usuarios">
            <h3>Usuarios</h3>
            <div class="contenido_scroll_excel">
            <?php foreach($Document -> getDocumentUsers() as $filas){
                    $Document_Id=$filas['Document_Id'];
                    $Document_Name=$filas['Document_Name'];
                    $Document_Year=$filas['Document_Year'];
                ?>
                    <div id="<?php echo $Document_Id?>" class="file-container">
                        <div class="img_excel"> <img src="img/excel_alert.png" alt="<?php echo $Document_Name?>" width="60px" height="60px"> </div>
                        <div class="cont_excel">
                            
                            <div class="cont_excel_header"><span><i class="fa-solid fa-xmark"></i></span></div>
                            <div class="cont_excel_body"><span><?php echo $Document_Name?></span></div>
                            <div class="cont_excel_footer"><span> Año: <?php echo  $Document_Year?></span></div>
                        </div>	
                    </div>  
                <?php }?>
            </div>
        </div>
        <div class="archivos_inversiones">
            <h3>Inversiones</h3>
            <div class="contenido_scroll_excel">
            <?php foreach($Document -> getDocumentInvestments() as $filas){
                    $Document_Id=$filas['Document_Id'];
                    $Document_Name=$filas['Document_Name'];
                    $Document_Year=$filas['Document_Year'];
                ?>
                    <div id="<?php echo $Document_Id?>" class="file-container">
                        <div class="img_excel"> <img src="img/excel_alert.png" alt="<?php echo $Document_Name?>" width="60px" height="60px"> </div>
                        <div class="cont_excel">
                            
                            <div class="cont_excel_header"><span><i class="fa-solid fa-xmark"></i></span></div>
                            <div class="cont_excel_body"><span><?php echo $Document_Name?></span></div>
                            <div class="cont_excel_footer"><span> Año: <?php echo  $Document_Year?></span></div>
                        </div>	
                    </div>  
                <?php }?>
            </div>
        </div>
    </div>
    
</div>