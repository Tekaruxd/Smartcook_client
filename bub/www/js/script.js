const api_url = "http://localhost/bub/app/";
function load(url, element) {
	fetch(url)
		.then((response) => response.text())
		.then((data) => {
			element.innerHTML = data;
		});
}
load(api_url + "recipes.php", document.getElementById("recipes"));

let buttons = document.querySelectorAll("#recipe-category-btns button");
buttons.forEach((button) => {
	button.onclick = () => {
		buttons.forEach((button) => {
			button.classList.remove("active");
		});
		button.classList.add("active");
		let category = button.getAttribute("data-recipe-category");
		load(
			api_url + "recipes.php?recipe-category=" + category,
			document.getElementById("recipeList")
		);
	};
});

document
	.getElementById("darkModeToggle")
	.addEventListener("click", function () {
		document.body.classList.toggle("dark-mode");
	});