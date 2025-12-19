<?php
$url = "http://localhost/Nexfore/index.php/api/employees/update/3";

$data = [
    "position" => "Senior Manager",
    "salary" => 60000
];

$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "PUT",
        "content" => json_encode($data),
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
