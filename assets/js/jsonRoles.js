$(document).ready(function(){
	$('#GridRoles').DataTable({
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

	$("#descripcion").focus();
    $("form#FormRol").submit(function()
    {
    	var Mail = $('input#validamail').val();
		var idRol = $('input#idRol').val();
		if(Mail == "1" && idUsuario == "")
		{
			$("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Email incorrecto</div>");
			$("#email").focus();
			return false;
		} else {
			var Roles = new Object();
			Roles.idRol = $('input#idRol').val();
			Roles.Descripcion = $('input#descripcion').val();
			Roles.Estado = $('select#estado').val();
			
			var RolesJson = JSON.stringify(Roles);

			$.ajax({
				url: baseurl + 'roles/GuardarRol',
				data: { 'RolesPost': RolesJson },
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#mensaje").html("<img src='"+ baseurl +"assets/images/loading.svg' /> Guardando información...");
				},
				//complete:OnComplete,
				success: function(response, textStatus, jqXHR)
				{	
					//console.log(response.success);
					//console.log(response.error_msg);
					
					if (response.success) 
					{
						$("#mensaje").html(response.error_msg);
						//console.log("La solicitud se ha completado correctamente.");
						setTimeout(function(){
							//location.reload();
							window.location = baseurl + 'roles';
						}, 3000);
					} else {
						$("#mensaje").html(response.error_msg);
					}
										
				},
				error: function(jqXHR, textStatus, errorThrown){
					$("#mensaje").html('<div class="alert alert-danger text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button> Problemas al guardar la información.</div>');
					console.log('message=:' + jqXHR + ', text status=:' + textStatus + ', error thrown:=' +  errorThrown);					
				}
			}); 	

			return false;
		}
			
	});
	
});

function EliminarRol(rol, id)
{
	confirmar = confirm("Eliminar " + rol + ", recuerde que una vez eliminado no podrá recuperarlo."); 
	
	if (confirmar)
	{
		var Rol = new Object();
		Rol.idRol = id;
		var ElimRolJson = JSON.stringify(Rol);

		$.ajax({
			url: baseurl + 'roles/EliminarRol',
			data: { 'ElimRolesPost': ElimRolJson },
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$("#mensaje").html("<img src='"+ baseurl +"assets/images/loading.svg' /> Eliminando registro...");
			},
			//complete:OnComplete,
			success: function(response, textStatus, jqXHR){
				
				if (response.success) 
				{
					$("#mensaje").html(response.error_msg);
					//console.log("La solicitud se ha completado correctamente.");
					setTimeout(function(){
						//location.reload();
						window.location = baseurl + 'roles';
					}, 4000);
				} else {
					$("#mensaje").html(response.error_msg);
				}					
			},
			error: function(jqXHR, textStatus, errorThrown){
				$("#mensaje").html('<div class="alert alert-danger text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button> Problemas al eliminar registro.</div>');
				//console.log("La solicitud a fallado: " + jqXHR.textStatus, errorThrown);					
			}
		}); 

		return false;

	} else {
	}
	
}

function regresar()
{
	window.location = baseurl + 'roles';
}