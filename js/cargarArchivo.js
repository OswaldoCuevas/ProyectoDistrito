$(document).ready(function () {
const dropArea = document.querySelector(".drop-area");
const MensajeUpload = document.querySelector(".Mensaje_upload_archivo");
const dragText = MensajeUpload.querySelector("h2");
const button = dropArea.querySelector(".cargar_archivo");
const input = dropArea.querySelector("#input-file");
var button_upload ;
let files;
let $Subir_Archivo;
$('#error_upload_alert').hide();

button.addEventListener("click", (e) => {
input.click();

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


function showFiles(files){
if(files.length==undefined){
	processFile(files);
}else{
	if(files.length>1){
		alert("solo se permite un archivo");
	}else{
		for(const file of files){
		processFile(file);
	}
		
	}
}
}
var id_archivo_unica=null;
function processFile(file){
	const docType = file.type;
	const validExtension = ['text/csv'];
	 if(validExtension.includes(docType)){
	
		const fileReader = new FileReader();
		const id = `file-${Math.random().toString(32).substring(7)}`;
		fileReader.addEventListener("load", (e) => {
			
			
		});
		const fileUrl = fileReader.result;
			const csv = `
			<div id="${id}" class="file-container">
				<img src="img/excel_alert.png" alt="${file.name}" width="150px" height="150px">
				<div class="status">
					<span>${file.name}</span>
                    <div>
					    <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
                            
                        </div>
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
					<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
					<button type="button" id="cancelar" class="btn btn-sm " disabled><i class="fa-solid fa-arrow-up-from-bracket"></i> Cargar otro</button>
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
var cancelado=false;
$(".fa-circle-xmark").click(function() {
    cancelado=true;
    fileReader.abort();  
    fileReader = nulo;

        
});
       

		fileReader.readAsDataURL(file);
		fileReader.addEventListener("progress",e =>{
        let progress = parseInt((e.loaded*100)/e.total);
		console.log(progress);
        $(".progress-bar").css({'width':''+progress+'%'});
		$('.progress-bar').html(`<b>${progress}%</b>`);
		});
		fileReader.addEventListener("loadend",e =>{
            if(cancelado)
            {
            $(".progress-bar").removeClass("progress-bar-animated").addClass("bg-danger");
            $('.progress-bar').html(`<b>Cancelado</b>`);
			$Subir_Archivo=file;
			document.getElementById('subir').disabled = true;
			document.getElementById('cancelar').disabled = false;
            files="";
            }else{
                $(".progress-bar").removeClass("progress-bar-animated").addClass("bg-success");
            $('.progress-bar').html(`<b>Finalizado</b>`);
			$Subir_Archivo=file;
			document.getElementById('subir').disabled = false;
			document.getElementById('cancelar').disabled = false;
            }
        });
		
		$("#subir").click(function() {
            document.getElementById('subir').disabled = true;
        upload($Subir_Archivo);
        $('#error_upload_alert').hide();
    });
    $("#cancelar").click(function() {
        $('#'+id).hide();
        $('#error_upload_alert').hide();
        $('.cargar_archivo').show();
        $('.Mensaje_upload_archivo').show();
        dropArea.classList.remove("upload_error");
        $('.error_upload_alert').hide();
        input.value="";
        input.click();
    });
		
     }else{
        $("#error_upload_alert").html(`<b>Tipo de archivo incompatible</b>`);
        $("#error_upload_alert").removeClass("alert-danger").addClass("alert-warning");
        $("#error_upload_alert").show();
	}
	
	
	//document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
}



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
	showFiles(files);
	dropArea.classList.remove("active");
dragText.textContent = "Cargar Archivo con extensión .csv";

});
function upload(files){
	
    var fo = files;  
    var yy = fo.size > 4000000;
    if (yy) {
		alert("Imagen a subir maximo 4mb");
        return;
    }
    var data = new FormData();
    data.append("archivo", fo);

	
	const xhr= new XMLHttpRequest();
	formData = new FormData();
	formData.append("file",files);
	xhr.addEventListener("readystatechange",e =>{
		if(xhr.readyState!=4) return;
		var html_respuesta="";
		if(xhr.status >=200 && xhr.status <300){
			if(xhr.responseText=="1"){
				html_respuesta=`
				<span>${files.name}</span>
					<div class="progress">
                        <div class="progress-bar progress-bar-striped  bg-success" style="width:100%" role="progressbar"  aria-valuemin="0" aria-valuemax="100">Guardado</div>
                    </div>
					<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
					<button type="button" id="cancelar" class="btn btn-sm " ><i class="fa-solid fa-arrow-up-from-bracket"></i> Cargar otro</button>
				
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
			}else{
				
				html_respuesta=`
				<span>${files.name}</span>
					<div class="progress">
                        <div class="progress-bar progress-bar-striped bg-danger" style="width:100%" role="progressbar"  aria-valuemin="0" aria-valuemax="100">Error</div>
                    </div>
					<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
					<button type="button" id="cancelar" class="btn btn-sm " ><i class="fa-solid fa-arrow-up-from-bracket"></i> Cargar otro</button>
				
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
    <button type="button" id="cancelar" class="btn btn-sm " ><i class="fa-solid fa-arrow-up-from-bracket"></i> Cargar otro</button>

`;
$("#error_upload_alert").removeClass("alert-warning").addClass(" alert-danger");
$("#error_upload_alert").show();
				$('#error_upload_alert').html(xhr.statusText);
				$('#error_upload_alert').show();
				dropArea.classList.add("upload_error");
}
$('.status').html(html_respuesta);
$("#cancelar").click(function() {
	$('#'+id_archivo_unica).hide();
	$('#error_upload_alert').hide();
	$('.cargar_archivo').show();
	$('.Mensaje_upload_archivo').show();
	dropArea.classList.remove("upload_error");
	input.value="";
	input.click();
});
	});
	xhr.open("POST","componentes/Server/SaveExcel.php");
	xhr.setRequestHeader("enc-type","multipart/forma-data");
	xhr.send(formData);


	
//     $.ajax({
//         url: "componentes/Server/SaveExcel.php",
//         type: "post",
//         data: data,
//         processData: false,
//         contentType: false,
//         error: function (e) {
//             alert("Hubo error"+e.toString());
//         },
//         success: function (res) {
//             alert(res);
//         }
  
// });
}
});