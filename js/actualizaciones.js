import * as link from "../Modules/links.js";
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
    $(".download-title").on('click', function() {
        
        const Document = $(this).attr('id');
        const Name = $(".Name_"+Document).attr("id") 
        location.href ="Server/GenerarExcel.php?Document=Document_Title&Document_Id="+Document+"&Name="+Name;
    });
    $(".download-padron").on('click', function() {
        
        const Document = $(this).attr('id');
        const Name = $(".Name_"+Document).attr("id") 
        location.href ="Server/GenerarExcel.php?Document=Document_User&Document_Id="+Document+"&Name="+Name;
    });
    $(".download-inversion").on('click', function() {
        
        const Document = $(this).attr('id');
        const Name = $(".Name_"+Document).attr("id") 
        location.href ="Server/GenerarExcel.php?Document=Document_Inversion&Document_Id="+Document+"&Name="+Name;
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
