<?php
require_once 'init.php';

Session::delete('loged_in');
Session::delete('username');
Session::delete('uname');

redirect_to('../public/index.php');
exit;
?>