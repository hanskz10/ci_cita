$(document).ready(function(){
	$('#GridMenu').DataTable({
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
    $("form#FormMenu").submit(function()
    {    	
		var Menu = new Object();
		Menu.idMenu = $('input#idMenu').val();
		Menu.Descripcion = $('input#descripcion').val();
		Menu.Linea = $('select#linea').val();
		Menu.Url = $('input#url').val();
		Menu.Iconos = $('input#iconos').val();
		Menu.Estado = $('select#estado').val();
		
		var MenuJson = JSON.stringify(Menu);

		$.ajax({
			url: baseurl + 'menu/GuardarMenu',
			data: { 'MenuPost': MenuJson },
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
						window.location = baseurl + 'menu';
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

function EliminarMenu(menu, id)
{
	confirmar = confirm("Eliminar " + menu + ", recuerde que una vez eliminado no podrá recuperarlo."); 
	
	if (confirmar)
	{
		var Menu = new Object();
		Menu.idMenu = id;
		var ElimMenuJson = JSON.stringify(Menu);

		$.ajax({
			url: baseurl + 'menu/EliminarMenu',
			data: { 'ElimMenuPost': ElimMenuJson },
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
						window.location = baseurl + 'menu';
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
	window.location = baseurl + 'menu';
}