function verifyAge(isAbove21) {
	if (isAbove21) {
		window.location.href = "registration.html";
	} else {
		document.getElementById("access-message").textContent = "You cannot access this site.";
	}
}
