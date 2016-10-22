<?php
require_once 'init.php';

if (!Session::exists('loged_in')) {
	redirect_to('../public/index.php');
	exit;
}

if (Session::get('admin') == 0) {
	die('Nope');
	exit;
}

if (isset($_POST['username'])) {
	$username = Sanitizer::sanitize_for_db(trim($_POST['username']));
	$query = "SELECT id, name, joined, admin FROM users WHERE username = '{$username}' LIMIT 1";
	$results = Database::getInstance()->query($query);
	if ($results->num_rows == 1) {
		foreach ($results as $result) {
			$id = $result['id'];
			$name = $result['name'];
			$joined = $result['joined'];
			$admin = $result['admin'];
		}
		$x = true;
	} else {
		Session::put('no_user', "User does not exist or username spelled wrong.");
		$x = false; // Used not to get notices in box div table if random chars are entered
	}
	$results->free();
}

if (isset($_POST['newAdmin'])) {
	$newAdmin = Sanitizer::sanitize_for_db(trim($_POST['newAdmin']));
	$query = "SELECT username FROM users WHERE username = '{$newAdmin}' LIMIT 1";
	$results = Database::getInstance()->query($query);
	if ($results->num_rows == 1) {
		$query = "UPDATE users SET admin = 1 WHERE username = '{$newAdmin}'";
		Database::getInstance()->query($query);
	} else {
		Session::put('no_user', "User does not exist or username spelled wrong.");
	}
	$results->free();
}

if (isset($_POST['delete'])) {
	$delete = Sanitizer::sanitize_for_db(trim($_POST['delete']));
	$query = "SELECT username FROM users WHERE username = '{$delete}' LIMIT 1";
	$results = Database::getInstance()->query($query);
	if ($results->num_rows == 1) {
		$query = "DELETE FROM users WHERE username = '{$delete}'";
		Database::getInstance()->query($query);
	} else {
		Session::put('no_user', "User does not exist or username spelled wrong.");
	}
	$results->free();
}


echo 'admin: ' . Session::get('username') . '<br />';
Database::getInstance()->close();
echo "<a href=\"../public/private_page.php\">return</a>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Admin page</title>
	<link type="text/css" rel="stylesheet" href="../public/styles/style.css" />
</head>
<body>

<div>
	<form action="" method="POST">
		<p>Retrieve data for:<br />
		   <input type="text" name="username" placeholder="username of user" autocomplete="off" />
		   <input type="submit" value="Retrieve" /></p>
	</form>
	

	<form action="" method="POST">
		<p>Create new admin:<br />
		   <input type="text" name="newAdmin" placeholder="username of user" autocomplete="off" />
		   <input type="submit" value="Create" /></p>
	</form>
	

	<form action="" method="POST">
		<p style="color:red">Delete user:<br />
		   <input type="text" name="delete" placeholder="username of user" autocomplete="off" />
		   <input type="submit" value="Delete!" /></p>
	</form>
	<?php
		if (Session::exists('no_user')) {
			echo Session::get('no_user');
			Session::delete('no_user');
		}
	?>
</div>

<div id="box">
	<?php 
	if (!empty($_POST['username']) && $x) {
		echo "<table>";
			echo "<tr>";
				echo "<td>user id:</td><td>" . $id . "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>user's name:</td><td>" . htmlentities($name) . "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>user joined:</td><td>" . htmlentities($joined) . "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>admin:</td><td>" . ($admin == 0 ? 'no' : 'yes') . "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>usernaem:</td><td>" . htmlentities($username) . "</td>";
			echo "</tr>";
		echo "</table>";
	}
	?>
</div>

</body>
</html>