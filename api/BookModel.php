<?php
class BookModel {
    private $dataFile;
    
    public function __construct() {
        $this->dataFile = __DIR__ . '/../data/books.json';
        $this->initializeData();
    }
    
    private function initializeData() {
        if (!file_exists($this->dataFile)) {
            $initialData = [
                [
                    'id' => 1,
                    'title' => 'Clean Code',
                    'author' => 'Robert C. Martin',
                    'isbn' => '978-0132350884',
                    'year' => 2008
                ],
                [
                    'id' => 2,
                    'title' => 'Design Patterns',
                    'author' => 'Gang of Four',
                    'isbn' => '978-0201633610',
                    'year' => 1994
                ]
            ];
            file_put_contents($this->dataFile, json_encode($initialData, JSON_PRETTY_PRINT));
        }
    }
    
    private function readData() {
        return json_decode(file_get_contents($this->dataFile), true);
    }
    
    private function writeData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    
    public function getAll() {
        return $this->readData();
    }
    
    public function getById($id) {
        $books = $this->readData();
        foreach ($books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
        return null;
    }
    
    public function create($data) {
        $books = $this->readData();
        $newId = empty($books) ? 1 : max(array_column($books, 'id')) + 1;
        
        $newBook = [
            'id' => $newId,
            'title' => $data['title'],
            'author' => $data['author'],
            'isbn' => $data['isbn'] ?? null,
            'year' => isset($data['year']) ? (int)$data['year'] : null
        ];
        
        $books[] = $newBook;
        $this->writeData($books);
        
        return $newBook;
    }
    
    public function update($id, $data) {
        $books = $this->readData();
        
        foreach ($books as $key => $book) {
            if ($book['id'] == $id) {
                $books[$key]['title'] = $data['title'] ?? $book['title'];
                $books[$key]['author'] = $data['author'] ?? $book['author'];
                $books[$key]['isbn'] = $data['isbn'] ?? $book['isbn'];
                $books[$key]['year'] = isset($data['year']) ? (int)$data['year'] : $book['year'];
                
                $this->writeData($books);
                return $books[$key];
            }
        }
        
        return null;
    }
    
    public function delete($id) {
        $books = $this->readData();
        
        foreach ($books as $key => $book) {
            if ($book['id'] == $id) {
                array_splice($books, $key, 1);
                $this->writeData($books);
                return true;
            }
        }
        
        return false;
    }
}
