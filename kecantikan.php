<?php
require_once('./vendor/autoload.php');

use Firebase\JWT\JWT;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  http_response_code(405);
  exit();
}

$headers = getallheaders();


if (!isset($headers['Authorization'])) {
  http_response_code(401);
  exit();
}


list(, $token) = explode(' ', $headers['Authorization']);

try {
  
  JWT::decode($token, $_ENV['ACCESS_TOKEN_SECRET'], ['HS256']);
  
  $kecantikam = [
    [
      'merk' => 'wardah',
      'expire' => 'desember'
    ],
    [
      'merk' => 'msglow',
      'expire' => 'agustus'
    ]
 
  ];


  echo json_encode($kecantikan);
} catch (Exception $e) {
  
  http_response_code(401);
  exit();
}
