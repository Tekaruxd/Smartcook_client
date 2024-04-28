<?php
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
$tmpltRecipe = file_get_contents("../view/recipe_page.html");

$recipe = $data['data'];
$recipes .= str_replace(
        ["{name}","{difficulty}","{price}", "{description}", "{author}"],
        [ucfirst($recipe["name"]),$recipe["difficulty"],$recipe["price"], $recipe["description"], $recipe["author"]],
        $tmpltRecipe
    );

echo $recipes;


