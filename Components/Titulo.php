<?php require ('../Server/validityAdmin.php');
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
$Title_Id = $_POST['Title_Id'];
$Title_= new Title();
$Title = $Title_ -> getTitle($Title_Id);
if($Title[0]['Initial_Date'] != null){
    $dateFormat = FormatToFecha($Title[0]['Initial_Date']);
    $date1 = new DateTime($Title[0]['Initial_Date']);
    $date_actual = date("Y-m-d");
    $date2 = new DateTime($date_actual);
    $diff = $date1->diff($date2);
    $years_ = $Title[0]['Validity'] - $diff->y;

    $sectionValidity = $years_ > 1 ?"vigencia-well":"vigencia-bad";
    $timeLeft =  ($years_)." Años ";
    if($years_ > 1 && 12-$diff->m > 1 && 12-$diff->m < 12   ){    
        $m = (12-$diff->m) == 1 ?(12-$diff->m)."Mes ":(12-$diff->m)." Meses";
        $timeLeft =  ($years_-1) > 1 ?($years_-1)  ." Años ".$m:($years_-1) ." Año ".$m;
    }
    if($years_ <= 1 && $years_ > -1){    
        $timeLeft =  12-$diff->m == 1  ?(12-$diff->m). " Mes":(12-$diff->m)." Meses";
    }
}else{
    $timeLeft ="";
    $dateFormat = "";
    $sectionValidity = "vigencia-bad";
}

// will output 2 days

?>
<link rel="stylesheet" href="css/Titulo.css">
<script type="module" src="js/titulo.js"></script>
<div class="container-primary">
    <input type="hidden" id="previous" value="<?php echo $_POST['previous']?>">
    <input type="hidden" id="Title_Id" value="<?php echo $Title_Id?>">
    <input type="hidden" id="Title_Number" value="<?php echo $Title[0]['Title_Number']?>">
    <input type="hidden" id="Full_Name" value="<?php echo $Title[0]['Full_Name']?>">
    <input type="hidden" id="User_Id" value="<?php echo $Title[0]['User_Id']?>">
    <div class="container_header">
    <div class="titulo" id="<?php echo  $_POST['Title_Id']?>">
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-solid fa-scroll"> </i></span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Número de título</span>
                    <span class="name"><b><?php echo $Title[0]['Title_Number'] ?></b></span>
                </div>

            </div>
        </div>
        <div class="titular">
            <div class="container-section">
                <div class="logo-titular">
                    <span class="span-logo-titular"><i class="fa-solid fa-user"></i></span>
                </div>
                <div class="container-titular">
                    <span class="sector">Titular</span>
                    <span class="name" id="Username"><b><?php echo cutWord($Title[0]['Full_Name'],30) ?></b></span>
                </div>

            </div>
        </div>
       
        <div class="<?php echo $sectionValidity?>">
            <div class="container-section">
                <div class="logo-titulo">
                    <?php if($sectionValidity=="vigencia-bad"){?>
                        <span class="span-logo-titulo"><i class="fa-solid fa-circle-exclamation"></i></span>
                    <?php }else{?>
                        <span class="span-logo-titulo"><i class="fa-regular fa-circle-check"></i></span>
                    <?php }?>
                    
                </div>
                <div class="container-titulo">
                    <span class="sector">Vigencia</span>
                    <div class="text-vigencia">
                        <span style="text-align:left;">Inicio: <b><?php echo $dateFormat?></b></span>
                        <span style="text-align:left;">Vigencia: <b><?php echo $Title[0]['Validity'];?> años</b></span>
                        <span style="text-align:left;">años restantes: <b><?php echo  $timeLeft;?></b></span>
                        
                    </div>
                </div>

            </div>
        </div>
        <!-- <div class="vigencia-bad">
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-solid fa-circle-exclamation"></i></span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Vigencia</span>
                    <div class="text-vigencia">
                        <span>Inicio: <b>10 de agosto del 2000</b></span>
                        <span>Vigencia: <b>15 años</b></span>
                        <span>Días restantes: <b>2000 días</b></span>
                        
                    </div>
                </div>

            </div>
        </div> -->
        
    </div>   
    <div class="container_body">
        <div class="info-title">
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-solid fa-scroll"> </i></span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Información del título</span>
                    <div class="text">
                        <div>
                            
                            <span id = "Span-Cologne">Colonia: <b><?php echo $Title[0]['Cologne']?></b></span>
                            <input type="hidden" id="Input-Cologne" value="<?php echo $Title[0]['Cologne']?>">

                            <span id = "Span-Plot">Lote: <b><?php echo $Title[0]['Plot']?></b></span>
                            <input type="hidden" id="Input-Plot" value="<?php echo $Title[0]['Plot']?>">

                            <span>Dotación: <b><?php echo $Title[0]['Water_Supply']?></b></span>

                            <span id = "Span-Latitude">Latitud: <b><?php echo $Title[0]['Latitude']?></b></span>
                            <input type="hidden" id="Input-Latitude" value="<?php echo $Title[0]['Latitude']?>">

                            <span id = "Span-Longitude">Longitud: <b><?php echo $Title[0]['Longitude']?></b></span>
                            <input type="hidden" id="Input-Longitude" value="<?php echo $Title[0]['Longitude']?>">

                            <span>Prorroga: <b><?php echo $Title[0]['Extend']?> </b></span>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        <div class="transferencias-titulos">
        
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-solid fa-users"></i></span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Transferencias del título</span>
                    <div class="text">
                     
                        <div class="container-transfers transfer-title">    
                        </div>
                        <button class="button_plus" id="button-transfer-title"> <i class="fa-solid fa-plus"></i> </button>
                    </div>
                </div>

            </div>
            
        </div>
       
        <div class="transferencias-millares">
            
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"> <i class="fa-solid fa-droplet"></i> </span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Transferencia de millares</span>
                    <div class="text">
                        <div class="container-transfers-thousand">
                                
                        </div>
                        <button class="button_plus" id="button-transfer-thousand"> <i class="fa-solid fa-plus"></i> </button>
                        
                    </div>
                </div>

            </div>
        </div>
        
        
    </div>
    <div class="container_body">   
    <div class="change-location">
            
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"> <i class="fa-solid fa-layer-group"></i> </span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Cambios de ubicación</span>
                    <div class="text">
                        <div class="container-change-location">
                                <h5>Sin cambios de ubicación</h5>
                        </div>
                        <button class="button_plus" id="button-change-location"> <i class="fa-solid fa-plus"></i>  </button>
                        
                    </div>
                </div>

            </div>
        </div>
       
    </div>
    
    
</div>