<link rel="stylesheet" href="css/CargarArchivo.css">
<script src="js/cargarArchivo.js"></script>
<div class=" drop-area ">
	<div class="Mensaje_upload_archivo">
		<h2>Cargar Archivo con extensión .csv</h2>
			<span>O</span>
	</div>
	<div id="preview">
	 
	</div>
	
	<button class="cargar_archivo" >Selecciona el archivo</button>
	
	<form enctype="multipart/form-data" id="formulario_subir_excel" hidden>
		<input type="file" name ="" id = input-file size="1" hidden>
	</form>

	<div class="alert alert-danger " style="display:none" id="error_upload_alert" role="alert">
	
    </div>

</div>
