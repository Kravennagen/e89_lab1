# e89_lab1
Build a simple REST API for a Book Management System
**Create endpoints for a resource**
* Design a books resource with properties: id, title, author, isbn, year
* Define URI structure: /api/books and /api/books/{id}
* Set up routing to handle different HTTP methods
* Create a simple data storage (array or JSON file)

**Implement GET, POST, PUT, DELETE**
* GET /api/books: Return list of all books
* GET /api/books/{id}: Return specific book details
* POST /api/books: Create a new book (validate required fields)
* PUT /api/books/{id}: Update existing book
* DELETE /api/books/{id}: Remove a book

**Return JSON responses**
* Set Content-Type header to application/json
* Use json_encode() for all responses
* Include appropriate HTTP status codes
* Return success/error messages with data
* Example: {"success": true, "data": {...}, "message": "Book created"}

**Test with Postman/cURL**
* Create a Postman collection with all endpoints
* Test each CRUD operation
* Verify status codes and response format
* Test error cases (invalid data, non-existent resources)
* Use cURL commands for command-line testing
