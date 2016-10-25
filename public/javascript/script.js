var xhr = createXMLHttpRequestObject();

function createXMLHttpRequestObject() {
	var xhr;
	if (window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	} else {
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xhr;
}

var unique_user = document.signForm.username;
unique_user.addEventListener('blur', checkUsername, false);

/*
 * Checking if username is unique 
 * and if password is strong enough
 * so that user can be notified 
 * whitout page reload
 */
function checkUsername() {
	xhr.open("POST", "../includes/ajaxValidation/ajax_validate.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var provera = document.getElementById('uniqueName');
			console.log(xhr.responseText);
			if (xhr.responseText == 1) {
				if (provera.className == "opomena") {
					provera.innerHTML = "";
				}
			} else {
				provera.className = "opomena";
				provera.innerHTML = "* username already exists";
			}
			if (unique_user.value.length > 20) {
				provera.className = "opomena";
				provera.innerHTML = "* username longer then 20 chars";
			}
		}
	};
	xhr.send("username=" + unique_user.value);
}

var pass = document.signForm.password;
pass.addEventListener('blur', checkPass, false);

function checkPass() {
	var provera = document.getElementById('passw');
	provera.innerHTML = "";
	if (pass.value.length < 8) {
		provera.className = "opomena";
		provera.innerHTML = "* password is too weak";
	}
}


/*
 * This code controls image
 * changing in index.php page
 */

var natureImages = ["1.jpg", "2.jpg", "3.jpg", "4.jpg", "5.jpg"];
var nature = document.getElementById("nature");

setInterval(changeImage, 3000);
var number = 0;
function changeImage() {
	nature.src = "images/" + natureImages[number];
	number++;
	if (number == natureImages.length - 1) {
		number = 0;
	}
}