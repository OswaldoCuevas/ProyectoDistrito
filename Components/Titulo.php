<link rel="stylesheet" href="css/Titulo.css">
<?php
include ('../Server/conexion.php') ;
include ('../Class/Title.php') ;
include ('../Functions/FunctionDocuments.php') ;
$Title_Id = $_POST['Title_Id'];
$Title_= new Title();
$Title = $Title_ -> getTitle($Title_Id);
$date1 = new DateTime($Title[0]['Initial_Date']);
$date_actual = date("Y-m-d");
$date2 = new DateTime($date_actual);
$diff = $date1->diff($date2);
$years_ = $Title[0]['Validity'] - $diff->y;

$sectionValidity = $years_ > 1 ?"vigencia-well":"vigencia-bad";
$timeLeft =  $years_." Años ";
if($years_ > 1 && 12-$diff->m > 1 && 12-$diff->m < 12   ){    
    $m = (12-$diff->m) == 1 ?(12-$diff->m)."Mes ":(12-$diff->m)." Meses";
    $timeLeft =  ($years_-1) > 1 ?($years_-1)  ." Años ".$m:($years_-1) ." Año ".$m;
}
if($years_ <= 1 && $years_ > -1){    
    $timeLeft =  12-$diff->m == 1  ?(12-$diff->m). " Mes":(12-$diff->m)." Meses";
}

// will output 2 days

?>
<script type="module">
    import * as link from "./Modules/links.js";
    import * as User from "./Modules/Class/User.js";
    import * as _Title from "./Modules/Class/Title.js";
    import * as _transferWater from "./Modules/Class/TransferWater.js";

    
    import * as _Arraylist from "./Modules/Class/ArrayList.js";
