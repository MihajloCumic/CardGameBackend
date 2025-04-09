<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

//$response = [
//    "status" => "Success.",
//    "message" => "It is working",
//    "data" => [
//        'user' => 'username',
//        'email' => 'username@email.com'
//    ]
//];
//header('Content-Type: application/json');
//echo json_encode($response);

$app = new \App\App();
$res = (new \App\Controllers\CardController())->getCards();
print_r($res);