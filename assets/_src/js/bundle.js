const darkMode = document.querySelector("#dark-mode");
const superDarkMode = document.querySelector("#super-dark-mode");

if (darkMode) {
	darkMode.addEventListener("click", function () {
		alert("Grow up, just read it.");
	});
}

if (superDarkMode) {
	superDarkMode.addEventListener("click", function () {
		document.querySelectorAll("body *").forEach((i) => {
			i.remove();
		});
		document.querySelector("html").style.backgroundColor = "black";
		document.querySelector("html").style.cursor = "help";
	});
}

console.log(
	"%cABANDON HOPE ALL YE WHO ENTER HERE",
	"color: white; background: red; padding: 15px; font-size: 30px; font-weight: bold;"
);
