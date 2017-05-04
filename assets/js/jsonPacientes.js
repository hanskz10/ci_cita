$(document).ready(function(){
	$('#GridPacientes').DataTable({
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
    $("form#FormPaciente").submit(function()
    {    	
		var Pacientes = new Object();
		Pacientes.idPaciente = $('input#idPaciente').val();
		Pacientes.Nombre = $('input#nombre').val();
		Pacientes.Apellidos = $('input#apellidos').val();
		Pacientes.Email = $('input#email').val();
		Pacientes.Direccion = $('input#direccion').val();
		Pacientes.Celular = $('input#celular').val();
		Pacientes.Estado = $('select#estado').val();
		
		var PacientesJson = JSON.stringify(Pacientes);

		$.ajax({
			url: baseurl + 'pacientes/GuardarPaciente',
			data: { 'PacientesPost': PacientesJson },
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
						window.location = baseurl + 'pacientes';
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

function EliminarPaciente(paciente, id)
{
	confirmar = confirm("Eliminar " + paciente + ", recuerde que una vez eliminado no podrá recuperarlo."); 
	
	if (confirmar)
	{
		var Paciente = new Object();
		Paciente.idPaciente = id;
		var ElimPacienteJson = JSON.stringify(Paciente);

		$.ajax({
			url: baseurl + 'pacientes/EliminarPaciente',
			data: { 'ElimPacientesPost': ElimPacienteJson },
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
						window.location = baseurl + 'pacientes';
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
	window.location = baseurl + 'pacientes';
}