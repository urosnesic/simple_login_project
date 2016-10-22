<?php
require_once 'init.php';

// Checking if all fields are filled
if (Validate::presence([$_POST['fullName'], $_POST['username'], $_POST['password'], $_POST['password_again']])) {

	// Checking if username is not longer then 20 chars because of db parameter
	if (!Validate::max_length($_POST['username'])) {
		Session::put('user_length', 'username can be 20 chars max.');
		redirect_to('../public/index.php');
		exit;
	}

	// Checking if password have more then 7 chars
	if (!Validate::min_length($_POST['password'])) {
		Session::put('pass_length', 'password must be 8 chars long at least');
		redirect_to('../public/index.php');
		exit;
	}

	$fullName = Sanitizer::sanitize_for_db(trim($_POST['fullName']));
	// Session for signup fullName in index.php, so that user does't have to type fullName again
	Session::put('full_name', $fullName);

	// Checking if password is typed exactly the same twice
	if (!Validate::is_it_equal($_POST['password'], $_POST['password_again'])) {
		Session::put('equal', 'Password and Confirm Password must be equal.');
		redirect_to('../public/index.php');
		exit;
	}

	// Sanitizing variables for db
	$username = Sanitizer::sanitize_for_db(trim($_POST['username']));
	$password = Sanitizer::sanitize_for_db($_POST['password']);

	

	// Checking if username is already taken
	$query = "SELECT username FROM users WHERE username = '{$username}'";
	$result = Database::getInstance()->query($query);
	if ($result->num_rows === 0) { // if not taken:
		// Hashing password and signing up new user (from signup form user can't become admin, thus zero as a last
		// parameter)
		$hashed_password = password_hash($password, PASSWORD_BCRYPT);
		$query  = "INSERT INTO users (name, username, password, joined, admin) ";
		$query .= "VALUES ('{$fullName}', '{$username}', '{$hashed_password}', NOW(), 0)";
		Database::getInstance()->query($query);
		if (Database::getInstance()->affected_rows === 1) {
			Session::put('success', 'You have sign in successfully.');
			Database::getInstance()->close();
			redirect_to('../public/index.php');
			exit;
		}
	} else {
		Session::put('not_unique', 'username already exist!');
		Database::getInstance()->close();
		redirect_to('../public/index.php');
		exit;
	}
} else {
	Session::put('missingInfo', 'All fields must be filled.');
	redirect_to('../public/index.php');
	exit;
}

redirect_to('../public/index.php');

?>