<?php
// input example http://localhost/bub/app/recipes.php?recipe-category=2,3
require_once ("SmartCookClient.php");
$request_data = ["attributes" => ["id","name","difficulty", "duration", "price", "description", "author"]];
$filters_input = filter_input(INPUT_GET, "recipe-category", FILTER_SANITIZE_STRING); // /* dish_category, recipe_category, difficulty, price, price, ingredient*/   
$filters_array = array_map('floatval', explode(',',$filters_input));

if ($filters_input) {
    $request_data["filter"]["recipe_category"] = $filters_array;
}
try {
    $data = (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
$maxlen = 100;
$recipes = "";
$tmpltRecipe = file_get_contents("../view/recipe.html");
foreach ($data['data'] as $recipe) {
    if (mb_strlen($recipe["description"]) > $maxlen) {
        $desc = mb_substr($recipe["description"], 0, $maxlen) . " ...";
    }
    $recipes .= str_replace(
        ["{id}","{name}","{difficulty}","{price}", "{description}", "{author}"],
        [ucfirst($recipe["id"]),$recipe["name"],$recipe["difficulty"],$recipe["price"], $desc, $recipe["author"]],
        $tmpltRecipe
    );
}
echo $recipes;
