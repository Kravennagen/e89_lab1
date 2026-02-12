# Lab 1: Book Management REST API

A simple REST API for managing books, built with PHP.

## Features

- RESTful architecture
- JSON responses
- CRUD operations (Create, Read, Update, Delete)
- Input validation
- Proper HTTP status codes
- JSON file storage

## Project Structure

```
e89_lab1/
├── api/
│   ├── index.php           # Main entry point and routing
│   ├── BookController.php  # Request handling and validation
│   ├── BookModel.php       # Data persistence layer
│   └── .htaccess          # URL rewriting
├── data/
│   └── books.json         # Data storage (auto-generated)
└── README.md
```

## Setup

1. Ensure PHP 7.4+ is installed
2. Place the project in your web server directory
3. Make sure `data/` directory is writable:
   ```bash
   chmod 755 data/
   ```

## Running the API

### Using PHP Built-in Server

```bash
cd e89_lab1/api
php -S localhost:8000
```

The API will be available at: `http://localhost:8000/api/books`

## API Endpoints

### Get All Books
```bash
GET /api/books
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Clean Code",
      "author": "Robert C. Martin",
      "isbn": "978-0132350884",
      "year": 2008
    }
  ],
  "message": "Books retrieved successfully"
}
```

### Get Single Book
```bash
GET /api/books/{id}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Clean Code",
    "author": "Robert C. Martin",
    "isbn": "978-0132350884",
    "year": 2008
  },
  "message": "Book retrieved successfully"
}
```

### Create Book
```bash
POST /api/books
Content-Type: application/json

{
  "title": "The Pragmatic Programmer",
  "author": "Andrew Hunt",
  "isbn": "978-0135957059",
  "year": 2019
}
```

**Response (201 Created):**
```json
{
  "success": true,
  "data": {
    "id": 3,
    "title": "The Pragmatic Programmer",
    "author": "Andrew Hunt",
    "isbn": "978-0135957059",
    "year": 2019
  },
  "message": "Book created successfully"
}
```

### Update Book
```bash
PUT /api/books/{id}
Content-Type: application/json

{
  "title": "Updated Title",
  "author": "Updated Author",
  "isbn": "978-0000000000",
  "year": 2020
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Updated Title",
    "author": "Updated Author",
    "isbn": "978-0000000000",
    "year": 2020
  },
  "message": "Book updated successfully"
}
```

### Delete Book
```bash
DELETE /api/books/{id}
```

**Response:**
```json
{
  "success": true,
  "message": "Book deleted successfully"
}
```

## Testing with cURL

### Get all books
```bash
curl http://localhost:8000/api/books
```

### Get specific book
```bash
curl http://localhost:8000/api/books/1
```

### Create a book
```bash
curl -X POST http://localhost:8000/api/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Refactoring",
    "author": "Martin Fowler",
    "isbn": "978-0134757599",
    "year": 2018
  }'
```

### Update a book
```bash
curl -X PUT http://localhost:8000/api/books/1 \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Clean Code - Updated",
    "author": "Robert C. Martin",
    "isbn": "978-0132350884",
    "year": 2008
  }'
```

### Delete a book
```bash
curl -X DELETE http://localhost:8000/api/books/1
```

## Validation Rules

- **title**: Required (when creating)
- **author**: Required (when creating)
- **isbn**: Optional, must match format: 10-17 digits/hyphens
- **year**: Optional, must be between 1000 and current year

## HTTP Status Codes

- `200 OK`: Successful GET, PUT, DELETE
- `201 Created`: Successful POST
- `400 Bad Request`: Validation errors
- `404 Not Found`: Resource not found
- `405 Method Not Allowed`: Invalid HTTP method

## Error Response Format

```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    "field": "Error detail"
  }
}
```

## Testing Checklist

- [ ] GET all books returns 200 and array
- [ ] GET single book returns 200 and book object
- [ ] GET non-existent book returns 404
- [ ] POST with valid data returns 201 and created book
- [ ] POST with missing required fields returns 400
- [ ] POST with invalid ISBN returns 400
- [ ] PUT with valid data returns 200 and updated book
- [ ] PUT non-existent book returns 404
- [ ] DELETE existing book returns 200
- [ ] DELETE non-existent book returns 404

## GitHub Actions CI/CD

This project includes automated testing with GitHub Actions.

### Workflow Features
- Runs on push/pull request to main branches
- Tests all CRUD endpoints
- Validates HTTP status codes
- Checks error handling
- Automated on every commit

### Setup GitHub Repository

1. Initialize git repository:
```bash
git init
git add .
git commit -m "Initial commit: Book Management API"
```

2. Create GitHub repository and push:
```bash
git remote add origin https://github.com/YOUR_USERNAME/book-api.git
git branch -M main
git push -u origin main
```

3. GitHub Actions will automatically run tests on push

### View Test Results
- Go to your repository on GitHub
- Click on "Actions" tab
- View test results for each commit

## Learning Objectives

✓ Understand REST principles
✓ Handle HTTP methods (GET, POST, PUT, DELETE)
✓ Parse JSON requests and responses
✓ Implement input validation
✓ Use appropriate HTTP status codes
✓ Structure a simple MVC-like architecture
✓ Test APIs with cURL and Postman
✓ Implement CI/CD with GitHub Actions
