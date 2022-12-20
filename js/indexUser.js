$("#span-control-num").hide();
		$("#span-password").hide();
		$("#Enviar").on('click', function(e) {
			Enviar();
		})

		
		$(document).on('keydown','input',function(){
			setTimeout(() => {
			$("#control_num").	val(caraterSpecial(	$("#control_num").val()	));
			$("#password").		val(caraterSpecial(	$("#password").val()	));
			},30);
		});
		function Enviar(){
			const id 		= 	$("#control_num").val();
			const password 	= 	$("#password").val();
			const data 		=	{"Email":id,"Password":password};
			$.ajax({ // crea la tabla con los valores obtenidos de la basede datos
        
				url : `../Server/loginUser.php`,
				data : data,
				type : 'POST',
				beforeSend: function () {
				},
				success: Response => {
					switch (Response){
                       
					case "1": location.href ="user.php";break;
					case "2":
						$("#span-control-num").show();
						$("#span-password").hide();
						$("#span-control-num").html(`Usuario no encontrado`); 
						$("#span-password").html("");
					break;
					case "3":
						$("#span-password").html(`Contraseña incorrecta`);
						$("#span-control-num").html("")
						$("#span-password").show();
						$("#span-control-num").hide();
					break;
					}
				}
			});	
		}

		function caraterSpecial(expersion){
			let expresionNew = expersion.replace(/[^a-zA-Z0-9$+=?@_. ]/i, "")
			return expresionNew == expersion ? expresionNew:caraterSpecial(expresionNew);	
		}