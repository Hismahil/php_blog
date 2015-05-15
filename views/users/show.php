<?php

return 
"<div class='panel panel-default'>
  <div class='panel-heading'>
    <h3 class='panel-title'>User description</h3>
  </div>
  <div class='panel-body'>
	<ul class='list-group'>
	  <li class='list-group-item'>ID: $user->id</li>
	  <li class='list-group-item'>Name: $user->name</li>
	  <li class='list-group-item'>E-mail: $user->email</li>
	  <li class='list-group-item'>Password: $user->password</li>
	  <li class='list-group-item'>Role: $user->role_id</li>
	  <li class='list-group-item'>Created At: $user->created_at</li>
	  <li class='list-group-item'>Updated At: $user->updated_at</li>
	</ul>
  </div>
  <div class='panel-footer'>
  	<a href='/users' class='btn btn-default'>Back</a>
  </div>
</div>";

?>