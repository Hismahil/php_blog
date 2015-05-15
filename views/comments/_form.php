<?php

return
"
<form class='form-horizontal' method='$method' action='$action' id='new_comment'>
	<input type='hidden' name='article_id' value='$article->id' />
	<div class='panel-body'>	
		<div class='form-group'>
			<label for='user_name' class='col-sm-2 control-label'>User name</label>
			<div class='col-sm-10'>
				<input type='text' class='form-control' id='user_name' placeholder='User Name' name='user_name'>
				<span class='help-block'></span>
			</div>
		</div>

		<div class='form-group'>
			<label for='comment' class='col-sm-2 control-label'>Comment</label>
			<div class='col-sm-10'>
				<textarea class='form-control' name='comment' id='comment'></textarea>
				<span class='help-block'></span>
			</div>
		</div>

	</div>

	<div class='panel-footer'>
		<button type='submit' class='btn btn-default btn-right' name='commit'>Save</button>
		<a class='btn btn-default btn-right' href='/'>Back</a>
	</div>
</form>";

?>