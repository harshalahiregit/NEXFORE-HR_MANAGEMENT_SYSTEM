<?php
$url = "http://localhost/Nexfore/index.php/api/employees/store";

$data = [
    "name" => "TOKEN Test User ",
    "email" => "testuserwithTOKEN@gmail.com",
    "department_id" => 2,
    "position" => "Tester",
    "salary" => 35000
];



// Without TOKEN
// $options = [
//     "http" => [
//         "header"  => "Content-Type: application/json",
//         "method"  => "POST",
//         "content" => json_encode($data),
//     ]
// ];


//With TOKEN
$options = [
    "http" => [
        "header"  => [
            "Content-Type: application/json",
            "Api-Key: NEXFORE123456"
        ],
        "method"  => "POST",
        "content" => json_encode($data),
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
