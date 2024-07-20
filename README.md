# Blog API

## Setup

1. **Clone the Repository**
    
    ```bash
    bashCopy code
    git clone <repository_url>
    
    ```
    
2. **Install Dependencies**
    
    ```
    Copy code
    composer install
    ```
    
3. **Set Up Environment Variables**
Copy `.env.example` to `.env` and set your database credentials:
    
    ```bash
    bashCopy code
    cp .env.example .env
    ```
    
4. **Generate Application Key**
    
    ```vbnet
    vbnetCopy code
    php artisan key:generate
    ```
    
5. **Run Database Migrations**
    
    ```
    Copy code
    php artisan migrate
    ```
    
6. **Optionally Seed the Database**
    
    ```
    Copy code
    php artisan db:seed
    ```
    
7. **Start the Development Server**
    
    ```
    Copy code
    php artisan serve
    ```
    

## Authentication

To interact with the API endpoints that require authentication (i.e., creating, updating, or deleting posts), you need to provide a JWT token in the `Authorization` header using the Bearer schema. Here’s an example of how to set the authentication header:

- **Header:**
    
    ```makefile
    makefileCopy code
    Authorization: Bearer <your_jwt_token>
    ```
    

Replace `<your_jwt_token>` with the actual JWT token you received after logging in.

## Endpoints

- `GET /api/posts` - List all posts
- `POST /api/posts` - Create a new post
- `GET /api/posts/{id}` - Show a single post
- `PUT /api/posts/{id}` - Update a post
- `DELETE /api/posts/{id}` - Delete a post

### Scheduled Posts

To schedule a post for the future, set the `publish_at` field to a future date and time when creating or updating a post.

## API Documentation

The API is documented using Swagger (OpenAPI). You can view the documentation by visiting:

- `http://localhost:8000/api/documentation` - Swagger UI documentation

## Running Tests

To run the tests, use the following command:

```bash
php artisan test

```

### Test Coverage

The tests include functionality checks for:

- **Retrieving all posts**: Ensures that all posts can be retrieved without errors.
- **Authentication Checks**: Verifies that JWT authentication is required for creating, updating, and deleting posts.

## Example Usage

### Get All Posts

```sql
curl -X GET "http://localhost:8000/api/posts" -H "Authorization: Bearer <your_jwt_token>" -H "Accept: application/json"

```

### Create a New Post

```json
curl -X POST "http://localhost:8000/api/posts" \
     -H "Authorization: Bearer <your_jwt_token>" \
     -H "Content-Type: application/json" \
     -d '{"title": "New Post", "content": "This is a new post.", "author": "Author Name", "publish_at": "2024-07-21T00:00:00Z"}'

```

### Update a Post

```json
curl -X PUT "http://localhost:8000/api/posts/{id}" \
     -H "Authorization: Bearer <your_jwt_token>" \
     -H "Content-Type: application/json" \
     -d '{"title": "Updated Post", "content": "This post has been updated.", "author": "Updated Author", "publish_at": "2024-07-22T00:00:00Z"}'

```

### Delete a Post

```sql
curl -X DELETE "http://localhost:8000/api/posts/{id}" \
     -H "Authorization: Bearer <your_jwt_token>"

```

##
