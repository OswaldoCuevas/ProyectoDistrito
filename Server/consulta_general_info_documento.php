<?php
	require ('conexion.php');
	require('../Class/Document.php');
	$buscar=$_POST['buscar'];

	if(isset($_POST['buscar']) && $_POST['type'] && isset($_POST['id']))	{
		$buscar=$_POST['buscar'];
		$type = $_POST['type'];	
		$id = $_POST['id'];
	    switch ($type) {
			case "Títulos" : consultaTipoTitulo($id, $buscar); break;
		} 
			
	}
	function consultaTipoTitulo($id, $buscar) {
			$Document = new Document();	
		if($buscar == ""){
			$array = $Document->getTitles($id);
			if($array != 0){
				echo "hola";
			foreach( $array as $registro){
				$Document_Id = $registro['Document_Id'];
				$Info_Id = $registro['Info_Id'];
				$Program = $registro['Program'];         
				$User = $registro['User'];             
				$Type_User = $registro['Type_User'];
				$Cologne = $registro['Cologne'];          
				$Plot = $registro['Plot'];              
				$Title_Number = $registro['Title_Number'];  
				$Validity = $registro['Validity'];          
				$Initial_Date = FormatToFecha($registro['Initial_Date']);      
				$Water_Supply = $registro['Water_Supply'];     
				$Longitude = $registro['Longitude'];         
				$Latitude = $registro['Latitude'];  
				$Tenant = $registro['Tenant'];      
				$Extend = $registro['Extend'];
				$Actualizado = $Document->ShowUpdates($Document_Id,$User,$Cologne,$Plot,$Title_Number,$registro['Initial_Date'],$Water_Supply,$Longitude,$Latitude,$Validity,$Extend);
				$ActualizadoShow =count($Actualizado) == 1 ? "<div class='status_actualizado'> <b> Actualizado" : "<div class='status_no_actualizado'> <b> No actualizado" ;
				echo count($Actualizado) == 1 ? "<tr class='getIdInfo' style='cursor:pointer' id='$Info_Id'>":"<tr class='getIdInfo reg_sin_actualizar' style='cursor:pointer' id='$Info_Id'>";
				echo "
				<th scope='row'>$Program</th><td>";
				echo $ActualizadoShow;
				echo "</b></div></td> 
				<td>$User</td>
				<td>$Title_Number</td>
				<td>$Tenant</td>
				<td>$Type_User</td>
				<td>$Cologne</td>
				<td>$Plot</td>
				<td>$Validity</td>
				<td>$Initial_Date</td>
				<td>$Water_Supply</td>
				<td>$Longitude</td>
				<td>$Latitude</td>
				<td>$Extend</td>
				    <input type='hidden' class='value_input_number' id='input_$Info_Id' value='$Title_Number'>
					
					
    			</tr>
				";
			 
			}	 
			}
		}else{
			$array = $Document->searchTitles($id, $buscar);
			if($array != 0){
				foreach($array as $registro){
					$Document_Id = $registro['Document_Id'];
					$Info_Id = $registro['Info_Id'];
					$Program = $registro['Program'];         
					$User = $registro['User'];             
					$Type_User = $registro['Type_User'];
					$Cologne = $registro['Cologne'];          
					$Plot = $registro['Plot'];              
					$Title_Number = $registro['Title_Number'];  
					$Validity = $registro['Validity'];          
					$Initial_Date = FormatToFecha($registro['Initial_Date']);      
					$Water_Supply = $registro['Water_Supply'];     
					$Longitude = $registro['Longitude'];         
					$Latitude = $registro['Latitude'];  
					$Tenant = $registro['Tenant'];      
					$Extend = $registro['Extend'];
					$Actualizado = $Document->ShowUpdates($Document_Id,$User,$Cologne,$Plot,$Title_Number,$registro['Initial_Date'],$Water_Supply,$Longitude,$Latitude,$Validity,$Extend);
					$ActualizadoShow =count($Actualizado) == 1 ? "<div class='status_actualizado'> <b> Actualizado" : "<div class='status_no_actualizado'> <b> No actualizado" ;
					echo count($Actualizado) == 1 ? "<tr class='getIdInfo' style='cursor:pointer' id='$Info_Id'>":"<tr class='getIdInfo reg_sin_actualizar' style='cursor:pointer' id='$Info_Id'>";
					echo "
					<th scope='row'>$Program</th><td>";
					echo $ActualizadoShow;
					echo "</b></div></td> 
					<td>$User</td>
					<td>$Title_Number</td>
					<td>$Tenant</td>
					<td>$Type_User</td>
					<td>$Cologne</td>
					<td>$Plot</td>
					<td>$Validity</td>
					<td>$Initial_Date</td>
					<td>$Water_Supply</td>
					<td>$Longitude</td>
					<td>$Latitude</td>
					<td>$Extend</td>
						<input type='hidden' class='value_input_number' id='input_$Info_Id' value='$Title_Number'>
						
						
					</tr>
					";
				 
				}
			}
			
		}
	}
		
		
?>
