<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'] ?? '';
    $type = $_POST['type'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($title) || empty($type) || empty($description)) {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required."
        ]);
    } else {
        

        echo json_encode([
            "success" => true,
            "message" => "Report submitted successfully!"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}
?>

