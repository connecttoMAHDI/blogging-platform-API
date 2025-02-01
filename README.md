# Blogging Platform API

## Overview

This is a RESTful API for a blogging platform built with Laravel. It allows users to create, read, update, and delete blogs, categories, and tags. The API supports filtering, validation, and structured responses.
It's a sample solution to the [Blogging platform API](https://roadmap.sh/projects/blogging-platform-api) challenge from [roadmap.sh](https://roadmap.sh).

## Features

- CRUD operations for blogs, categories, and tags.
- Search functionality for blogs based on title, content, and category.
- Automatic tag creation if they don’t exist when creating a blog.
- Structured JSON responses with meaningful status codes.
- SQLite database support.

## API Routes

Here is a brief explanation of the available API routes:

### Blogs

- `GET /api/v1/blogs` - Retrieve all blogs with their category and tags (supports search by term).
- `POST /api/v1/blogs` - Create a new blog (requires title, content, category\_id, and optional tags).
- `GET /api/v1/blogs/{id}` - Retrieve a single blog with category and tags.
- `PUT /api/v1/blogs/{id}` - Update an existing blog.
- `DELETE /api/v1/blogs/{id}` - Delete a blog (removes associated tags as well).

### Categories

- `GET /api/v1/categories` - Retrieve all categories.
- `POST /api/v1/categories` - Create a new category.
- `DELETE /api/v1/categories/{id}` - Delete a category (fails if it's in use).

### Tags

- `GET /api/v1/tags` - Retrieve all tags.
- `DELETE /api/v1/tags/{id}` - Delete a tag (fails if it's in use).

## Installation

Follow these steps to set up and run the API:

1. Clone the repository:

   ```sh
   git clone <repository-url>
   cd blogging-platform-api
   ```

2. Install dependencies:

   ```sh
   composer install
   ```

3. Copy the environment file and configure it:

   ```sh
   cp .env.example .env
   ```

4. Generate the application key:

   ```sh
   php artisan key:generate
   ```

5. Configure the database in `.env` (default uses SQLite, but you can switch to MySQL/PostgreSQL).

6. **Fix Migration Issue:**
   If you encounter issues running migrations, uncomment the following extensions in `php.ini`:

   ```ini
   extension=sqlite3
   extension=pdo_sqlite
   ```

7. Run database migrations:

   ```sh
   php artisan migrate
   ```

8. Run database seeder (Optional):

   ```sh
   php artisan db:seed
   ```

9. Start the development server:

   ```sh
   php artisan serve
   ```

## API Testing with Talend API Tester

A Postman-compatible collection file, `blogging-platform-api.json`, is available in the project root. You can import it into the Talend API Tester Chrome extension for easy testing of API endpoints.

### Steps to Import:

1. Open the Talend API Tester Chrome extension.
2. Click on `Import`.
3. Select `blogging-platform-api.json` from the project root.
4. Start testing the API endpoints.
