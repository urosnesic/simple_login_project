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

