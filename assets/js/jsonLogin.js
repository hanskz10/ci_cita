$(document).ready(function(){
	//Guardamos Formulario
	$("#email").focus();
	$("form#loginform").submit(function()
	{ 
		var Mail  = $('input#validamail').val();
		if(Mail == "1"){
			$("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Email incorrecto</div>");
			$("#email").focus();
			return false;
		}else{
			var Login = new Object();
			Login.Email = $('input#email').val();
			Login.Password  = $('input#password').val();
			var DatosJson = JSON.stringify(Login);

			$.ajax({
				url: baseurl + 'home/ValidaAcceso',
				data: { 'LoginPost': DatosJson },
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#mensaje").append("<div class='center1'> <center> <img src='"+ baseurl +"assets/images/loading.svg'> Iniciando sessión...</center></div>");
				},
				//complete:OnComplete,
				success: function(response, textStatus, jqXHR){
					//console.log(response.success);
					//console.log(response.error_msg);
					if (response.success) 
					{
						$("#mensaje").html(response.error_msg);
						//console.log("La solicitud se ha completado correctamente.");
						setTimeout(function(){
							location.reload();
						}, 2000);
					} else {
						$("#mensaje").html(response.error_msg);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					$("#mensaje").html('<div class="alert alert-danger text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button> Problemas al iniciar sesión.</div>');
					//console.log("La solicitud a fallado: " + textStatus, errorThrown);					
				}
			}); 

			return false;
		}
	}); 

});