const api_url = "http://localhost/bub/app/";
// Load Recipe/s
function load(url, element) {
	fetch(url)
		.then((response) => response.text())
		.then((data) => {
			element.innerHTML = data;
		});
}
// Request for single reciep
function sendRequest(id) {
	window.open("http://localhost/bub/recipe/?id=" + encodeURIComponent(id));
}
// Filters
function getCheckboxValues() {
	var checkboxes = document.getElementsByName("dish_category"); // Assuming your checkboxes have the name 'checkbox'
	var values = [];

	checkboxes.forEach(function (checkbox) {
		if (checkbox.checked) {
			values.push(parseInt(checkbox.value));
			console.log(values);
		}
	});
	if (values.length === 0) {
		values.push(0);
	}
	return values;
}

load(api_url + "recipes.php", document.getElementById("recipeList"));

// HIDE filters
document.getElementById("filtrhide").addEventListener("click", function () {
	if (filterForm.classList.contains("hidden")) {
		filterForm.classList.remove("hidden");
	} else {
		filterForm.classList.add("hidden");
	}
});

// Toggle Dark Mode
document
	.getElementById("darkModeToggle")
	.addEventListener("click", function () {
		document.body.classList.toggle("dark-mode");
	});
// Filters
filterForm.addEventListener("submit", function (event) {
	// Ziskat checkbox data, udělat z toho list, hodit do load(url+?recipe-category=)
	event.preventDefault();
	filters = getCheckboxValues();
	load(
		api_url + "recipes.php?recipe-category=" + filters[0], // Přidat vice fultru, na print i na get
		document.getElementById("recipeList")
	);
});
