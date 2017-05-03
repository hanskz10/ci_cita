$(document).ready(function(){
	$(".cmbEspecialidad").select2();

	$('#GridDoctores').DataTable({
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
    $("form#FormDoctor").submit(function()
    {    	
		var Doctores = new Object();
		Doctores.idDoctor = $('input#idDoctor').val();
		Doctores.Nombre = $('input#nombre').val();
		Doctores.Apellidos = $('input#apellidos').val();
		Doctores.idEspecialidad = $('select#especialidad').val();
		Doctores.Email = $('input#email').val();
		Doctores.Direccion = $('input#direccion').val();
		Doctores.Celular = $('input#celular').val();
		Doctores.Estado = $('select#estado').val();
		
		var DoctoresJson = JSON.stringify(Doctores);

		$.ajax({
			url: baseurl + 'doctores/GuardarDoctor',
			data: { 'DoctoresPost': DoctoresJson },
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
						window.location = baseurl + 'doctores';
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

function EliminarDoctor(doctor, id)
{
	confirmar = confirm("Eliminar " + doctor + ", recuerde que una vez eliminado no podrá recuperarlo."); 
	
	if (confirmar)
	{
		var Doctor = new Object();
		Doctor.idDoctor = id;
		var ElimDoctorJson = JSON.stringify(Doctor);

		$.ajax({
			url: baseurl + 'doctores/EliminarDoctor',
			data: { 'ElimDoctoresPost': ElimDoctorJson },
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
						window.location = baseurl + 'doctores';
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
	window.location = baseurl + 'doctores';
}