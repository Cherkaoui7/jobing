<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

$jar = new CookieJar();
$client = new Client(['cookies' => $jar, 'allow_redirects' => false]);

// 1. Get CSRF token
$response = $client->get('http://127.0.0.1:8000/login');
$html = $response->getBody()->getContents();
preg_match('/<meta name="csrf-token" content="([^"]+)">/', $html, $matches);
$csrfToken = $matches[1];

// 2. Set DB connection
$client->post('http://127.0.0.1:8000/set-database', [
    'form_params' => [
        '_token' => $csrfToken,
        'db_connection' => 'sqlite'
    ]
]);

// 3. Login
$response = $client->post('http://127.0.0.1:8000/login', [
    'form_params' => [
        '_token' => $csrfToken,
        'email' => 'admin@admin.com', // Try admin email or guess
        'password' => 'password123',
    ]
]);

echo "Login Response Status: " . $response->getStatusCode() . "\n";
echo "Login Redirect: " . $response->getHeaderLine('Location') . "\n";

// 4. Hit account overview
$response = $client->get('http://127.0.0.1:8000/account/overview');
echo "Overview Status: " . $response->getStatusCode() . "\n";
echo "Overview Redirect: " . $response->getHeaderLine('Location') . "\n";

