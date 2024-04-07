<?php
$tmplt = file_get_contents("view/page.html");
$data = [
    'nav-recipe-category' => file_get_contents("view/nav-recipe-category.html"),
];
foreach ($data as $key => $value) {
    $tmplt = str_replace("{{$key}}", $value, $tmplt);
}
echo $tmplt;