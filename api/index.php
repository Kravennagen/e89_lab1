<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'BookController.php';

$controller = new BookController();
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

// Handle preflight requests
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Route: /api/books or /api/books/{id}
if ($uri[0] === 'api' && $uri[1] === 'books') {
    $id = isset($uri[2]) ? (int)$uri[2] : null;
    
    switch ($method) {
        case 'GET':
            if ($id) {
                $controller->getBook($id);
            } else {
                $controller->getAllBooks();
            }
            break;
        case 'POST':
            $controller->createBook();
            break;
        case 'PUT':
            if ($id) {
                $controller->updateBook($id);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Book ID required']);
            }
            break;
        case 'DELETE':
            if ($id) {
                $controller->deleteBook($id);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Book ID required']);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    }
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
}
