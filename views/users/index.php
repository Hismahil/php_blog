<?php

$body = "";

foreach ($users as $user) {
	$admin = $user->role_id == 1 ? 'NORMAL' : 'ADMIN';
	$active = $user->active ? 'true' : 'false';

	$body .= "<tr>
		<td>$user->id</td>
		<td>$user->name</td>
		<td>$user->email</td>
		<td>$user->password</td>
		<td>$admin</td>
		<td>$active</td>
		<td>$user->created_at</td>
		<td>$user->updated_at</td>
		<td>
			<a class='btn btn-default' href='/users/$user->id'>
  				<span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>
			</a>
		</td>
		<td>
			<a class='btn btn-default' href='/users/$user->id/edit'>
  				<span class='glyphicon glyphicon-file' aria-hidden='true'></span>
			</a>
		</td>
		<td>
			<a class='btn btn-default' href='/users/delete/$user->id'>
  				<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
			</a>
		</td>
	</tr>";

}

return
"<div class='panel panel-default'>
  <div class='panel-heading'>
    <h3 class='panel-title'>List of Users</h3>
  </div>
  <div class='panel-body'>
	  <table class='table table-hover'>
			<thead>
				<th>ID</th>
				<th>User Name</th>
				<th>E-mail</th>
				<th>Password</th>
				<th>Role</th>
				<th>Active</th>
				<th>Created At</th>
				<th>Updated At</th>
				<th></th>
				<th></th>
				<th></th>
			</thead>
			<tbody>
				$body
			</tbody>
		</table>
	</div>
	<div class='panel-footer'></div>
</div>"

?>