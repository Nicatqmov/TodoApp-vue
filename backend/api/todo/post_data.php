<?php

require("cosr.php");
require("connection_todo.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['todoContent'])) {
        $todoContent = $_POST['todoContent'];
        $username = 'nicat'; 

        $sql = "INSERT INTO todos (content, username) VALUES ('$todoContent', '$username')";
        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


        $query = "SELECT * FROM todos";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            $todos = [];
            while ($row = $result->fetch_assoc()) {
                $todos[] = $row; 
            }
        }else {
            echo json_encode([]); 
        }
        header('Content-Type: application/json');
        echo json_encode($todos); 
    } else {
        http_response_code(400); 
        echo "Invalid data received";
    }
} else {
    http_response_code(400); 
    echo "Invalid request method";
}
?>