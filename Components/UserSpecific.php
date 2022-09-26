
<?php 
include '../Server/conexion.php';
include '../Class/Users.php';
include '../Functions\FunctionDocuments.php';
$user_id = $_POST["user_id"];
$_User= new Users();
$User = $_User -> getUser($user_id);
$Titles = $_User -> getTitlesUser($user_id);
$numTitles = count($Titles);

?>
<link rel="stylesheet" href="css/UserSpecific.css">
<script type="module" >
   import * as link from "./Modules/links.js";
    link.section("padronUsuarios","");
       
</script>
<div class="container-tables">
		<div class="tables-user " >
            <h2 class=" title-tables-user" id="titulosConcesion">Títulos de concesión</h2>
            <div class="scroll-tables-user ">
            <table class="table table-hover " style=" margin-top: 10px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Número de título</th>
                        <th scope="col">Fecha de inicio</th>
                        <th scope="col">colonia</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($Titles as $title) {
                        ?>
                        <tr>
                        <td><?php echo $title['Title_Number']; ?></td>
                        <td><?php echo FormatToFecha($title['Initial_Date']) ?></td>
                        <td><?php echo $title['Cologne']; ?></td>
                        <td><?php echo $title['Plot']; ?></td>
                        <td><a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                    </tr>
                        <?php
                    }
                    ?>     
                </tbody>
            </table>
        </div>
           
	</div>     
</div>
<div class="user_info">
    <div class="user_img">
        <span><i class="fa-solid fa-user"></i></span>
    </div>
    <div class="user_description">
       <h5><?php echo $User["Full_Name"] ?></h5>
        <div class="container-fluid">  
            <div class="row">
                
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="col-12 inf"><span>Celular </span> </h7><h6 class="col-12"><span ><?php echo $User["Phone_Number"] == null ?"Sin registrar":$User["Phone_Number"]; ?></span> </h6>
                            <h6 class="col-12 inf"><span>No. de títulos </span> </h6><h6 class="col-12" ><span ><?php echo $numTitles ?></span> </h6>
                        </div>
                        <div class="col-6">
                            <h6 class="col-12 inf"><span>RFC: </span></h6><h6 class="col-12"><span ><?php echo $User["RFC"] == null ?"Sin registrar":$User['RFC']?></span> </h6>
                            <h6 class="col-12 inf"><span>Sector </span></h6> <h6 class="col-12"><span ><?php echo $User["Type_User"] == null ?"Sin registrar":$User['Type_User']?></span> </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                    <div class="row correo-trabajador-div">
                    <h6 class="inf col-12"><span>Correo: </span></h6><h6 class="col-12" style="color:#066de2"><span><?php echo $User["Email"] == null ?"Sin registrar":$User['Email']?></span></h6>
                    </div>
                </div>
        </div>
    </div>
</div>





