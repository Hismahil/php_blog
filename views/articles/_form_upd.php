<?php

return
"<div class='panel panel-default'>
  	<div class='panel-heading'>
    	<h3 class='panel-title'>$msg</h3>
  	</div>
  	
  	<form class='form-horizontal' method='$method' action='$action' id='new_article'>
  	$hidden
  	<div class='panel-body'>	
		<div class='form-group'>
			<label for='article_title' class='col-sm-2 control-label'>Title</label>
			<div class='col-sm-10'>
				<input type='text' class='form-control' id='article_title' placeholder='Title' name='article_title' value='$article->title'>
			</div>
		</div>

		<div class='form-group'>
			<label for='article_content' class='col-sm-2 control-label'>Content</label>
			<div class='col-sm-10'>
				<textarea class='form-control' name='article_content' id='article_content'>$article->content</textarea>
			</div>
		</div>

	</div>
	<div class='panel-footer'>
		<button type='submit' class='btn btn-default btn-right' name='commit'>Update</button>
		<a class='btn btn-default btn-right' href='/'>Back</a>
	</div>
</form>
</div>";

?>