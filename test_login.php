<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::create(
        '/login',
        'POST',
        [
            'email' => 'user@example.com', // guess an email, or I can just create one
            'password' => 'password',
        ]
    )
);

echo "Status: " . $response->getStatusCode() . "\n";
echo "Location: " . $response->headers->get('Location') . "\n";

