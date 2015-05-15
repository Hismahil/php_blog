<?php
	return "<form class='form-signin' method='$method' action='$action' id='new_user'>
        <h2 class='form-signin-heading'>$msg</h2>
        <label for='inputName' class='sr-only'>Name</label>
        <input type='text' id='inputName' class='form-control' placeholder='Name' required autofocus name='user_name'>
        <label for='inputEmail' class='sr-only'>Email address</label>
        <input type='email' id='inputEmail' class='form-control' placeholder='Email address' name='user_email' required autofocus>
        <label for='inputPassword' class='sr-only'>Password</label>
        <input type='password' id='inputPassword' class='form-control' placeholder='Password' name='user_password' required>
        <div class='checkbox'>
          <label>
            <input type='checkbox' value='remember-me'> Remember me
          </label>
        </div>
        <button class='btn btn-lg btn-primary btn-block' type='submit' name='commit'>Sign in</button>
      </form>";
?>