<?php
session_start();

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'main_admin');
define('DB_PASS', 'sifra');
define('DB_NAME', 'simple_login_db');

spl_autoload_register(function($class) {
	require_once "classes/{$class}.php";
});

require_once 'functions.php';
?>