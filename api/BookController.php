<?php
require_once 'BookModel.php';

class BookController {
    private $model;
    
    public function __construct() {
        $this->model = new BookModel();
    }
    
    public function getAllBooks() {
        $books = $this->model->getAll();
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'data' => $books,
            'message' => 'Books retrieved successfully'
        ]);
    }
    
    public function getBook($id) {
        $book = $this->model->getById($id);
        
        if ($book) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'data' => $book,
                'message' => 'Book retrieved successfully'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Book not found'
            ]);
        }
    }
    
    public function createBook() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $errors = $this->validateBook($data);
        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errors
            ]);
            return;
        }
        
        $book = $this->model->create($data);
        http_response_code(201);
        echo json_encode([
            'success' => true,
            'data' => $book,
            'message' => 'Book created successfully'
        ]);
    }
    
    public function updateBook($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $errors = $this->validateBook($data, false);
        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errors
            ]);
            return;
        }
        
        $book = $this->model->update($id, $data);
        
        if ($book) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'data' => $book,
                'message' => 'Book updated successfully'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Book not found'
            ]);
        }
    }
    
    public function deleteBook($id) {
        $result = $this->model->delete($id);
        
        if ($result) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Book deleted successfully'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Book not found'
            ]);
        }
    }
    
    private function validateBook($data, $requireAll = true) {
        $errors = [];
        
        if ($requireAll && empty($data['title'])) {
            $errors['title'] = 'Title is required';
        }
        
        if ($requireAll && empty($data['author'])) {
            $errors['author'] = 'Author is required';
        }
        
        if (isset($data['isbn']) && !preg_match('/^[\d-]{10,17}$/', $data['isbn'])) {
            $errors['isbn'] = 'Invalid ISBN format';
        }
        
        if (isset($data['year']) && (!is_numeric($data['year']) || $data['year'] < 1000 || $data['year'] > date('Y'))) {
            $errors['year'] = 'Invalid year';
        }
        
        return $errors;
    }
}
