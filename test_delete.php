<?php
$url = "http://localhost/Nexfore/index.php/api/employees/delete/7"; 

$options = [
    "http" => [
        "method" => "DELETE"
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
