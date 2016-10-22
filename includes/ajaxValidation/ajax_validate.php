<?php
require_once '../init.php';

$username = $_POST['username'];
$username = Sanitizer::sanitize_for_db(trim($username));

$query = "SELECT username FROM users WHERE username = '{$username}'";
$result = Database::getInstance()->query($query);
if ($result->num_rows === 0) {
	echo 1;
} else {
	echo 2;
}
$result->free();
Database::getInstance()->close();
exit;

?>