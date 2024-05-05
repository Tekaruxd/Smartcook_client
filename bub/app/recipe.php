<?php
// input example http://localhost/bub/app/recipe.php?id=8
require_once("SmartCookClient.php");

$id = filter_input(INPUT_GET, "id");
$request_data = ["recipe_id" => $id];
try {
    $data = (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipe")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
$recipes = "";
$tmpltRecipe = file_get_contents("../view/single_recipe.html");

$recipe = $data['data'];
$recipes .= str_replace(
    ["{name}", "{difficulty}", "{price}", "{dish_category}", "{recipe_category}", "{country}", "{tolerance}",  "{description}", "{author}"],
    [ucfirst($recipe["name"]), $recipe["difficulty"], $recipe["price"], implode(", ", $recipe["dish_category"]), implode(", ", $recipe["recipe_category"]), $recipe["country"],implode(", ", $recipe["tolerance"]),   $recipe["description"], $recipe["author"]],
    $tmpltRecipe
);

echo $recipes;

// "{}",  $recipe[""] implode(", ", $recipe["ingredient"]), $recipe["tolerance"], "{tolerance}", "{ingredient}",
