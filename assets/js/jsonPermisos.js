$(document).ready(function(){
	$('#GridPermisos').DataTable({
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

	$("form#FormPermiso").submit(function()
    {	
		var Permisos = new Object();
		Permisos.idRol = $('input#idRol').val();
		Permisos.Menu = $('select#menu').val();
		
		var PermisosJson = JSON.stringify(Permisos);

		$.ajax({
			url: baseurl + 'permisos/GuardarPermiso',
			data: { 'PermisosPost': PermisosJson },
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$("#mensaje").html("<img src='"+ baseurl +"assets/images/loading.svg' /> Guardando información...");
			},
			//complete:OnComplete,
			success: function(response, textStatus, jqXHR)
			{
				if (response.success) 
				{
					$("#mensaje").html(response.error_msg);
					setTimeout(function(){
						//location.reload();
						window.location = baseurl + 'permisos';
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

function regresar()
{
	window.location = baseurl + 'permisos';
}