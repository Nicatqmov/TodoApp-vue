<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
// Add other necessary CORS headers
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Set whether credentials (cookies, authorization headers) should be included in the request
header("Access-Control-Allow-Credentials: true");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require("connection_todo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todoId'])) {

    $todoId = $_POST['todoId'];

    $deleteQuery = "DELETE FROM todos WHERE id = $todoId";

    if ($conn->query($deleteQuery) === TRUE) {

    } else {
        echo json_encode(array("error" => "Error deleting todo: " . $conn->error));
    }

    $query = "SELECT * FROM todos";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            $todos = [];
            while ($row = $result->fetch_assoc()) {
                $todos[] = $row; 
            }
            header('Content-Type: application/json');
            echo json_encode($todos); 
        }else {
            echo json_encode([]); 
        }
       
} 

