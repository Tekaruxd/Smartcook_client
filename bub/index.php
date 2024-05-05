<?php
$tmplt = file_get_contents("view/page.html");
$data = [
    'filters' => file_get_contents("view/filters.html"),
];
foreach ($data as $key => $value) {
    $tmplt = str_replace("{{$key}}", $value, $tmplt);
}
echo $tmplt;