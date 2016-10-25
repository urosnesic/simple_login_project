/*
 * This segment controls effects and 
 * displaying of login and signup forms
 */
$(document).ready(function() {
	$("#loginBtn").click(function() {
		if ($("#signupForm").css("display", "block")) {
			$("#signupForm").css("display", "none");
		}
		$("#loginForm").toggle("slide", 500);
	})

	$("#signupBtn").click(function() {
		if ($("#loginForm").css("display", "block")) {
			$("#loginForm").css("display", "none");
		}
		$("#signupForm").toggle("slide", 500);
	})
});

$(document).ready(function() {
	if ($("#dontmatch").length) {
		$("#loginForm").css("display", "block");
	}

	if ($("#oops").length) {
		$("#signupForm").css("display", "block");
	}
});

/*
 * This segment is in charge
 * for time and date (clock) 
 * in private_page.php
 */
$(document).ready(function() {
	var dayNames = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
	var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	
	var date = new Date();
	var day = dayNames[date.getDay()];
	var dayNumber = date.getDay();
	var month = monthNames[date.getMonth()];
	var year = date.getFullYear();
	
	function clock() {
		var date = new Date();
		var hours = date.getHours();
		var minutes = date.getMinutes();
		var seconds = date.getSeconds();
		$('#clock').html(
			// Add a leading zero
			(hours < 10 ? "0" : "") + hours + " : " + 
			(minutes < 10 ? "0" : "") + minutes + " : " + 
			(seconds < 10 ? "0" : "") + seconds
		);
	}
	setInterval(clock, 1000);
	
	$('#date').html(
		day + " " + dayNumber + " | " + month + " | " + year
	);
	
});
