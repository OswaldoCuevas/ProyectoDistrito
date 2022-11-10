
<?php 
include '../Server/conexion.php';
include '../Class/Users.php';
include '../Functions\FunctionDocuments.php';
require ('../Server/validityAdmin.php');
$user_id = $_POST["user_id"];
$_User= new Users();
$User = $_User -> getUser($user_id);
$Titles = $_User -> getTitlesUser($user_id);
$numTitles = count($Titles);

?>
<link rel="stylesheet" href="css/Usuario.css">
<script type="module" >
   import * as link from "./Modules/links.js";
    link.section("<?php echo $_POST['previous']?>","");
    $(".button-show").on('click',function() {
        $(".dashboard-content").load("components/Titulo.php",{"Title_Id":$(this).attr("id"),"previous":"<?php echo $_POST['previous'].'&user='.$user_id?>"});
    })  
</script>
<div class="primary-container">


<div class="container-tables">
		<div class="tables-user " >
            <h2 class="title-tables-user" id="titulosConcesion">Títulos de concesión</h2>
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
                        <td><?php echo isset($title['Initial_Date']) ? FormatToFecha($title['Initial_Date']):"";?></td>
                        <td><?php echo $title['Cologne']; ?></td>
                        <td><?php echo $title['Plot']; ?></td>
                        <td><button  id="<?php echo $title['Title_Id']; ?>" class="btn btn-sm btn-primary button-show"><i class="fa-solid fa-eye"></i></button></td>
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
       <h5><input  class="show-info-user" value="<?php echo $User["Full_Name"]?>" disabled></h5>
        <div class="user-info">  
            <div class="info">
                <h6 class="inf"><span>Celular </span> </h7><h6 class=""><span ><input  class="show-info-user-sub" value="<?php echo $User["Phone_Number"] == null ?"Sin registrar":$User["Phone_Number"];?>" disabled></span> </h6>
                <h6 class="inf"><span>No. títulos </span> </h6><h6 class="" ><span ><?php echo $numTitles ?></span> </h6>
                <h6 class="inf"><span>No. Control </span></h6><h6 class=""><span ><?php echo $User["Control_Num"] == null ?"Sin registrar":$User['Control_Num']?></span> </h6>       
            </div>
            <div class="info">
                <h6 class="inf"><span>RFC </span></h6><h6 class=""><span ><input  class="show-info-user-sub" value="<?php echo $User["RFC"] == null ?"Sin registrar":$User['RFC']?>" disabled></span> </h6>
                <h6 class="inf"><span>Sector </span></h6> <h6 class=""><span ><?php echo $User["Type_User"] == null ?"Sin registrar":$User['Type_User']?></span> </h6>
                <h6 class=" inf"><span>CURP </span></h6><h6 class=""><span ><input  class="show-info-user-sub" value="<?php echo $User["CURP"] == null ?"Sin registrar":$User['CURP']?>" disabled></span> </h6>
    
            </div>        
        </div>
        <hr>
        <h6 class="inf "><span>Correo: </span></h6><h6 class="" style="color:#066de2"><span><input  class="show-info-user-sub" style="align-text:center;color:#066de2" value="<?php echo $User["Email"] == null ?"Sin registrar":$User['Email']?>" disabled></span></h6>
                  
    </div>
</div>
</div>




