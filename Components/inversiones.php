<embed src=
"docs/plano.pdf" 
               width="90%"
               height="90%">
         <!-- <?php
        //  include '../Server/conexion.php';
        //  $Conexion = new Conexion();//no debes poner esto
        //  $Conexion -> Conexion();//no debes poner esto
        //  $sistema = $Conexion -> sistema;//no debes poner esto



        //  $consulta = mysqli_query($sistema,"SELECT * FROM Padron_de_Usuarios");//sistema es tu variable de conexion
        //  //$numero_registros = mysqli_num_rows($consulta);//numero de registros
        //  $registros_de_la_Tabla = mysqli_fetch_assoc($consulta);//
         
         ?>
               <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($registros_de_la_Tabla as $registro){?>
    <tr>
      <th scope="row"><?php echo $registro["Full_Name"]?></th>
      <td >Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <?php }?>
  </tbody>
</table> -->