<link rel="stylesheet" href="css/Titulos.css">
<script type="module">
$(".mostrar-ocultar").on('click', function(e) {

  $(`.text-trasnfer-${$(this).attr("id")}`).toggleClass("display-none");
});
</script>
<div class="container-primary">
    <div class="container_header">
    <div class="titulo">
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-solid fa-scroll"> </i></span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Número de título</span>
                    <span class="name"><b>01BCS100893/03IMDL17</b></span>
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
                    <span class="name"><b>José Manuel Cuevas Herrera</b></span>
                </div>

            </div>
        </div>
       
        <div class="vigencia-well">
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-regular fa-circle-check"></i></span>
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
                            
                            <span>Colonia: <b>La laguna</b></span>
                            <span>Lote: <b>5-D</b></span>
                            <span>Dotación: <b>243 millares</b></span>
                            <span>Latitud: <b>123 762 123</b></span>
                            <span>Longitud: <b>123 762 123</b></span>
                            <span>Prorroga: <b>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </b></span>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        <div class="transferencias-titulos">
        <button id="button_plus"> <i class="fa-solid fa-plus"></i> </button>
            <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"><i class="fa-solid fa-users"></i></span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Transferencias del título</span>
                    <div class="text">
                     
                     <div class="container-transfers">
                            <div class="transfer" >
                                <div class="info">
                                    <span>Fecha: <b>18 de agosto del 2000 </b></span>
                                    <span class="text-trasnfer-1 display-none">Nuevo: <b>José Manuel Cuevas ...</b></span>
                                    <span class="text-trasnfer-1 display-none">No. Control: <b>2020056</b></span>
                                    <span class="text-trasnfer-1 display-none">Previo: <b>Juan Antonio Solis</b></span>
                                    <span class="text-trasnfer-1 display-none">No. Control: <b>2020156</b></span>
                                  
                                    
                                </div>
                                <div class="desplegar ">
                                        <span class="mostrar-ocultar" id="1"><i class="fa-solid fa-chevron-down"></i></span>
                                </div>
                            </div> 
                            
                            
                            
                        </div>
                        
                      
                    </div>
                </div>

            </div>
            
        </div>
       
        <div class="transferencias-millares">
        <button id="button_plus"> <i class="fa-solid fa-plus"></i> </button>
        <div class="container-section">
                <div class="logo-titulo">
                    <span class="span-logo-titulo"> <i class="fa-solid fa-droplet"></i> </span>
                </div>
                <div class="container-titulo">
                    <span class="sector">Transferencia de millares</span>
                    <div class="text">
                    <div class="container-transfers">
                            <div class="transfer" >
                                <div class="info">
                                    <span>Fecha: <b>18 de agosto del 2000 </b></span>
                                    <span class="text-trasnfer-1 display-none">Nuevo: <b>José Manuel Cuevas ...</b></span>
                                    <span class="text-trasnfer-1 display-none">No. Control: <b>2020056</b></span>
                                    <span class="text-trasnfer-1 display-none">Previo: <b>Juan Antonio Solis</b></span>
                                    <span class="text-trasnfer-1 display-none">No. Control: <b>2020156</b></span>
                                    <span class="text-trasnfer-1 display-none">Millares: <b>123 millares</b></span>
                                    
                                </div>
                                <div class="desplegar ">
                                        <span class="mostrar-ocultar" id="1"><i class="fa-solid fa-chevron-down"></i></span>
                                </div>
                            </div> 
                            
                            
                            
                            
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    
    
</div>