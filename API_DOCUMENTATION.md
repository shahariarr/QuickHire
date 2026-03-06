# QuickHire API Documentation

## Base URL
```
http://localhost:8000/api
```

## API Endpoints

### Jobs

#### 1. Get All Jobs (with search and filters)
**Endpoint:** `GET /api/jobs`

**Query Parameters:**
- `search` (optional) - Search in title, company, and description
- `category` (optional) - Filter by job category
- `location` (optional) - Filter by location

**Examples:**
```
GET /api/jobs
GET /api/jobs?search=developer
GET /api/jobs?category=Software Development
GET /api/jobs?location=Dhaka
GET /api/jobs?search=developer&category=Software Development&location=Dhaka
```

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Senior Full Stack Developer",
      "company": "Tech Solutions Inc",
      "location": "Dhaka, Bangladesh",
      "category": "Software Development",
      "description": "We are looking for an experienced Full Stack Developer...",
      "created_at": "2024-03-06T10:30:00.000000Z",
      "updated_at": "2024-03-06T10:30:00.000000Z"
    }
  ]
}
```

---

#### 2. Get Single Job
**Endpoint:** `GET /api/jobs/{id}`

**Example:**
```
GET /api/jobs/1
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Senior Full Stack Developer",
    "company": "Tech Solutions Inc",
    "location": "Dhaka, Bangladesh",
    "category": "Software Development",
    "description": "We are looking for an experienced Full Stack Developer...",
    "created_at": "2024-03-06T10:30:00.000000Z",
    "updated_at": "2024-03-06T10:30:00.000000Z"
  }
}
```

**Response (404):**
```json
{
  "success": false,
  "message": "Job not found"
}
```

---

#### 3. Create Job (Admin)
**Endpoint:** `POST /api/jobs`

**Headers:**
```
Content-Type: application/json
```

**Body:**
```json
{
  "title": "Backend Developer",
  "company": "Tech Company",
  "location": "Dhaka, Bangladesh",
  "category": "Software Development",
  "description": "We are looking for a skilled backend developer..."
}
```

**Validation Rules:**
- `title`: required, string, max 255 characters
- `company`: required, string, max 255 characters
- `location`: required, string, max 255 characters
- `category`: required, string, max 255 characters
- `description`: required, string

**Response (201):**
```json
{
  "success": true,
  "message": "Job created successfully",
  "data": {
    "id": 7,
    "title": "Backend Developer",
    "company": "Tech Company",
    "location": "Dhaka, Bangladesh",
    "category": "Software Development",
    "description": "We are looking for a skilled backend developer...",
    "created_at": "2024-03-06T10:35:00.000000Z",
    "updated_at": "2024-03-06T10:35:00.000000Z"
  }
}
```

**Response (422) - Validation Error:**
```json
{
  "message": "The title field is required. (and 2 more errors)",
  "errors": {
    "title": ["The title field is required."],
    "company": ["The company field is required."],
    "description": ["The description field is required."]
  }
}
```

---

#### 4. Delete Job (Admin)
**Endpoint:** `DELETE /api/jobs/{id}`

**Example:**
```
DELETE /api/jobs/1
```

**Response (200):**
```json
{
  "success": true,
  "message": "Job deleted successfully"
}
```

**Response (404):**
```json
{
  "success": false,
  "message": "Job not found"
}
```

---

### Applications

#### 5. Submit Job Application
**Endpoint:** `POST /api/applications`

**Headers:**
```
Content-Type: application/json
```

**Body:**
```json
{
  "job_id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "resume_link": "https://drive.google.com/file/d/abc123/view",
  "cover_note": "I am very interested in this position..."
}
```

**Validation Rules:**
- `job_id`: required, must exist in jobs table
- `name`: required, string, max 255 characters
- `email`: required, valid email format, max 255 characters
- `resume_link`: required, valid URL format, max 500 characters
- `cover_note`: required, string

**Response (201):**
```json
{
  "success": true,
  "message": "Application submitted successfully",
  "data": {
    "id": 1,
    "job_id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "resume_link": "https://drive.google.com/file/d/abc123/view",
    "cover_note": "I am very interested in this position...",
    "created_at": "2024-03-06T10:40:00.000000Z",
    "updated_at": "2024-03-06T10:40:00.000000Z"
  }
}
```

**Response (422) - Validation Error:**
```json
{
  "message": "The email field must be a valid email address. (and 1 more error)",
  "errors": {
    "email": ["The email field must be a valid email address."],
    "resume_link": ["The resume link field must be a valid URL."]
  }
}
```

---

## Testing with Postman

### Import Collection
You can import the following Postman collection to test all endpoints:

1. GET All Jobs: `http://localhost:8000/api/jobs`
2. GET Job by ID: `http://localhost:8000/api/jobs/1`
3. POST Create Job: `http://localhost:8000/api/jobs`
4. DELETE Job: `http://localhost:8000/api/jobs/1`
5. POST Submit Application: `http://localhost:8000/api/applications`

### Sample Test Data

**Create Job Request:**
```json
{
  "title": "Mobile App Developer",
  "company": "Mobile Solutions",
  "location": "Remote",
  "category": "Software Development",
  "description": "We are hiring a talented mobile app developer with experience in React Native or Flutter. You will be responsible for building cross-platform mobile applications."
}
```

**Submit Application Request:**
```json
{
  "job_id": 1,
  "name": "Jane Smith",
  "email": "jane.smith@example.com",
  "resume_link": "https://www.dropbox.com/s/abc123/resume.pdf",
  "cover_note": "I am excited to apply for this position. With 5 years of experience in full-stack development, I believe I would be a great fit for your team."
}
```

---

## Database Schema

### Jobs Table
```sql
- id (bigint, primary key)
- title (varchar 255)
- company (varchar 255)
- location (varchar 255)
- category (varchar 255)
- description (text)
- created_at (timestamp)
- updated_at (timestamp)
```

### Applications Table
```sql
- id (bigint, primary key)
- job_id (bigint, foreign key -> jobs.id, cascade on delete)
- name (varchar 255)
- email (varchar 255)
- resume_link (varchar 255)
- cover_note (text)
- created_at (timestamp)
- updated_at (timestamp)
```

---

## Error Handling

All endpoints return consistent error responses:

**404 Not Found:**
```json
{
  "success": false,
  "message": "Job not found"
}
```

**422 Validation Error:**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

---

## Features Implemented

✅ RESTful API design
✅ Search functionality across title, company, and description
✅ Filter by category and location
✅ Input validation on all endpoints
✅ Email format validation
✅ URL validation for resume links
✅ Foreign key relationships
✅ Cascade delete (deleting a job deletes all its applications)
✅ Clean API response formatting
✅ Proper HTTP status codes
✅ CORS enabled for frontend integration

---

## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd QuickHire
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up database in .env**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=quickhire
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations and seed**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

7. **API is now available at:** `http://localhost:8000/api`
