# GitHub Actions Setup Guide

## What is GitHub Actions?

GitHub Actions is a CI/CD (Continuous Integration/Continuous Deployment) platform that allows you to automate your build, test, and deployment pipeline.

## What This Workflow Does

The `.github/workflows/test.yml` file automatically:

1. **Triggers on**:
   - Push to main/master/develop branches
   - Pull requests to main/master/develop branches

2. **Test Steps**:
   - Sets up PHP 8.1 environment
   - Starts the PHP development server
   - Runs all API endpoint tests
   - Validates HTTP status codes
   - Tests error handling

3. **Tests Performed**:
   - ✓ GET all books (200)
   - ✓ GET single book (200)
   - ✓ POST create book (201)
   - ✓ PUT update book (200)
   - ✓ DELETE book (200)
   - ✓ GET non-existent book (404)
   - ✓ POST with validation error (400)

## How to Use

### 1. Push to GitHub

```bash
# Initialize repository
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit: Book Management API with CI/CD"

# Add remote (replace with your repository URL)
git remote add origin https://github.com/YOUR_USERNAME/book-api.git

# Push to GitHub
git branch -M main
git push -u origin main
```

### 2. View Test Results

1. Go to your GitHub repository
2. Click on the **"Actions"** tab
3. You'll see your workflow runs
4. Click on any run to see detailed test results

### 3. Add Status Badge (Optional)

Add this to the top of your README.md:

```markdown
![API Tests](https://github.com/YOUR_USERNAME/book-api/workflows/API%20Tests/badge.svg)
```

Replace `YOUR_USERNAME` and `book-api` with your actual GitHub username and repository name.

## Workflow File Explanation

```yaml
name: API Tests                    # Workflow name
on:
  push:
    branches: [ main, master ]     # Trigger on push to these branches
  pull_request:
    branches: [ main, master ]     # Trigger on PR to these branches

jobs:
  test:
    runs-on: ubuntu-latest         # Use Ubuntu runner
    
    steps:
    - uses: actions/checkout@v3    # Checkout code
    - uses: shivammathur/setup-php@v2  # Setup PHP
      with:
        php-version: '8.1'         # PHP version
    
    - name: Start PHP server       # Start development server
      run: php -S localhost:8000 &
    
    - name: Run tests              # Execute tests
      run: ./test_api.sh
```

## Benefits

✅ **Automated Testing**: Tests run automatically on every push
✅ **Early Bug Detection**: Catch issues before they reach production
✅ **Code Quality**: Ensure all endpoints work correctly
✅ **Documentation**: Test results serve as living documentation
✅ **Confidence**: Deploy with confidence knowing tests pass

## Troubleshooting

### Tests Failing?

1. Check the Actions tab for error messages
2. Ensure all files are committed
3. Verify test_api.sh has execute permissions
4. Check PHP syntax errors

### Workflow Not Running?

1. Ensure `.github/workflows/test.yml` exists
2. Check branch names match (main vs master)
3. Verify you have Actions enabled in repository settings

## Next Steps

- Add more comprehensive tests
- Implement code coverage reporting
- Add deployment steps
- Set up notifications for failed tests
- Add database integration tests

## Resources

- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [PHP Setup Action](https://github.com/shivammathur/setup-php)
- [Workflow Syntax](https://docs.github.com/en/actions/reference/workflow-syntax-for-github-actions)
