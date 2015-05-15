$(document).ready(function(){

  $('#new_user').submit(function(){
  	if($(this).validate()) {
  		$(this).render_errors();
  		return false;
  	}
  });

});