# Test-Driven-Development-API-Project


## Project Overview
This project covers the creation of a Laravel API using Test-Driven Development (TDD). It includes API creation, testing, database interaction, authentication, and integration with Google Drive API.

## Tasks

**1. Setting Up the Environment**

- Install Laravel 10
- Write the first test for the API
- Implement Test-Driven Development (TDD)

**2. API Development & Testing**

- Write tests to create the API
- Ensure tests pass (Green state)
- Connect API with the database
- Fetch data from the database
- Use factories for generating test data
- Retrieve a single list in API

**3. Building a To-Do List API**
- Implement route model binding
- Write tests for route model binding
- Store new to-do lists in the database
- Validate API requests
- Implement CRUD operations (Create, Read, Update, Delete)
- Use API resource routes for better routing
- Test API using Postman

**4. Managing Tasks in the To-Do List**

- Create tasks under a to-do list
- Store, update, and delete tasks
- Implement shallow API resources
- Establish and test relationships (hasMany)
- Verify task completion status
- Ensure deleting a list removes associated tasks


**5. Implementing Authentication**

- Create API for user registration and login
- Use Laravel Sanctum for authentication
- Protect routes using Sanctum middleware
- Secure all API endpoints



**6. Adding Labels to Tasks**

- Implement task labels (e.g., personal, work-related)
- Associate labels with tasks
- Write tests for label functionality


**7. Integrating Google Drive API**

- Upload last 7 days of tasks to Google Drive
- Authenticate with Google Drive API
- Handle Google API callbacks
- Mock Google Client API in tests
- Implement dependency injection for mocking
- Simulate file upload in testing environment


**8. Uploading & Managing Files in Google Drive**

- Create a zip file of tasks
- Upload zip files to Google Drive
- Test file uploads using Postman
- Implement API content transformation
- Refactor Google Drive service implementation


**9. Finalizing API Development**

- Implement API resource transformation (Laravel resources)
- Refactor and improve overall API structure
- Ensure all tests pass successfully


**10. Testing and Deployment**

- Write comprehensive tests (68 assertions in 29 tests)
- Run tests to verify API functionality
- Deploy the API and validate performance


## Tools Used

- Laravel 10
- PHPUnit for testing
- Postman for API testing
- Laravel Sanctum for authentication
- Google Drive API for external storage
- API Artisan for quick API generation
