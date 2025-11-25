<?php
require 'vendor/autoload.php';

$client = \Config\Services::curlrequest();
$response = $client->post('http://localhost:8080/admin/authenticate', [
    'form_params' => [
        'username' => 'admin',
        'password' => 'admin123',
    ],
    'allow_redirects' => false,
]);

echo "Status: " . $response->getStatusCode() . PHP_EOL;

echo "Body: " . $response->getBody() . PHP_EOL;
?>
