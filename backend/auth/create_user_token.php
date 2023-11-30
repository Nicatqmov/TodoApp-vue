<?php
require_once 'vendor/autoload.php'; // Include the Composer autoloader

use \Firebase\JWT\JWT;

// Your secret key for signing the token (keep this secure and do not expose it)
$secretKey = 'qz3#fN$g2P@L!sT9&dE5*rVp';

// Sample user data (replace this with your user data)
$userData = array(
    "id" => 123,
    "username" => "exampleuser"
);

// Set token payload with user data
$tokenPayload = array(
    "data" => $userData,
    "iat" => time(), // Issued at time (current timestamp)
    "exp" => time() + (60 * 60) // Expiration time (1 hour from now)
);

$algorithm = 'HS256'; // Replace with your desired algorithm
// Generate the JWT token
try {
    // Generate the JWT token
    $token = JWT::encode($tokenPayload, $secretKey, $algorithm);

} catch (\Exception $e) {
    echo 'Token generation error: ' . $e->getMessage();
}

// Output the token (this token should be sent to the client and stored securely)
echo $token;
?>
