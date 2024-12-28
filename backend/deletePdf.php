<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Read the incoming JSON payload
$request = json_decode(file_get_contents('php://input'), true);

// Validate if the required parameter is provided
if (!isset($request['pdfUrl'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No PDF URL provided.'
    ]);
    exit;
}

// Get the file path from the provided URL
$pdfUrl = $request['pdfUrl'];

// Ensure the file path is within the allowed directory
$pdfPath = '../' . $pdfUrl; // Adjust the path according to your folder structure

if (file_exists($pdfPath)) {
    // Delete the file
    if (unlink($pdfPath)) {
        echo json_encode([
            'success' => true,
            'message' => 'File deleted successfully.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete the file.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'File does not exist.'.$pdfPath
    ]);
}
?>
