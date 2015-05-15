$(document).ready(function(){

  $('#new_article').submit(function(){

  	if($(this).validate()) {
  		$(this).render_errors();
  		return false;
  	}
  });

});