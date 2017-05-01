$(document).ready(function(){
	$('#GridEspecialidades').DataTable({
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
    $("form#FormEspecialidad").submit(function()
    {    	
		var Especialidades = new Object();
		Especialidades.idEspecialidad = $('input#idEspecialidad').val();
		Especialidades.Descripcion = $('input#descripcion').val();
		Especialidades.Estado = $('select#estado').val();
		
		var EspecialidadesJson = JSON.stringify(Especialidades);

		$.ajax({
			url: baseurl + 'especialidades/GuardarEspecialidad',
			data: { 'EspecialidadesPost': EspecialidadesJson },
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
						window.location = baseurl + 'especialidades';
					}, 3000);
				} else {
					$("#mensaje").html(response.error_msg);
				}
									
			},
			error: function(jqXHR, textStatus, errorThrown){
				$("#mensaje").html('<div class="alert alert-danger text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button> Problemas al guardar la información.</div>');
				//console.log('message=:' + jqXHR + ', text status=:' + textStatus + ', error thrown:=' +  errorThrown);					
			}
		}); 	

		return false;		
			
	});
	
});

function EliminarEspecialidad(especialidad, id)
{
	confirmar = confirm("Eliminar " + especialidad + ", recuerde que una vez eliminado no podrá recuperarlo."); 
	
	if (confirmar)
	{
		var Especialidad = new Object();
		Especialidad.idEspecialidad = id;
		var ElimEspecialidadJson = JSON.stringify(Especialidad);

		$.ajax({
			url: baseurl + 'especialidades/EliminarEspecialidad',
			data: { 'ElimEspecialidadesPost': ElimEspecialidadJson },
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
						window.location = baseurl + 'especialidades';
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
	window.location = baseurl + 'especialidades';
}