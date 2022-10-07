<?php
require ('../Server/conexion.php');
include("../Class/Document.php");

$Document = new Document();
?>
<script type="module"> 
import * as link from "./Modules/links.js";
 $(document).ready(function () {
   
    $(".img_excel").click(function() {
        const id = $(this).attr("id");
        $(".dashboard-content").load(link.components+"Document.php",{'id':id});
        
    })
    $(".cont_excel_footer").click(function() {
        const id = $(this).attr("id");
        $(".dashboard-content").load(link.components+"Document.php",{'id':id});
        
    })
    $(".cont_excel_body").click(function() {
        const id = $(this).attr("id");
        $(".dashboard-content").load(link.components+"Document.php",{'id':id});
        
    })
    
    $(".drop").on('click', function() {
        const id = $(this).attr("id");
        alertDrop(id);
    });
    function alertDrop(id){
 
        const $msg=`
        <table class="table">
        <tbody>
        <tr>
        <th scope="row">Nombre</th>
        <td>${$(".Name_"+id).attr("id")}</td>
        </tr>
        <tr>
        <th scope="row">Fecha</th>
        <td>${$(".Date_"+id).attr("id")}</td>
        </tr>


        </tbody>
        </table>
        `;

        Swal.fire({
                        title: `Eliminando Documento`,
                        html: $msg,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                        
                            DropUser({'Document_Id':id})
                        }
                });
    }
    function DropUser(data){
        $.ajax({
        
            url : `Server/dropDocument.php`,
            data : data,
            type : 'POST',
            success: function (response) {
              
                $("#container_"+data.Document_Id).remove();
            }
        });
    }
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
                    <div class="file-container" id="container_<?php echo $Document_Id?>">
                        <div id="<?php echo $Document_Id?>" class="img_excel"> <img src="img/excel_alert.png" alt="<?php echo $Document_Name?>" width="60px" height="60px"> </div>
                        <div class="cont_excel">
                            
                            <div class="cont_excel_header"><span id="<?php echo $Document_Id?>"  class="drop"><i class="fa-solid fa-xmark"></i></span></div>
                            <div id="<?php echo $Document_Id?>" class="cont_excel_body"><span class="Name_<?php echo $Document_Id?>" id="<?php echo $Document_Name?>"><?php echo $Document_Name?></span></div>
                            <div id="<?php echo $Document_Id?>" class="cont_excel_footer"><span class="Date_<?php echo $Document_Id?>" id="<?php echo  $Document_Year?>"> Año: <?php echo  $Document_Year?></span></div>
                            <div></div>
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
                  <div class="file-container" id="container_<?php echo $Document_Id?>">
                        <div id="<?php echo $Document_Id?>" class="img_excel"> <img src="img/excel_alert.png" alt="<?php echo $Document_Name?>" width="60px" height="60px"> </div>
                        <div class="cont_excel">
                            
                            <div class="cont_excel_header"><span id="<?php echo $Document_Id?>"  class="drop"><i class="fa-solid fa-xmark"></i></span></div>
                            <div id="<?php echo $Document_Id?>" class="cont_excel_body"><span class="Name_<?php echo $Document_Id?>" id="<?php echo $Document_Name?>"><?php echo $Document_Name?></span></div>
                            <div id="<?php echo $Document_Id?>" class="cont_excel_footer"><span class="Date_<?php echo $Document_Id?>" id="<?php echo  $Document_Year?>"> Año: <?php echo  $Document_Year?></span></div>
                            <div></div>
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
                    <div class="file-container" id="container_<?php echo $Document_Id?>">
                        <div id="<?php echo $Document_Id?>" class="img_excel"> <img src="img/excel_alert.png" alt="<?php echo $Document_Name?>" width="60px" height="60px"> </div>
                        <div class="cont_excel">
                            
                            <div class="cont_excel_header"><span id="<?php echo $Document_Id?>"  class="drop"><i class="fa-solid fa-xmark"></i></span></div>
                            <div id="<?php echo $Document_Id?>" class="cont_excel_body"><span class="Name_<?php echo $Document_Id?>" id="<?php echo $Document_Name?>"><?php echo $Document_Name?></span></div>
                            <div id="<?php echo $Document_Id?>" class="cont_excel_footer"><span class="Date_<?php echo $Document_Id?>" id="<?php echo  $Document_Year?>"> Año: <?php echo  $Document_Year?></span></div>
                            <div></div>
                        </div>	
                    </div>  
                <?php }?>
            </div>
        </div>
    </div>
    
</div>