import * as link from "../Modules/links.js";
$(document).ready(function () {
// ----------------------------------------------- section de variables globales --------------------------------------------------
	const dropArea = document.querySelector(".drop-area");
	const MensajeUpload = document.querySelector(".Mensaje_upload_archivo");
	const dragText = MensajeUpload.querySelector("h2");
	const button = dropArea.querySelector(".cargar_archivo");
	const input = dropArea.querySelector("#input-file");
	var año=2020;
	var tipo="Títulos";
	var id_archivo_unica=null;
	var button_upload;
	let files;
	let $Subir_Archivo;
	
	$('#error_upload_alert').hide();
// ----------------------------------------------  eventos globales -----------------------------------------------------------------
	button.addEventListener("click", (e) => {
		tipos_de_archivos("input");

	});


	input.addEventListener("change", (e) => {
    	$('#error_upload_alert').hide();
   		dropArea.classList.remove("upload_error");
		files = input.files;
		dropArea.classList.remove("upload_error");
		$('.error_upload_alert').hide();
		dropArea.classList.add("active");
		showFiles(files);
		dropArea.classList.remove("active");
	});


	dropArea.addEventListener("dragover", (e) => {
		e.preventDefault();
		dropArea.classList.add("active");
		dragText.textContent = "Suelta para cargar los archivos";
	});


	dropArea.addEventListener("dragleave", (e) => {
		e.preventDefault();
		dropArea.classList.remove("active");
		dragText.textContent = "Cargar Archivo con extensión .csv";
	});


	dropArea.addEventListener("drop", (e) => {
		e.preventDefault();
		
		$('#error_upload_alert').hide();
		dropArea.classList.remove("upload_error");
		files = e.dataTransfer.files;
		tipos_de_archivos("drop",files);
		dropArea.classList.remove("active");
		dragText.textContent = "Cargar Archivo con extensión .csv";	
	});

// ----------------------------------------------  funciones -----------------------------------------------------------------------------
	function showFiles(files)
	{
		if(files.length==undefined)
		{
			processFile(files);
		}else{
			if(files.length>1)
			{
				alert("solo se permite un archivo");
			}else{
				for(const file of files)
				{
				processFile(file);
				}
			}
		}
	}


// ----------------------------------------------- se lee informacion del archivo ----------------------------------------------------------
	function processFile(file){
		const docType = file.type;
		const validExtension = ['text/csv','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		if(validExtension.includes(docType)){
		
			const fileReader = new FileReader();
			const id = `file-${Math.random().toString(32).substring(7)}`;
			const fileUrl = fileReader.result;
			const csv = `
				<div id="${id}" class="file-container">
					<img class="img_excel"src="img/excel_alert.png" alt="${file.name}" >
					<div class="status">
						<span>${file.name}</span>
						<div>
							<div class="progress">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
								
							</div>
							
						</div>
						<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
						<button type="button" id="cancelar" class="btn btn-sm " disabled><i class="fa-solid fa-arrow-up-from-bracket"></i> Seleccionar</button>
					</div>
				</div>	
				`;
			
				$('#'+id).show();
				$('#subir').show();
				$('#cancelar').show();
				$('.cargar_archivo').hide();
				$('.Mensaje_upload_archivo').hide();
				button_upload = document.querySelector("#subir");


				if(id_archivo_unica!=null){
					$('#'+id_archivo_unica).hide();
					id_archivo_unica=id;
				}else{
					id_archivo_unica=id;
				}

				$('.Mensaje_upload_archivo').hide();

				const html = document.querySelector("#preview").innerHTML;
				document.querySelector("#preview").innerHTML = csv + html;
				
				const img_excel = document.querySelector(".img_excel");
				img_excel.addEventListener("click", e => {
					tipos_de_archivos("modificar",file);
				});


				$(".fa-circle-xmark").click(function() {
					cancelado=true;
					fileReader.abort();  
					fileReader = nulo;

						
				});
				// --------------------------------------se emepieza a carar el archivo ----------------------------------------------
				fileReader.readAsDataURL(file);

				fileReader.addEventListener("progress",e =>{

					let progress = parseInt((e.loaded*100)/e.total);
					console.log(progress);
					$(".progress-bar").css({'width':''+progress+'%'});
					$('.progress-bar').html(`<b>${progress}%</b>`);
					
				});
				//------------------------------- se envia a anlizar el archivo -------------------------------
				fileReader.addEventListener("loadend",e =>{

					$('.progress-bar').html(`<b>Analizando ...</b>`);
					$Subir_Archivo=file;
					upload($Subir_Archivo,link.CargarArchivo,"Analizar");
				
				});
//----------------------------------------------------------- Se guarda el archivo en la base de datos ---------------------------------------------------------			
				

				$("#cancelar").click(function() {
					$('#'+id).hide();
					$('#error_upload_alert').hide();
					$('.cargar_archivo').show();
					$('.Mensaje_upload_archivo').show();
					dropArea.classList.remove("upload_error");
					$('.error_upload_alert').hide();
					input.value="";
					tipos_de_archivos("input");
					
				});
			
		}else{
			$("#error_upload_alert").html(`<b>Tipo de archivo incompatible</b>`);
			$("#error_upload_alert").removeClass("alert-danger").addClass("alert-warning");
			$("#error_upload_alert").show();
		}
		
		
		//document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
	}




function upload(files,url,operacion){
    var yy = files.size > 4000000;
    if (yy) {
		alert("Imagen a subir maximo 4mb");
        return;
    }

	


	
	const xhr= new XMLHttpRequest();
	var formData = new FormData();
	formData.append("file",files);
	formData.append("tipo", tipo);
	formData.append("año",año);
	formData.append("operacion", operacion);

	xhr.addEventListener("readystatechange",e =>{
		if(xhr.readyState!=4) return;
		var html_respuesta="";
		if(xhr.status >=200 && xhr.status <300){
			if(xhr.responseText=="Analizado y Guardado"){
				html_respuesta=`
				<span>${files.name}</span>
					<div class="progress">
                        <div class="progress-bar progress-bar-striped  bg-success" style="width:100%" role="progressbar"  aria-valuemin="0" aria-valuemax="100">Guardado</div>
                    </div>
					<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
					<button type="button" id="cancelar" class="btn btn-sm " ><i class="fa-solid fa-arrow-up-from-bracket"></i> Seleccionar</button>
				
				`;
                $("#error_upload_alert").removeClass("alert-warning").addClass("");
                $("#error_upload_alert").removeClass("alert-danger").addClass("alert-success");
                $("#error_upload_alert").show();
				$('#error_upload_alert').html(`
                <b>Se ha guardado con exito! </b>
                <a href="#"type="button" class="btn btn-sm btn-outline-success">
                <b> Ver archivo</b>
                </a>`
                
                );
				$('#error_upload_alert').show();	
				dropArea.classList.remove("upload_error");
				$('.error_upload_alert').hide();
			}else if(xhr.responseText=='Analizado'){
				html_respuesta=`
				<span>${files.name}</span>
					<div class="progress">
                        <div class="progress-bar progress-bar-striped  bg-primary" style="width:100%" role="progressbar"  aria-valuemin="0" aria-valuemax="100"><b>Analizado sin problemas</b></div>
                    </div>
					
					<button type="button" id="subir"class="btn  btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
					<button type="button" id="cancelar" class="btn btn-sm" ><i class="fa-solid fa-arrow-up-from-bracket"></i> Seleccionar</button>
				
				`;
				$('#error_upload_alert').hide();
			}else{
				
				html_respuesta=`
				<span>${files.name}</span>
					<div class="progress">
                        <div class="progress-bar progress-bar-striped bg-danger" style="width:100%" role="progressbar"  aria-valuemin="0" aria-valuemax="100">Error</div>
                    </div>
					<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
					<button type="button" id="cancelar" class="btn btn-sm " ><i class="fa-solid fa-arrow-up-from-bracket"></i> Seleccionar</button>
				
				`;
                $("#error_upload_alert").removeClass("alert-warning").addClass(" alert-danger");
                $("#error_upload_alert").show();
				$('#error_upload_alert').html(xhr.responseText);
				dropArea.classList.add("upload_error");
				$('#error_upload_alert').show();
			}

}else{
	html_respuesta=`
    <span>${files.name}</span>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-danger" style="width:100%" role="progressbar"  aria-valuemin="0" aria-valuemax="100">Error</div>
    </div>
    <button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
    <button type="button" id="cancelar" class="btn btn-sm " ><i class="fa-solid fa-arrow-up-from-bracket"></i> Seleccionar</button>

`;
$("#error_upload_alert").removeClass("alert-warning").addClass(" alert-danger");
$("#error_upload_alert").show();
				$('#error_upload_alert').html(xhr.statusText);
				$('#error_upload_alert').show();
				dropArea.classList.add("upload_error");
}
$('.status').html(html_respuesta);
$("#subir").click(function() {
	document.getElementById('subir').disabled = true;
	upload($Subir_Archivo,link.CargarArchivo,"Guardar");
	$('#error_upload_alert').hide();
	

});
$("#cancelar").click(function() {
	$('#'+id_archivo_unica).hide();
	$('#error_upload_alert').hide();
	$('.cargar_archivo').show();
	$('.Mensaje_upload_archivo').show();
	dropArea.classList.remove("upload_error");
	input.value="";
	tipos_de_archivos("input");
});
	});
	xhr.open("POST",url);
	xhr.setRequestHeader("enc-type","multipart/forma-data");
	xhr.send(formData);


	

}
function tipos_de_archivos(TipoUpload,files=""){
	var years=`
	<select class="select-swit documentYear" aria-label="Default select example">
		<option selected="${año}">${año}</option>
		`;
		for(var i=2000; i<2100; i++) {
			if(i!=año){
				years+=`<option value="${i}">${i}</option>`;	
			}
		}
		years+="</select>";
	var tipos=["Títulos","Padrón de usuarios","Inversiones"];
	var tipo_arch=`
 		<select class="select-swit documentType " aria-label="Default select example">
		`;
	for(i=0; i<tipos.length; i++)
	{
	tipo_arch+= tipos[i]==tipo ?`<option selected="${tipos[i]}">${tipos[i]}</option>`:	`<option value="${tipos[i]}">${tipos[i]}</option>`;
	}
 	tipo_arch+="</select>";
	
	Swal.fire({
		title: 'Tipo de formato del archivo y fecha',
  		confirmButtonText: 'Listo!',
		imageUrl: 'img/excel_alert.png',
		imageWidth: 200,
  		imageHeight: 200,
		html: tipo_arch+years
		
		
	  }).then((result) => {
		if (TipoUpload=="input"){
			input.click();
		}else if(TipoUpload=="drop"){
			showFiles(files);
		}else if(TipoUpload=="modificar"){
			showFiles(files);
		}
	  });
	  
	const documentType = document.querySelector(".documentType");
	const documentYear = document.querySelector(".documentYear");

	documentType.addEventListener("change", e => {
		tipo=e.target.value;
	});
	documentYear.addEventListener("change", e => {
		año=e.target.value;
	});
}

});

