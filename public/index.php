<?php
require_once '../includes/init.php';
require_once '../includes/layouts/header.php';
?>

<div class="container-fluid" id="container">
	
	<div class="row well" id="nav">
		<div class="col-xs-3">
			<h1>Logo</h1>
		</div>
		<div class="col-xs-7">
			<h2>Simple login project</h2>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-primary" id="loginBtn">Log in</button>
			<button class="btn btn-primary" id="signupBtn">Sign up</button>
		</div>
	</div>

	<div class="row" id="main">			<!-- Beginning of main div -->
		<div class="col-xs-3">
			<div class="list-group">  <!-- Have no functionality, just a filler -->
				<a href="#" class="list-group-item">item 1</a><br />
				<a href="#" class="list-group-item">item 2</a><br />
				<a href="#" class="list-group-item">item 3</a><br />
				<a href="#" class="list-group-item">item 4</a><br />
				<a href="#" class="list-group-item">item 5</a>
			</div>		<!-- end -->
		</div>
		<div class="col-xs-7">
			<div class="jumbotron">
				<p><img src="images/1.jpg" alt="random pictures of nature" title="pictures of beautiful nature" height="250" width="250" id="nature" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget elit ullamcorper, ultricies lectus vitae, egestas magna. Suspendisse et rutrum nisl. Aenean eu nibh id dolor tempor luctus a sed neque. Curabitur aliquet varius nisi fringilla consectetur. Phasellus vitae felis sed leo tempus ullamcorper nec ut diam. Duis mattis lectus a eros lobortis, at feugiat orci volutpat. Ut dictum ligula imperdiet nunc finibus placerat. Nulla in massa mi. Vivamus mollis accumsan orci, vel imperdiet nibh mattis eget. Nunc tincidunt dapibus turpis, non aliquet massa placerat at. Quisque at rutrum arcu. Praesent imperdiet viverra enim. Aliquam mollis vel sem nec hendrerit. In ante nibh, semper gravida pulvinar sit amet, auctor vel erat. Cras blandit enim erat, eget porta lorem finibus ut. Nunc vulputate eget ante ut pretium.</p>
				<p>Etiam quis consequat nisi, in ullamcorper arcu. Duis nec posuere nisi. Nullam accumsan, ex ut cursus aliquam, sapien felis vulputate tellus, eu imperdiet sem diam eu felis. Integer rhoncus consectetur dignissim. Maecenas diam nisi, imperdiet quis ultrices sollicitudin, accumsan sit amet metus. Nam feugiat, tortor vitae fermentum pulvinar, diam mi placerat erat, quis sollicitudin nisl leo fermentum mauris. Nam ante massa, imperdiet ac scelerisque eu, condimentum in felis. Suspendisse vitae ligula velit. Donec non mollis nulla. Nam porta lorem quis nunc porta pharetra. Etiam lacinia mi sit amet luctus sodales. Aliquam sit amet nisl in felis maximus dapibus ut ac ipsum. Vestibulum aliquet congue egestas.</p>
			</div>
		</div>
		<div class="col-xs-2">

			<div id="loginForm">		<!-- Beginning of loginForm div -->
				<form action="../includes/login.php" method="POST">
					<p>Username:<br />
					   <input type="text" name="username" autocomplete="off" placeholder="Username" autofocus value="<?php  if (Session::exists('uname')) {
					   					echo Session::get('uname'); } ?>" required />
					</p>
					<p>Password:<br />
					   <input type="password" name="password" placeholder="Password" />
					</p>
					<input type="submit" name="submit" value="Submit" />
				</form>
				<?php
					if (Session::exists('message')) {
						echo "<div class=\"alert alert-danger\" id=\"dontmatch\" >";
						echo Session::get('message');
						Session::delete('message');
						echo "</div>";
					}
				?>
			</div>		<!-- End of loginForm div -->

			<div id="signupForm">		<!-- Beginning of signupForm div> -->
				<form action="../includes/signup.php" method="POST" name="signForm">
					<p>Full Name:<br />
					   <input type="text" name="fullName" placeholder="First Last Name" autofocus autocomplete="off" value="<?php if (Session::exists('full_name')) {
					   							echo Session::get('full_name'); } ?>" />
					</p>
					<p>Username:<br />
					   <input type="text" name="username" placeholder="Username" />
					   <span id="uniqueName"></span>
					</p>
					<p>Password:<br />
					   <input type="password" name="password" placeholder="Password" />
					   <span id="passw"></span>
					</p>
					<p>Confirm password:<br />
					   <input type="password" name="password_again" placeholder="Password confirm" />
					</p>
					<input type="submit" name="submit" value="Submit" />
				</form>
				<?php
					if (Session::exists('missingInfo')) {
						echo "<div class=\"alert alert-danger\" id=\"oops\" >";
						echo Session::get('missingInfo');
						echo "</div>";
						Session::delete('missingInfo');
					}

					if (Session::exists('equal')) {
						echo "<div class=\"alert alert-danger\" id=\"oops\" >";
						echo Session::get('equal');
						echo "</div>";
						Session::delete('equal');
					}

					if (Session::exists('not_unique')){
						echo "<div class=\"alert alert-danger\" id=\"oops\" >";
						echo Session::get('not_unique');
						echo "</div>";
						Session::delete('not_unique');
					}

					if (Session::exists('success')) {
						echo "<div class=\"alert alert-success\" id=\"oops\" >";
						echo Session::get('success');
						echo "</div>";
						Session::delete('success');
						Session::delete('full_name');
					}

					if (Session::exists('user_length')) {
						echo "<div class=\"alert alert-danger\" id=\"oops\" >";
						echo Session::get('user_length');
						echo "</div>";
						Session::delete('user_length');
					}

					if (Session::exists('pass_length')) {
						echo "<div class=\"alert alert-danger\" id=\"oops\" >";
						echo Session::get('pass_length');
						echo "</div>";
						Session::delete('pass_length');
					}
				?>
			</div>		<!-- End of signupForm div -->
		</div>
	</div>	<!-- End of main div -->

</div>

<script src="javascript/script.js"></script>
</body>
</html>