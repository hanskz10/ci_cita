$(document).ready(function(){
	$('#GridUsuarios').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"columnDefs": [{
			"targets": 'no-sort',
			"orderable": false,
		}]
    });

    $("#nombre").focus();
    $("form#FormUsuario").submit(function()
    {
    	var Mail = $('input#validamail').val();
		var idUsuario = $('input#id').val();
		if(Mail == "1" && idUsuario == "")
		{
			$("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Email incorrecto</div>");
			$("#email").focus();
			return false;
		} else {
			var Usuarios = new Object();
			Usuarios.idUsuario = $('input#idUsuario').val();
			Usuarios.Nombre = $('input#nombre').val();
			Usuarios.Apellidos = $('input#apellidos').val();
			Usuarios.Email = $('input#email').val();
			Usuarios.Password1 = $('input#password1').val();
			Usuarios.Password2 = $('input#password2').val();
			Usuarios.idRol = $('select#id_rol').val();
			Usuarios.Estado = $('select#estado').val();
			
			var UsuariosJson = JSON.stringify(Usuarios);

			alert(UsuariosJson);

			$.ajax({
				url: baseurl + 'usuarios/Save',
				data: { 'UsuariosPost': UsuariosJson },
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#mensaje").html("<div class='center1'> <center> <img src='"+ baseurl +"assets/images/loading.svg'> Guardando información...</center></div>");
				},
				//complete:OnComplete,
				success: function(response, textStatus, jqXHR)
				{	
					//console.log(response.log_error);
					
					//console.log(response.success);
					//console.log(response.error_msg);
					
					if (response.success) 
					{
						$("#mensaje").html(response.error_msg);
						//console.log("La solicitud se ha completado correctamente.");
						setTimeout(function(){
							//location.reload();
							window.location = baseurl + 'usuarios';
						}, 3000);
					} else {
						$("#mensaje").html(response.error_msg);
					}
										
				},
				error: function(jqXHR, textStatus, errorThrown){
					$("#mensaje").html('<div class="alert alert-danger text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button> Problemas al guardar la información.</div>');
					console.log('message=:' + jqXHR + ', text status=:' + textStatus + ', error thrown:=' +  errorThrown);
					//console.log("La solicitud a fallado: " + textStatus, errorThrown);
				}
			}); 	

			return false;
		}
			
	});
	
});

function EliminarUsuario(usuario, id, baseurl)
{
	confirmar = confirm("Eliminar a " + usuario + ", recuerde que una vez eliminado no podrá recuperarlo."); 
	
	if (confirmar)
	{
		var Usuario = new Object();
		Usuario.idUsuario = id;
		var ElimUsuarioJson = JSON.stringify(Usuario);

		$.ajax({
			url: baseurl + 'usuarios/deleteuser',
			data: { 'ElimUsuariosPost': ElimUsuarioJson },
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$("#mensaje").html("<div class='center1'> <center> <img src='"+ baseurl +"assets/images/loading.svg'> Guardando información...</center></div>");
			},
			//complete:OnComplete,
			success: function(response, textStatus, jqXHR){
				
				if (response.success) 
				{
					$("#mensaje").html(response.error_msg);
					//console.log("La solicitud se ha completado correctamente.");
					setTimeout(function(){
						//location.reload();
						window.location = baseurl + 'usuarios';
					}, 4000);
				} else {
					$("#mensaje").html(response.error_msg);
				}					
			},
			error: function(jqXHR, textStatus, errorThrown){
				$("#mensaje").html('<div class="alert alert-danger text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button> Problemas al guardar la información.</div>');
				console.log("La solicitud a fallado: " + jqXHR.textStatus, errorThrown);					
			}
		}); 

		return false;

	} else {
	}
	
}

function regresar()
{
	window.location = baseurl + 'usuarios';
}
