<div class="drop-area">
	<div class="Mensaje_upload_archivo">
		<h2>Cargar Archivo con extensión .csv</h2>
		<span>O</span>
	</div>
	<div id="preview"></div>
	<button class="cargar_archivo" >Selecciona el archivo</button>
	<form enctype="multipart/form-data" id="formulario_subir_excel" hidden>
		<input type="file" name ="" id = input-file size="1" hidden>
	</form>
</div>
<script>
const dropArea = document.querySelector(".drop-area");
const MensajeUpload = document.querySelector(".Mensaje_upload_archivo");
const dragText = MensajeUpload.querySelector("h2");
const button = dropArea.querySelector("button");
const input = dropArea.querySelector("#input-file");
let files;

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
	alert(""+files.length);
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
			const fileUrl = fileReader.result;
			const csv = `
			<div id="${id}" class="file-container">
			<img src="img/excel_alert.png" alt="${file.name}" width="150px" height="150px">
			<div class="status">
				<span>${file.name}</span>
				<span class="status-text">Loading...</span>
			</div>
			</div>
			`
			if(id_archivo_unica!=null){
				$('#'+id_archivo_unica).hide();
			}else{
				id_archivo_unica=id;
			}
			$('.Mensaje_upload_archivo').hide();
			const html = document.querySelector("#preview").innerHTML;
			document.querySelector("#preview").innerHTML = csv + html;
			upload();
		});
		fileReader.readAsDataURL(file);
			
			uploadFile(file, id);
    }else{
		alert("incompatible");
	}
		
	
	//document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
}
function uploadFile(file){

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
function upload(){
	
    var fo = ($("#input-file"))[0].files[0];  
    var yy = fo.size > 4000000;
    if (yy) {
		alert("Imagen a subir maximo 4mb");
        return;
    }
    var data = new FormData();
    data.append("archivo", fo);
	
    $.ajax({
        url: "componentes/Server/SaveExcel.php",
        type: "post",
        data: data,
        processData: false,
        contentType: false,
        error: function (e) {
            alert("Hubo error"+e.toString());
        },
        success: function (res) {
            alert(res);
        }
  
});
}
</script>