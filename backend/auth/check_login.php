<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username']; 
        $password = $_POST['password']; 

        $_SESSION['user'] = $username;
        header('Content-Type: application/json');
        echo json_encode($username); 
    } 
} 
