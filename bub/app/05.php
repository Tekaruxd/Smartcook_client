<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->setRequestData(["recipe_id" => 8])
        ->sendRequest("recipe")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}