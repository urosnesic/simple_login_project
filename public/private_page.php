<?php
require_once '../includes/init.php';

if (!Session::exists('loged_in')) {
	redirect_to('index.php');
	exit;
}

require_once '../includes/layouts/header.php';
?>

<div class="container-fluid">
	<div class="row" id="userinfo">
		<div class="col-xs-4">
			<p class="navbar-text lead" id="paramname"><b><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			<?php echo "  " . Session::get('username'); ?></b> |
			<a id="logoutAnchor" href="../includes/change_password.php" class="navbar-link">Change password</a> |
			<a id="logoutAnchor" href="../includes/logout.php" class="navbar-link">Log out</a>
			</p>
		</div>
		<div class="col-xs-6"></div>
		<div class="col-xs-2">  <!-- If user is admin, here will be new options -->
			<?php
				if (Session::get('admin') == 1) {
					echo "<form method=\"POST\" action=\"../includes/admin.php\" id=\"adminForm\">";
					echo "<input class=\"btn btn-danger\" type=\"submit\" value=\"Admin\" />";
					echo "</form>";
				}
			?>
		</div>
	</div>
	
</div>

</body>
</html>