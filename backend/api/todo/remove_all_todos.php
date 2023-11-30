<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' ){

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