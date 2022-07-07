<div class="drop-area">
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
</div>
<script>
const dropArea = document.querySelector(".drop-area");
const MensajeUpload = document.querySelector(".Mensaje_upload_archivo");
const dragText = MensajeUpload.querySelector("h2");
const button = dropArea.querySelector(".cargar_archivo");
const input = dropArea.querySelector("#input-file");
var button_upload ;
let files;
let $Subir_Archivo;

button.addEventListener("click", (e) => {
input.click();
});
input.addEventListener("change", (e) => {
files = input.files;
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
	// if(validExtension.includes(docType)){
	
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
					<progress value="0" max="100" id="barra" class="barraStyle"> </progress><i class="fa-solid fa-circle-xmark"></i>
					<span id="porcentaje_progreso">0%</span>
					<button type="button" id="subir"class="btn  btn-sm" disabled><i class="fa-solid fa-arrow-up-from-bracket"></i> Subir </button> 
					<button type="button" id="cancelar" class="btn btn-sm " disabled><i class="fa-solid fa-xmark"></i> Cancelar </button>
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
		fileReader.readAsDataURL(file);
		fileReader.addEventListener("progress",e =>{
        let progress = parseInt((e.loaded*100)/e.total);
		console.log(progress);
		$('#barra').val(progress);
		$('#porcentaje_progreso').html(`<b>${progress}%</b>`);
		});
		fileReader.addEventListener("loadend",e =>{
			
			$Subir_Archivo=file;
			document.getElementById('subir').disabled = false;
			document.getElementById('cancelar').disabled = false;
		});
		
		
		
    // }else{
	// 	alert("incompatible");
	// }
	$("#subir").click(function() {
		$('#'+id).hide();
	$('.cargar_archivo').show();
	$('.Mensaje_upload_archivo').show();
	upload($Subir_Archivo);
});
$("#cancelar").click(function() {
	$('#'+id).hide();
	$('.cargar_archivo').show();
	$('.Mensaje_upload_archivo').show();
	input.value="";
});
	
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
		if(xhr.status >=200 && xhr.status <300){
			if(xhr.responseText=="1"){
					alert("exitoso");
			}else{
				
				$('#'+id_archivo_unica).hide();
	$('.cargar_archivo').show();
	$('.Mensaje_upload_archivo').show();
	input.value="";
	alert("error"+xhr.responseText);
			}

}else{
	alert("error: "+xhr.statusText);
	$('#'+id_archivo_unica).hide();
	$('.cargar_archivo').show();
	$('.Mensaje_upload_archivo').show();
	input.value="";
}
	
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
</script>