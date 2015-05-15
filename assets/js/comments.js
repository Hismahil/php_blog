$(document).ready(function(){

  $('#new_comment').submit(function(){
  	if($(this).validate()) {
  		$(this).render_errors();
  		return false;
  	}
  });

});