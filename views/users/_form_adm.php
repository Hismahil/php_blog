<?php

return
"<div class='panel panel-default'>
  	<div class='panel-heading'>
    	<h3 class='panel-title'>Edit User</h3>
  	</div>
  	
  	<form class='form-horizontal' method='$method' action='$action' id='new_user'>
  	$hidden
  	<div class='panel-body'>	
		<div class='form-group'>
			<label for='user_name' class='col-sm-2 control-label'>Name</label>
			<div class='col-sm-10'>
				<input type='text' class='form-control' id='user_name' placeholder='Name' name='user_name' value=$user->name>
				<span class='help-block'></span>
			</div>
		</div>

		<div class='form-group'>
			<label for='user_email' class='col-sm-2 control-label'>Email</label>
			<div class='col-sm-10'>
				<input type='email' class='form-control' id='user_email' name='user_email' placeholder='E-mail' value=$user->email>
				<span class='help-block'></span>
			</div>
		</div>

		<div class='form-group'>
			<label for='user_password' class='col-sm-2 control-label'>Password</label>
			<div class='col-sm-10'>
				<input type='password' class='form-control' id='user_password' name='user_password' placeholder='Password'>
				<span class='help-block'></span>
			</div>
		</div>

		<div class='form-group'>
			<label for='user_role_id' class='col-sm-2 control-label'>Role</label>
			<div class='col-sm-10'>
				<select class='form-control' name='user_role_id'>
					<option value='1'>Normal</option>
					<option value='2'>Admin</option>
				</select>
			</div>
		</div>
	</div>
	<div class='panel-footer'>
		<button type='submit' class='btn btn-default btn-right' name='commit'>Update</button>
		<a class='btn btn-default btn-right' href='/users'>Back</a>
	</div>
</form>
</div>";