$(document).ready(function() {
    
    var ArrayListTransferTitle  = new _Arraylist.TransferTitle();
    var ArrayListTransferWater  = new _Arraylist.TransferWater();
    var ArrayListLocation       = new _Arraylist.Location();
    var UserPrevious            = new User.user($("#User_Id").val(),$("#Full_Name").val());
    var UserNew                 = new User.user(null,null);
    var TransferWater           = new _transferWater.transferWater();
    var año                     = "2022-10-29";
    
    link.section($("#previous").val(),"");
    setTransferTitle()
    $("#button-transfer-thousand").on('click', function(e) {
        switchAlertSearchTitle()               
    });
    $("#button-change-location").on('click', function(e) {
        data_change_location ()             
    });
    setlocation()
    setTransferThousand()
    function setlocation(){
        $.ajax({
        
            url : `${link.Server}showTransfer.php`,
            data : {"Title_Id":$("#Title_Id").val(),'type':'location'},
            type : 'POST',
            assynchronous : true,
            success: function (response) {
                let $html =``;
                if(response!=0){
                    const Locations = JSON.parse(response);
                    ArrayListLocation.Locations = [];
                    for(const Location of Locations){
                        const Change_Id     = Location.Change_Id    == null ? "" : Location.Change_Id; 
                        const Title_Id      = Location.Title_Id     == null ? "" : Location.Title_Id; 
                        const Change_Date   = Location.Change_Date  == null ? "" : Location.Change_Date;
                        const Plot1         = Location.Plot1        == null ? "" : Location.Plot1; 
                        const Cologne1      = Location.Cologne1     == null ? "" : Location.Cologne1;
                        const Longitude1    = Location.Longitude1   == null ? "" : Location.Longitude1;
                        const Latitude1     = Location.Latitude1    == null ? "" : Location.Latitude1;
                        const Plot2         = Location.Plot2        == null ? "" : Location.Plot2;
                        const Cologne2      = Location.Cologne2     == null ? "" : Location.Cologne2;
                        const Longitude2    = Location.Longitude2   == null ? "" : Location.Longitude2; 
                        const Latitude2     = Location.Latitude2    == null ? "" : Location.Latitude2;
                        ArrayListLocation.setLocation(Change_Id,Title_Id,Change_Date,Plot1,Cologne1,Longitude1,Latitude1,Plot2,Cologne2,Longitude2,Latitude2)
                        $html +=  ` <div class="transfer section-change" id="change-${Change_Id}">
                                        <div class="info">
                                            <span style="text-align:left;"><b>Fecha: </b>${formatDate(Change_Date)}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b><u>Ubicación nueva</u></b></span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Colonia: </b>${Cologne2}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Lote: </b>${Plot2}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Longitúd: </b>${Longitude2}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Latitúd: </b>${Latitude2}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b><u>Ubicación previa</u></b></span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Colonia: </b>${Cologne1}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Lote: </b>${Plot1}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Longitúd: </b>${Longitude1}</span>
                                            <span style="text-align:left;" class="text-location${Change_Id} display-none "><b>Latitúd: </b>${Latitude1}</span>
                                        </div>
                                        <div class="desplegar ">
                                                <span class="mostrar-ocultar" id="${Change_Id}"><i class="fa-solid fa-chevron-down"></i></span>
                                                <span id="${Change_Id}" class="text-location${Change_Id} drop-location display-none"><i class="fa-solid fa-trash"></i></span>
                                        </div>
                                    </div>`
                    }
                    
                } else{
                $html= "<h5>Sin cambios de ubicación</h5>";
                }
                $(".container-change-location").html($html);
                var active = 0;
                $(".mostrar-ocultar").on('click', function(e) {
                    const id =$(this).attr('id');
                    $(`.text-location${id}`).toggleClass("display-none");
                    if(active == 0){
                        $(".section-change").hide();
                        $("#change-"+id).show();
                        active=1;
                    }else{
                        $(".section-change").show();
                        active=0;
                    }
                });
                $(".drop-location").on('click', function(e) {
                    const id =$(this).attr('id');
                    alertDropLocation(id)
                });
            }
        });
    }
    function setTransferThousand(){
        $.ajax({
        
        url : `${link.Server}showTransfer.php`,
        data : {"Title_Id":$("#Title_Id").val(),'type':'thousand'},
        type : 'POST',
        assynchronous : true,
        success: function (response) {
            var $html =``;
            if(response!=0){
                const TransferThousands = JSON.parse(response);
                ArrayListTransferWater.TransferWaters = [];
                for(const TransferThousand of TransferThousands){
                    const Transfers_Id   = TransferThousand.Transfers_Id;  
                    const Date_Start     = TransferThousand.Date_Start;
                    const Date_End       = TransferThousand.Date_End;
                    const Amount         = TransferThousand.Amount;
                    const SetTitleNumber = TransferThousand.SetTitleNumber;
                    const GetTitleNumber = TransferThousand.GetTitleNumber;
                    const SetTitleId     = TransferThousand.SetTitleId;
                    const GetTitleId     = TransferThousand.GetTitleId;
                    const SetName        = TransferThousand.SetName;
                    const GetName        = TransferThousand.GetName;
                    const SetControl_Num = TransferThousand.SetControl_Num;
                    const GetControl_Num = TransferThousand.GetControl_Num
                    ArrayListTransferWater.setTransferWater(Transfers_Id,Date_Start,Date_End,Amount,SetTitleNumber,GetTitleNumber,SetTitleId,GetTitleId,SetName,GetName,SetControl_Num,GetControl_Num);
                                
                    $html +=  ` <div class="transfer section-th" id="th-${Transfers_Id}" >
                                    <div class="info">
                                        <span style="text-align:left;"><b>Inicio: </b>${formatDate(Date_Start)}</span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>Fin: </b>${formatDate(Date_End)}</span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>Canidad: </b>${Amount} Millares</span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>Título que concede: <u>${SetTitleNumber}</u></b></span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>Usuario: </b>${SetName}</span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>No. control: </b>${SetControl_Num}</span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>Título que recibe <u>${GetTitleNumber}</u></b></span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>Usuario: </b>${GetName}</span>
                                        <span style="text-align:left;" class="text-trasnfer-thousand${Transfers_Id} display-none"><b>No. control: </b>${GetControl_Num}</span>
                                        
                                    </div>
                                    <div class="desplegar ">
                                            <span class="mostrar-ocultar" id="${Transfers_Id}"><i class="fa-solid fa-chevron-down"></i></span>
                                            <span id="${Transfers_Id}" class="text-trasnfer-thousand${Transfers_Id} drop-transfer-thousand display-none"><i class="fa-solid fa-trash"></i></span>
                                    </div>
                                </div>`
                }
                
            }else{
                $html= "<h5>Sin transferencias</h5>";
            }
            $(".container-transfers-thousand").html($html);
            var active=0;
            $(".mostrar-ocultar").on('click', function(e) {
                const id =$(this).attr('id');
                $(`.text-trasnfer-thousand${id}`).toggleClass("display-none");
                if(active == 0){
                        $(".section-th").hide();
                        $("#th-"+id).show();
                        active=1;
                    }else{
                        $(".section-th").show();
                        active=0;
                    }
            });
            $(".drop-transfer-thousand").on('click', function(e) {
                const id =$(this).attr('id');
                alertDropTransferThousand(id);
            });
        }
        });  
    }
    function setTransferTitle(){
        $.ajax({
        
            url : `${link.Server}showTransfer.php`,
            data : {"Title_Id":$("#Title_Id").val(),'type':'title'},
            type : 'POST',
            assynchronous : true,
            success: function (response) {
              if(response != 0){

                ArrayListTransferTitle.TransferTitles = [];
                const TransferTitles=JSON.parse(response);
                var html=` `;
                for(const TransferTitle of TransferTitles){
                    const Transfer_Date = TransferTitle.Transfer_Date
                    const Title_Id      = TransferTitle.Title_Id;
                    const Transfers_Id  = TransferTitle.Transfers_Id; 
                    const namePrevious  = TransferTitle.namePrevious;
                    const nameNew       = TransferTitle.nameNew;
                    const idPrevious    = TransferTitle.idPrevious;
                    const idNew         = TransferTitle.idNew;
                    const Title_Number  = TransferTitle.Title_Number;
                    const Actual        = TransferTitle.Actual;
                    ArrayListTransferTitle.setTransferTitle(Transfer_Date,Title_Id,Transfers_Id,namePrevious,nameNew,idPrevious,idNew,Title_Number,Actual );
                    html += `
                    <div class="transfer section-title" id="title-${Transfers_Id}" >
                        <div class="info">
                            <span>Fecha: <b>${formatDate(Transfer_Date.toString())}</b></span>
                            <span style="text-align:left;" class="text-trasnfer-${Transfers_Id} display-none">Nuevo: <b>${nameNew}</b></span>
                            <span style="text-align:left;" class="text-trasnfer-${Transfers_Id} display-none">No. Control: <b>${idNew}</b></span>
                            <span style="text-align:left;" class="text-trasnfer-${Transfers_Id} display-none">Previo: <b>${namePrevious}</b></span>
                            <span style="text-align:left;" class="text-trasnfer-${Transfers_Id} display-none">No. Control: <b>${idPrevious}</b></span>
                            
                            
                        </div>
                        <div class="desplegar">
                                <span class="mostrar-ocultar" id="${Transfers_Id}"><i class="fa-solid fa-chevron-down"></i></span>
                                <span id="${Transfers_Id}" class="text-trasnfer-${Transfers_Id} drop-transfer-title display-none"><i class="fa-solid fa-trash"></i></span>
                        </div>
                    </div> 
                    `;
                    
                }
               
            }else{
                html= "<h5>Sin transferencias</h5>";
            }
            $(".container-transfers").html(html);
            var active=0;
            $(".mostrar-ocultar").on('click', function(e) {
                const id =$(this).attr('id');
                $(`.text-trasnfer-${id}`).toggleClass("display-none");
                if(active == 0){
                        $(".section-title").hide();
                        $("#title-"+id).show();
                        active=1;
                    }else{
                        $(".section-title").show();
                        active=0;
                    }
            });
            $("#button-transfer-title").on('click', function(e) {
                switchAlertSearchUser()
                
            });
           
           
            $(".drop-transfer-title").on('click', function(e) {
                eliminar_transferencia_titulo($(this).attr('id'));
            });

        }
        });

    }
    function getTransferTitle(id){
        return  ArrayListTransferTitle.getTransferTitle(id);
    }
    function getTransferThousand(id){
        return  ArrayListTransferWater.getTransferWater(id);
    }
    function getLocation(id){
        return  ArrayListLocation.getLocation(id);
    }
    function eliminar_transferencia_titulo(id){
        const TransferTitle = getTransferTitle(id);
        const namePrevious = TransferTitle.getnamePrevious();
        const nameNew = TransferTitle.getnameNew();
       
        const html =`<table class="table" style="margin-top:10px">
                        <thead class="thead-dark">
                            <tr>
                            <th colspan="2">eliminar Transferencia de título</th>
                            </tr>
                            <tr>
                                <th scope="col">Usuario previo</th>
                                <th scope="col">Usuario nuevo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${namePrevious}</td>
                                <td style="color:blue">${nameNew}</td>
                            </tr>
                        </tbody>
                    </table> `;
                    Swal.fire({
                        html: html,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {dropTransferTitle(TransferTitle)})

    }
    function comparaciones(){
        var html=``;
        if(UserNew.getFull_Name() != UserPrevious.getFull_Name() && UserNew.getFull_Name() != null ){
            html += `<table class="table" style="margin-top:10px">
                        <thead class="thead-dark">
                            <tr>
                            <th colspan="2">Transferencia de título</th>
                            </tr>
                            <tr>
                                <th scope="col">Usuario previo</th>
                                <th scope="col">Usuario nuevo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${UserPrevious.getFull_Name()}</td>
                                <td style="color:blue">${UserNew.getFull_Name()}</td>
                            </tr>
                        </tbody>
                    </table> `;
        

            Swal.fire({
                        html: html,
                        showDenyButton: true,
                        confirmButtonText: 'Confirmar',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if(result.isConfirmed){
                            
                            selecciona_fecha();
                        }
                    });
        }else{
            Swal.fire({
                        title : "No se puede seleccionar el mismo usuario",
                        icon: 'error',
                    })
        }
        
    }
    function transfersTitle(){
        const data = { 
                        'Title_Id': $("#Title_Id").val(),
                        'New_User':UserNew.getControl_Num(),
                        'Previous_User':UserPrevious.getControl_Num(),
                        'Transfer_Date':año
         };
       $.ajax({
            url : `${link.Server}addTransferTitle.php`,
            data : data,
            type : 'POST',
            success: data => {
                Swal.fire('Transferencia realizada con exito', '', 'success'); 
                setTransferTitle()
            }
        });
    }
    function transfersThousand(){
       $.ajax({
            url : `${link.Server}addTransferThousand.php`,
            data : jsonTransferThousand(),
            type : 'POST',
            success: data => {
                Swal.fire('Transferencia realizada con exito', '', 'success');  
                setTransferThousand()
            }
        });
    }
    function switchAlertSearchUser(){// muestra un alert con  input en el cual s puede buscar un usuario en la base de datos
            Swal.fire({
                        title: 'Buscar nuevo usuario',
                        input: 'text',
                        inputAttributes: {
                        autocapitalize: 'off'
                    },
                        showCancelButton: true,
                        confirmButtonText: 'Buscar',
                        showLoaderOnConfirm: true,
                    preConfirm: (user) => {
                        return fetch(`Server/search_user.php?user=${user}`).then(response => {return response.json();})
                    },
                        allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    
                    if (result.isConfirmed) {
                        switchAlertUsers(result);
                        $(".selected_user").click(function() {
                            const id = $(this).attr("id")
                            const value = $(`#${format_id(format_id(id,8),9)}`).val();
                            UserNew.setControl_Num(format_id(id,8));
                            UserNew.setFull_Name(value);
                            $(".selected_user").removeClass("selected");
                            $("#"+id+"").removeClass("").addClass("selected");
                            $("#input_search_user").val(value);
                        })
                    }
                })
    }
    function switchAlertUsers(result){// muestra un alertcon una tabla  en el cual s puede seleccionar el usuario y cambiar el nombre del usuario en el documento
        Swal.fire({
                    title: `Usuarios Encontrados`,
                    html:   result.value.ok,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Seleccionar',
                    cancelButtonText: 'Buscar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                               
                    if (result.isConfirmed) {
                        if($("#input_search_user").val()!=""){
                            comparaciones()
                        }else{
                            Swal.fire('No seleccionó ningun usuario', '', 'info') .then((result) => {switchAlertSearchUser()})
                        }

                    } else if (result.isDenied) {
                                   
                    } else {
                        switchAlertSearchUser();
                    }
                            })
    }
    function switchAlertSearchTitle(){// muestra un alert con  input en el cual s puede buscar un usuario en la base de datos
            Swal.fire({
                        title: 'Buscar título que al que se transfiere',
                        input: 'text',
                        inputAttributes: {
                        autocapitalize: 'off'
                    },
                        showCancelButton: true,
                        confirmButtonText: 'Buscar',
                        showLoaderOnConfirm: true,
                      
                    preConfirm: (busqueda) => {
                        return fetch(`Server/search_title.php?busqueda=${busqueda}`).then(response => {return response.json();})
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                  
                    if (result.isConfirmed) {
                        switchAlertTitle(result);
                        $(".selected_user").click(function() {
                            const id = $(this).attr("id")
                            const value = $(`#${format_id(format_id(id,8),9)}`).val();
                            TransferWater.setGetTitleId(format_id(id,8));
                            TransferWater.setGetTitleNumber(value);
                            TransferWater.setGetName($("#user_name_"+format_id(id,8)).val())
                            $(".selected_user").removeClass("selected");
                            $("#"+id+"").removeClass("").addClass("selected");
                            $("#input_search_user").val(value);
                        })
                    }
                })
    }
    function switchAlertTitle(result){// muestra un alertcon una tabla  en el cual s puede seleccionar el usuario y cambiar el nombre del usuario en el documento
        Swal.fire({
                    title: `Títulos Encontrados`,
                    html:   result.value.ok,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Seleccionar',
                    cancelButtonText: 'Buscar',
                    denyButtonText: `Cancelar`,
                    width: '700px',
                }).then((result) => {
                               
                    if (result.isConfirmed) {
                        if($("#input_search_user").val()!=""){
                            //comparaciones()
                            data_transferThousand ();
                        }else{
                            Swal.fire('No seleccionó ningun título', '', 'info') .then((result) => {switchAlertSearchTitle()})
                        }

                    } else if (result.isDenied) {
                                   
                    } else {
                        switchAlertSearchTitle();
                    }
                            })
    }
    function data_transferThousand (){
        const html = `
        <div>
            <label for = "Amount">Cantidad</label>
            <input  type="Number" min="0" id="Amount" class="swal2-input col-5">
        </div>
        
        <div>
            <label for = "Date_Start" >Fecha de inicio</label>
            <input type="Date" id="Date_Start" class="swal2-input">
        </div>
        
        <div> 
            <label for = "Date_End" >Fecha de fin</label>
            <input type="Date" id="Date_End" class="swal2-input">
        </div>
        
        `;
        Swal.fire({
                    title: `Llenar formulario de transferencia`,
                    html: html  ,
                    showDenyButton: true,
                    confirmButtonText: 'Enviar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    const Amount = $("#Amount").val();
                    const Date_Start = $("#Date_Start").val();
                    const Date_End = $("#Date_End").val(); 
                    if(Amount != "" && Date_Start != "" && Date_End != ""){
                        const date1 = new Date(Date_Start);
                        const date2 = new Date(Date_End);
                        if(date1>date2){
                            Swal.fire('Fecha de fin es menor que la fecha de inicio', '', 'info') .then((result) => {data_transferThousand ()})
                        }else{
                            TransferWater.setAmount(Amount);
                            TransferWater.setDate_Start(Date_Start);
                            TransferWater.setDate_End(Date_End);
                            addTransferThousand ();
                        }
                    }else{
                        Swal.fire('Debes llenar cada campo del formulario', '', 'info') .then((result) => {data_transferThousand ()})
                    }
                });
    }
    function data_change_location (){
        const html = `
        <div>
            <label for = "Cologne">Colonia</label>
            <input  type="text" maxlength="30"  id="Cologne" class="swal2-input col-5">
        </div>

        <div>
            <label for = "Plot">Lote</label>
            <input  type="text" maxlength="20" id="Plot" class="swal2-input col-5">
        </div>

        <div>
            <label for = "Latitude">Latitúd</label>
            <input  type="text"  id="Latitude" maxlength="20" class="swal2-input col-5">
        </div>
        <div>
            <label for = "Longitude">Longitúd</label>
            <input  type="text"  id="Longitude" maxlength="20" class="swal2-input col-5">
        </div>    
        <div> 
            <label for = "Change_Date" >Fecha</label>
            <input type="Date" id="Change_Date" value="2022-10-29" class="swal2-input">
        </div>
        
        `;
        Swal.fire({
                    title: `Llenando formulario de cambio de ubicación`,
                    html: html  ,
                    showDenyButton: true,
                    confirmButtonText: 'Enviar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    const Cologne       = $('#Cologne').val();
                    const Plot          = $('#Plot').val();
                    const Longitude     = $('#Longitude').val();
                    const Latitude      = $('#Latitude').val();
                    const Change_Date   = $('#Change_Date').val();
                    const jsonNewUbication  = newUbication(Cologne,Plot,Latitude,Longitude,Change_Date) 

                    if(Cologne==""){
                        Swal.fire('Debes llenar el campo "Colonia"', '', 'info') .then((result) => {data_change_location ()})
                    }else if(Plot==""){
                        Swal.fire('Debes llenar el campo "Plot"', '', 'info') .then((result) => {data_change_location ()})    
                    }else{
                        confirmChange(previousUbication(),jsonNewUbication)
                    }
                   
                });
    }
    const newUbication = (Cologne,Plot,Latitude,Longitude,Change_Date) => {
        return {
            'Title_Id'  : $("#Title_Id").val()  ,
            'Cologne'   : Cologne,
            'Plot'      : Plot,
            'Latitude'  : Latitude,
            'Longitude' : Longitude,
            'Change_Date' : Change_Date
        };
    }
    const setPreviousUbication = (Cologne,Plot,Latitude,Longitude) => {
        
            $('#Input-Cologne').val(Cologne)   
            $('#Input-Plot').val(Plot)
            $('#Input-Latitude').val(Latitude)
            $('#Input-Longitude').val(Longitude)
         

            $('#Span-Cologne').html(`Colonia: <b>${Cologne}</b>`)   
            $('#Span-Plot').html(`Lote: <b>${Plot}</b>`)
            $('#Span-Latitude').html(`Latitúd: <b>${Latitude}</b>`)
            $('#Span-Longitude').html(`Longitúd: <b>${Longitude}</b>`)
            
       
    }
    function previousUbication () {
        const Cologne = $('#Input-Cologne').val()   
        const Plot    =$('#Input-Plot').val()
        const Latitude   = $('#Input-Latitude').val()
        const Longitude =  $('#Input-Longitude').val()
        return {
            'Cologne'   : Cologne,
            'Plot'      : Plot,
            'Latitude'  : Latitude,
            'Longitude' : Longitude,
        };
    }
    function confirmChange(actual,news){
       const html =` <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col"></th>
                <th scope="col">Anterior</th>
                <th scope="col">Nueva</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Colonia</th>
                    <td>${actual.Cologne}</td>
                    <td>${news.Cologne}</td>
                </tr>
                <tr>
                    <th scope="row">Lote</th>
                    <td>${actual.Plot}</td>
                    <td>${news.Plot}</td>
                </tr>
                <tr>
                    <th scope="row">Longitúd</th>
                    <td>${actual.Longitude}</td>
                    <td>${news.Longitude}</td>
                </tr>
                    <th scope="row">Latitúd</th>
                    <td>${actual.Latitude}</td>
                    <td>${news.Latitude}</td>
                </tr>
                    <th scope="row">Fecha</th>
                    <td colspan="2">${formatDate(news.Change_Date)}</td>
                </tr>

            </tbody>
        </table>`
                    
        Swal.fire({
                    title: `Confirmar cambio de ubicación`,
                    html: html  ,
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    addNewUbicaction(news)
                });
    }
    function addNewUbicaction(ubication){
        $.ajax({
            url : `${link.Server}changeUbicationTitle.php`,
            data : ubication,
            type : 'POST',
            success: data => {
                setPreviousUbication(ubication.Cologne,ubication.Plot,ubication.Latitude,ubication.Longitude)
                setlocation() 
            }
        });
    }
    function alertDropLocation(id){
        const transfer = getLocation(id)
        const html =` <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col"></th>
                <th scope="col">Anterior</th>
                <th scope="col">Nueva</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Colonia</th>
                    <td>${transfer._Cologne1}</td>
                    <td>${transfer._Cologne2}</td>
                </tr>
                <tr>
                    <th scope="row">Lote</th>
                    <td>${transfer._Plot1}</td>
                    <td>${transfer._Plot2}</td>
                </tr>
                <tr>
                    <th scope="row">Longitúd</th>
                    <td>${transfer._Longitude1}</td>
                    <td>${transfer._Longitude2}</td>
                </tr>
                    <th scope="row">Latitúd</th>
                    <td>${transfer._Latitude1}</td>
                    <td>${transfer._Latitude2}</td>
                </tr>
                    <th scope="row">Fecha</th>
                    <td colspan="2">${formatDate(transfer._Change_Date)}</td>
                </tr>

            </tbody>
        </table>`
                    
        Swal.fire({
                    title: `Eliminar cambio de ubicación`,
                    html: html  ,
                    showDenyButton: true,
                    confirmButtonText: 'Confirmar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    
                    dropChange(transfer)
                });
    }
    const formatDate = date =>{
        date = date.split("-");
        const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
        const mes = meses[parseInt(date[1])];
        const year = date[0];
        const day  = date[2];
        return `${day} de ${mes} del ${year}`;
    }
    function alertDropTransferThousand(id){
        const transfer = getTransferThousand(id);
        const html = `
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col"></th>
                <th scope="col">Concede</th>
                <th scope="col">Recibe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">Título</th>
                    <td>${transfer._SetTitleNumber}</td>
                    <td>${transfer._GetTitleNumber}</td>
                </tr>
                <tr>
                <th scope="row">Usuario</th>
                    <td>${transfer._SetName}</td>
                    <td>${transfer._GetName}</td>
                </tr>
                <tr>
                <th scope="row">Fecha de inicio</th>
                    <td colspan="2">${formatDate(transfer._Date_Start)}</td>
                </tr>
                <tr>
                <th scope="row">Fecha de fin</th>
                    <td colspan="2">${formatDate(transfer._Date_End)}</td>
                </tr>
                <tr>
                <th scope="row">Cantidad</th>
                <td colspan="2">${transfer._Amount} millares</td>
              
                </tr>
            </tbody>
        </table>
                    `;
                    Swal.fire({
                    title: `Eliminar transferencia`,
                    html:   html,
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    width: '700px',
                }).then((result) => {
                 if(result.isConfirmed){
                    dropTransferThousand(id);
                 }
                })
    }
    function addTransferThousand(){
        const transfer = jsonTransferThousand();
        const html = `
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col"></th>
                <th scope="col">Concede</th>
                <th scope="col">Recibe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">Título</th>
                    <td>${transfer.SetTitleNumber}</td>
                    <td>${transfer.GetTitleNumber}</td>
                </tr>
                <tr>
                <th scope="row">Usuario</th>
                    <td>${transfer.SetName}</td>
                    <td>${transfer.GetName}</td>
                </tr>
                <tr>
                <th scope="row">Fecha de inicio</th>
                    <td colspan="2">${formatDate(transfer.Date_Start)}</td>
                </tr>
                <tr>
                <th scope="row">Fecha de fin</th>
                    <td colspan="2">${formatDate(transfer.Date_End)}</td>
                </tr>
                <tr>
                <th scope="row">Cantidad</th>
                <td colspan="2">${transfer.Amount} millares</td>
              
                </tr>
            </tbody>
        </table>
                    `;
                    Swal.fire({
                    title: `Confirmar datos de transferencia`,
                    html:   html,
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    width: '700px',
                }).then((result) => {
                 if(result.isConfirmed){
                    transfersThousand();
                 }
                })
    }
    function jsonTransferThousand(){
        const Transfers_Id      = TransferWater.getTransfers_Id();
        const Date_Start        = TransferWater.getDate_Start();  
        const Date_End          = TransferWater.getDate_End();
        const Amount            = TransferWater.getAmount();
        const SetTitleNumber    = $('#Title_Number').val();
        const GetTitleNumber    = TransferWater.getGetTitleNumber();
        const SetTitleId        = $('#Title_Id').val();
        const GetTitleId        = TransferWater.getGetTitleId();
        const GetName           = TransferWater.getGetName();
        const GetControl_Num    = TransferWater.getGetControl_Num();
        const SetName           = UserPrevious.getFull_Name();
        const SetControl_Num    = UserPrevious.getControl_Num();
      
        return {
                'Transfers_Id'      : Transfers_Id   ,   
                'Date_Start'        : Date_Start    ,     
                'Date_End'          : Date_End      ,        
                'Amount'            : Amount        ,        
                'SetTitleNumber'    : SetTitleNumber, 
                'GetTitleNumber'    : GetTitleNumber, 
                'SetTitleId'        : SetTitleId    ,     
                'GetTitleId'        : GetTitleId    ,    
                'SetName'           : SetName       , 
                'GetName'           : GetName       , 
                'SetControl_Num'    : SetControl_Num, 
                'GetControl_Num'    : GetControl_Num
        };
    }
    const format_id = (id,option) => { // función para tomar y crear ids para los elementos
        var split;
        switch (option){
            case 1:split=id.split("seleccionado_");                     return id+split[1];                 break;
            case 2:split=id.split("cancelar_");                         return split[1];                    break;
            case 3:                                                     return "id_title_seleccionado_"+id; break;
            case 4:                                                     return "cancelar_"+id;              break;
            case 5:                                                     return "input_"+id;                 break;
            case 6:                                                     return "reg_"+id;                   break;
            case 7:                                                     return "user_"+id;                  break;
            case 8:split=id.split("user_");                             return  split[1];                   break;
            case 9:                                                     return "value_input_search_user_"+id; break;
            
            
        }
    }
    function newObjectsTransferTitle(){
        const html = ``
        $("#Username").html("<b>"+UserNew.getFull_Name()+"</b>")
        setTransferTitle();
        UserPrevious = new User.user(UserNew.getControl_Num(),UserNew.getFull_Name());
        UserNew =  new User.user(null,null);
    } 
    const limit = (str,lim) => { 
        str.length = lim < str.length ? lim : str.length;
        return str;
    }
    function dropTransferTitle(TransferTitle){
        const data = { 'Transfers_Id'   :  TransferTitle.getTransfers_Id()};
       $.ajax({
            url : `${link.Server}dropTransferTitle.php`,
            data : data,
            type : 'POST',
            success: data => {
                
                setTransferTitle()
            }
        });
    }   
    function dropChange(TransferTitle){
        const data = { 'Change_Id'   :  TransferTitle.getChange_Id()};
       $.ajax({
            url : `${link.Server}dropChangeLocation.php`,
            data : data,
            type : 'POST',
            success: data => {
                
                setlocation() 
            }
        });
    }
    function dropTransferThousand(id){
        const data = { 'Transfers_Id'   :  id};
        $.ajax({
            url : `${link.Server}dropTransferThousand.php`,
            data : data,
            type : 'POST',
            success: data => {
                           
                setTransferThousand()
            }
        });
    }
    function selecciona_fecha(){
        Swal.fire({
            title: 'Selecciona la fecha',
            confirmButtonText: 'Listo!',
            html: `<input type="date" id="fecha_transfer_title" value="${año}">`

        }).then((result) => {
            if (result.isConfirmed) {
                transfersTitle()
                newObjectsTransferTitle();
            }
            
        });

        const documentYear = document.querySelector("#fecha_transfer_title");
        documentYear.addEventListener("change", e => {
            año = e.target.value;
        });
    }
});
</script>
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
                        <span style="text-align:left;">Inicio: <b><?php echo FormatToFecha($Title[0]['Initial_Date'])?></b></span>
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