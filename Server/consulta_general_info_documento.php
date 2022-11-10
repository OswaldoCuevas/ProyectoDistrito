<?php
	require ('conexion.php');
	require('../Class/Document.php');
	require ('validityAdmin.php');

	$buscar=$_POST['buscar'];

	if(isset($_POST['buscar']) && $_POST['type'] && isset($_POST['id']))	{
		$buscar=$_POST['buscar'];
		$type = $_POST['type'];	
		$id = $_POST['id'];
	    switch ($type) {
			case "Títulos" : consultaTipoTitulo($id, $buscar); break;
			case "Padrón de usuarios" : consultaTipoUsuario($id, $buscar); break;
			case "Inversiones": consultaTipoInversion($id, $buscar); break;
		} 
			
	}
	function consultaTipoTitulo($id, $buscar) {
			$Document = new Document();	
		if($buscar == ""){
			$array = $Document->getTitles($id);
			if($array != 0){
			foreach( $array as $registro){
				title($registro,$Document);
			 
			}	 
			}
		}else{
			$array = $Document->searchTitles($id, $buscar);
			if($array != 0){
				foreach($array as $registro){
					title($registro,$Document);
				}
			}
			
		}
	}

	function consultaTipoUsuario($id, $buscar) {
		$Document = new Document();	
		if($buscar == ""){
			$array = $Document->getUsers($id);
			if($array != 0){
				
			foreach( $array as $registro){
				user($registro,$Document);
			
			}	 
			}
		}else{
			$array = $Document->searchUsers($id, $buscar);
			if($array != 0){
				foreach($array as $registro){
					user($registro,$Document);
				}
			}
			
		}
	}

	function consultaTipoInversion($id, $buscar) {
		$Document = new Document();	
		if($buscar == ""){
			$array = $Document->getInvestments($id);
			if($array != 0){
			foreach( $array as $registro){
				inversion($registro,$Document);
			
			}	 
			}
		}else{
			$array = $Document->searchInvestments($id, $buscar);
			if($array != 0){
				foreach($array as $registro){
					inversion($registro,$Document);
				}
			}
			
		}
	}

	function title($registro,$Document){
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
		$Actualizado = $Document->ShowUpdatesTitle($Document_Id,$User,$Cologne,$Plot,$Title_Number,$registro['Initial_Date'],$Water_Supply,$Longitude,$Latitude,$Validity,$Extend);
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

	function user($registro,$Document){
		$Document_Id = $registro['Document_Id'];
		$Info_Id = $registro['Info_Id'];
		$Program = $registro['Program'];         
		$User = $registro['User'];             
		$Phone_Number = $registro['Phone_Number'];
		$RFC = $registro['RFC'];
		$CURP = $registro['CURP'];
		$Email = $registro['Email'];
		$Actualizado = $Document->ShowUpdatesUser($Document_Id,$User,$Phone_Number,$Email,$RFC,$CURP);
		$ActualizadoShow =count($Actualizado) == 1 ? "<div class='status_actualizado'> <b> Actualizado" : "<div class='status_no_actualizado'> <b> No actualizado" ;
		echo count($Actualizado) == 1 ? "<tr class='getIdInfo' style='cursor:pointer' id='$Info_Id'>":"<tr class='getIdInfo reg_sin_actualizar' style='cursor:pointer' id='$Info_Id'>";
		echo "
		<th scope='row'>$Program</th><td>";
		echo $ActualizadoShow;
		echo "</b></div></td> 
		<td>$User</td>
		<td>$RFC</td>
		<td>$CURP</td>
		<td>$Phone_Number</td>
		<td>$Email</td>
		<input type='hidden' class='value_input_number' id='name_$Info_Id' value='$User'>	
			
			
		</tr>
		";
		//<input type='hidden' class='value_input_number' id='input_$Info_Id' value='$Title_Number'>
	}
	function inversion($registro,$Document){
		$Document_Id = $registro['Document_Id'];
		$Info_Id = $registro['Info_Id'];
		$Program = $registro['Program'];         
		$User = $registro['User'];             
		$Cologne = $registro['Cologne'];
		$Plot = $registro['Plot'];
		$System_ = $registro['System_'];
		$Hectare = $registro['Hectare'];
		$Investments_Date = $registro['Investments_Date'];

		$Actualizado = $Document->ShowUpdatesInvestments($User,$Cologne,$Plot,$Hectare,$Investments_Date,$System_);
		$ActualizadoShow =count($Actualizado) == 1 ? "<div class='status_actualizado'> <b> Actualizado" : "<div class='status_no_actualizado'> <b> No actualizado" ;
		echo count($Actualizado) == 1 ? "<tr class='getIdInfo' style='cursor:pointer' id='$Info_Id'>":"<tr class='getIdInfo reg_sin_actualizar' style='cursor:pointer' id='$Info_Id'>";
		echo "
		<th scope='row'>$Program</th><td>";
		echo $ActualizadoShow;
		echo "</b></div></td> 
		<td>$User</td>
		<td>$Cologne</td>
		<td>$Plot</td>
		<td>$System_</td>
		<td>$Hectare</td>
		<td>$Investments_Date</td>
		<input type='hidden' class='value_input_number' id='name_$Info_Id' value='$User'>	
			
			
		</tr>
		";
		//<input type='hidden' class='value_input_number' id='input_$Info_Id' value='$Title_Number'>
	}
		
?>
