let components ="Components/";
let Server ="Server/";
let CargarArchivo="Server/CargarExcel.php";
function section (name,text) {
    const $text=` 
    <a href="menu.php?section=${name}" class="menu-previous"> <i class="fa-solid fa-arrow-left"></i></a>
    <span class="text_section"><b>${text}</b> </span>
    `;
    $("#toglee").hide();
    $(".section").html($text);
}
export  {components,Server,CargarArchivo,section} ;
