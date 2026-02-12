#!/bin/bash

# Book Management API Test Script
# Run this after starting the PHP server: php -S localhost:8000

BASE_URL="http://localhost:8000/api/books"

echo "========================================="
echo "Book Management API - Test Suite"
echo "========================================="
echo ""

# Test 1: Get all books
echo "Test 1: GET all books"
curl -s -X GET "$BASE_URL" | json_pp
echo -e "\n"

# Test 2: Get specific book
echo "Test 2: GET book with ID 1"
curl -s -X GET "$BASE_URL/1" | json_pp
echo -e "\n"

# Test 3: Create a new book
echo "Test 3: POST - Create new book"
curl -s -X POST "$BASE_URL" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Refactoring",
    "author": "Martin Fowler",
    "isbn": "978-0134757599",
    "year": 2018
  }' | json_pp
echo -e "\n"

# Test 4: Update a book
echo "Test 4: PUT - Update book ID 1"
curl -s -X PUT "$BASE_URL/1" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Clean Code - Updated",
    "author": "Robert C. Martin",
    "isbn": "978-0132350884",
    "year": 2008
  }' | json_pp
echo -e "\n"

# Test 5: Get all books after update
echo "Test 5: GET all books (after update)"
curl -s -X GET "$BASE_URL" | json_pp
echo -e "\n"

# Test 6: Invalid request - missing required field
echo "Test 6: POST - Invalid (missing title)"
curl -s -X POST "$BASE_URL" \
  -H "Content-Type: application/json" \
  -d '{
    "author": "Test Author",
    "year": 2020
  }' | json_pp
echo -e "\n"

# Test 7: Get non-existent book
echo "Test 7: GET non-existent book (ID 9999)"
curl -s -X GET "$BASE_URL/9999" | json_pp
echo -e "\n"

# Test 8: Delete a book
echo "Test 8: DELETE book ID 2"
curl -s -X DELETE "$BASE_URL/2" | json_pp
echo -e "\n"

# Test 9: Verify deletion
echo "Test 9: GET all books (after deletion)"
curl -s -X GET "$BASE_URL" | json_pp
echo -e "\n"

echo "========================================="
echo "Test Suite Complete"
echo "========================================="
