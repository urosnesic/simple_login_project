<?php
require_once 'init.php';

if (!Session::exists('loged_in')) {
	redirect_to('../public/index.php');
	exit;
}

if (!empty($_POST['password']) && !empty($_POST['password_again'])) {
	if (Validate::min_length($_POST['password'])) {
		if (Validate::is_it_equal($_POST['password'], $_POST['password_again'])) {
				$password = Sanitizer::sanitize_for_db($_POST['password']);
				$username = Session::get('username');
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);
				$query = "UPDATE users SET password = '{$hashed_password}' WHERE username = '{$username}'";
				Database::getInstance()->query($query);
				if (Database::getInstance()->affected_rows === 1) {
					Session::put('change', 'Password successfully changed');
					Database::getInstance()->close();
				}
			} else {
				Session::put('equal', 'Password and Confirm Password must be equal.');
			}
	} else {
		Session::put('pass_length', 'password must be 8 chars long at least');
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Change password</title>
</head>
<body>
	<form action="" method="POST">
		<p>Type new password:<br />
		   <input type="password" name="password" />
		   <span style="display: block; color: red;">
		   <?php if (Session::exists('pass_length')) { 
		   			echo Session::get('pass_length');
			   	 	Session::delete('pass_length');		
			     } 
			?></span></p>
		<p>Confirm new password:<br />
		   <input type="password" name="password_again" />
		   <span style="display: block; color: red;">
		   <?php if (Session::exists('equal')) { 
		   		 	echo Session::get('equal');
			   	 	Session::delete('equal'); 
			     } 
			?></span></p>
		<input type="submit" value="Change password" /><br />
		<span style="display: block; color: green;">
			<?php
				if (Session::exists('change')) {
					echo Session::get('change');
					Session::delete('change');
				}
			?>
		</span>  
	</form><br /> 
	<a href="../public/private_page.php">Return</a>
</body>
</html>