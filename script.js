jQuery(document).ready(function(){
	$( "form" ).submit(function( event ) {
		var why = "";
			
		if ( $('#author_name').val() == "" ) {why += "1"; $('#author_name').removeClass("has-success").addClass("has-error");$("span", $('#author_name').parent()).removeClass("hidden").addClass("text-danger"); }
		else{$('#author_name').removeClass("has-error").addClass("has-success");$("span", $('#author_name').parent()).removeClass("text-danger").addClass("hidden");}
		
		
		if ( $('#subject').val() == "") {why += "1"; $('#subject').removeClass("has-success").addClass("has-error");$("span", $('#subject').parent()).removeClass("hidden").addClass("text-danger"); }
		else{$('#subject').removeClass("has-error").addClass("has-success");$("span", $('#subject').parent()).removeClass("text-danger").addClass("hidden");}
		
		if ( $('#message').val() == "") {why += "1"; $('#message').removeClass("has-success").addClass("has-error"); $("span", $('#message').parent()).removeClass("hidden").addClass("text-danger");}
		else{$('#message').removeClass("has-error").addClass("has-success");$("span", $('#message').parent()).removeClass("text-danger").addClass("hidden");}
		
		if ( $('#code_verify').val() == "" ) {why += "1"; $('#code_verify').removeClass("has-success").addClass("has-error");$("span", $('#code_verify').parent()).removeClass("hidden").addClass("text-danger"); }
		else{$('#code_verify').removeClass("has-error").addClass("has-success");$("span", $('#code_verify').parent()).removeClass("text-danger").addClass("hidden"); }
		
		if(why == ""){
			return ;
		}		
		
		event.preventDefault();
	});
});