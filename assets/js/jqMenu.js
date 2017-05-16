$(document).ready(function() {
	var location = window.location; 				//Obtiene la url absoluta
		
	$("ul.treeview-menu li a")
	.filter(function() {

		if( $(this).attr("href") == location )
		{
			$(this).parents("li").addClass('active');
			$(this).parent("li").addClass('active');
		} else {
			$(this).parent("li").removeClass('active')
		}
		
	})
	
});