<link rel="stylesheet" href="css/exportarDatos.css">
<script type="module">
$(".getDocument").click(function(){
const Document = $(this).attr("id");
  $('<form action="Server/GenerarExcel.php" method="post"><input type="hidden" name="Document" value="'+Document+'" /></form>')
    .appendTo('body').submit();


});
</script>
<div class="container-principal">
    <div class="principal_header">
       <div class="text">
       <span><i class="fa-solid fa-arrow-up-from-bracket"> </i></span>
       <h4>Exportar archivo de Excel</h4>

       </div>
    </div>
    <div class="principal_body">
     <div class="buttons">
        <button class="getDocument" id="Padron de usuarios"> <b>Padrón de usuarios</b> </button>
        <button class="getDocument" id="Usuarios privados"> <b>Usuarios Privados</b></button>
        <button class="getDocument" id="Usuarios sociales"> <b>Usuarios Sociales</b></button>
        <button class="getDocument" id="Titulos"> <b>Titulos de concesión</b></button>
        <button class="getDocument" id="Inversiones"> <b>Inversiones</b></button>
        <button class="getDocument" id="Usuarios"> <b>Usuarios</b></button>

     </div>
        
    </div>
</div>