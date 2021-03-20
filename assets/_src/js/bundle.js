const darkMode = document.querySelector("#dark-mode");
const superDarkMode = document.querySelector("#super-dark-mode");

if (darkMode) {
	darkMode.addEventListener("click", function () {
		alert("Grow up, just read it.");
	});
}

if (superDarkMode) {
	superDarkMode.addEventListener("click", function () {
		document.querySelectorAll("*").forEach((i) => {
			i.style.opacity = "0";
		});
		document.querySelector("html").style.backgroundColor = "black";
	});
}
