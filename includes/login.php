<?php
require_once 'init.php';

// Checking if all fields are filled
if (Validate::presence([$_POST['username'], $_POST['password']])) {
	// Sanitizing variables for db
	$username = Sanitizer::sanitize_for_db(trim($_POST['username']));
	$password = Sanitizer::sanitize_for_db($_POST['password']);

	// Session for login username in index.php, so that user does't have to type username again if 
	// password was entered incorrectly
	Session::put('uname', $username);

	// Retrieving hashed password from db
	$query = "SELECT password FROM users WHERE username = '{$username}' LIMIT 1";
	$results = Database::getInstance()->query($query);
	if ($results->num_rows === 1) {
		foreach ($results as $result) {
			$hashed_password = $result['password'];
		}
	}
	$results->free();

	// Compering entered password with hashed password stored in db
	if (password_verify($password, $hashed_password)) {
		$query = "SELECT id, admin FROM users WHERE username = '{$username}'";
		$results = Database::getInstance()->query($query);
		if ($results->num_rows === 1) {
			while ($row = $results->fetch_assoc()) {
				$session_id = $row['id'];
				$admin = $row['admin'];
			}
		}
		Session::put('loged_in', $session_id);
		Session::put('username', $username);
		Session::put('admin', $admin);
		$results->free();
		Database::getInstance()->close();
		redirect_to('../public/private_page.php');
		exit;
	} else {
		Session::put('message', 'username/password do not match');
		redirect_to('../public/index.php');
		exit;
	}

} else {
	redirect_to('../public/index.php');
	exit;
}
redirect_to('../public/index.php');

?>