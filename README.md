# QuickHire - Job Board Application Backend

A RESTful API built with Laravel for a job board application. This backend supports job listings management, job applications, search functionality, and filtering capabilities.

## 📋 Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [API Documentation](#api-documentation)
- [Database Schema](#database-schema)
- [Testing with Postman](#testing-with-postman)
- [Project Structure](#project-structure)

## ✨ Features

- ✅ **Job Listings Management**
  - Create, read, and delete job postings
  - Full job details including title, company, location, category, and description

- ✅ **Advanced Search & Filtering**
  - Search jobs by title, company, or description
  - Filter by category (Software Development, Design, DevOps, etc.)
  - Filter by location

- ✅ **Job Applications**
  - Submit applications with name, email, resume link, and cover note
  - Applications linked to specific jobs via foreign keys

- ✅ **Data Validation**
  - Required field validation on all endpoints
  - Email format validation
  - URL validation for resume links
  - Proper error messages with validation feedback

- ✅ **Best Practices**
  - RESTful API design
  - Clean code structure
  - Eloquent ORM relationships
  - Database migrations and seeders
  - CORS enabled for frontend integration
  - Consistent JSON response format

## 🛠 Tech Stack

- **Framework:** Laravel 10.x
- **Language:** PHP 8.1+
- **Database:** MySQL
- **API Type:** RESTful JSON API

## 📦 Installation

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL
- Git

### Setup Steps

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

4. **Set up database**
   
   Update your `.env` file with database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=quickhire
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Create database**
   ```bash
   mysql -u root -e "CREATE DATABASE quickhire CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```

6. **Run migrations and seed data**
   ```bash
   php artisan migrate:fresh --seed
   ```
   
   This will create the database tables and populate 6 sample job listings.

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **API is now available at:** `http://localhost:8000/api`

## 📚 API Documentation

### Base URL
```
http://localhost:8000/api
```

### Endpoints

#### Jobs

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/jobs` | Get all jobs (supports search & filters) |
| GET | `/api/jobs/{id}` | Get single job details |
| POST | `/api/jobs` | Create a new job (Admin) |
| DELETE | `/api/jobs/{id}` | Delete a job (Admin) |

#### Applications

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/applications` | Submit a job application |

### Query Parameters for GET /api/jobs

- `search` - Search in title, company, and description
- `category` - Filter by job category
- `location` - Filter by location

**Examples:**
```
GET /api/jobs?search=developer
GET /api/jobs?category=Software Development
GET /api/jobs?location=Dhaka
GET /api/jobs?search=developer&category=Software Development
```

### Sample Request Bodies

**Create Job (POST /api/jobs):**
```json
{
  "title": "Backend Developer",
  "company": "Tech Company",
  "location": "Dhaka, Bangladesh",
  "category": "Software Development",
  "description": "We are looking for a skilled backend developer..."
}
```

**Submit Application (POST /api/applications):**
```json
{
  "job_id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "resume_link": "https://drive.google.com/file/d/abc123/view",
  "cover_note": "I am very interested in this position..."
}
```

### Sample Responses

**Success Response (200/201):**
```json
{
  "success": true,
  "message": "Job created successfully",
  "data": {
    "id": 1,
    "title": "Backend Developer",
    "company": "Tech Company",
    "location": "Dhaka, Bangladesh",
    "category": "Software Development",
    "description": "We are looking for a skilled backend developer...",
    "created_at": "2024-03-06T10:30:00.000000Z",
    "updated_at": "2024-03-06T10:30:00.000000Z"
  }
}
```

**Validation Error (422):**
```json
{
  "message": "The email field must be a valid email address.",
  "errors": {
    "email": ["The email field must be a valid email address."],
    "resume_link": ["The resume link field must be a valid URL."]
  }
}
```

**Not Found (404):**
```json
{
  "success": false,
  "message": "Job not found"
}
```

For complete API documentation, see [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

## 🗄 Database Schema

### Jobs Table
```sql
- id (bigint, primary key, auto-increment)
- title (varchar 255, required)
- company (varchar 255, required)
- location (varchar 255, required)
- category (varchar 255, required)
- description (text, required)
- created_at (timestamp)
- updated_at (timestamp)
```

### Applications Table
```sql
- id (bigint, primary key, auto-increment)
- job_id (bigint, foreign key -> jobs.id, cascade on delete)
- name (varchar 255, required)
- email (varchar 255, required, email format)
- resume_link (varchar 255, required, URL format)
- cover_note (text, required)
- created_at (timestamp)
- updated_at (timestamp)
```

**Relationship:** One Job has many Applications (One-to-Many)

## 🧪 Testing with Postman

### Import Postman Collection

1. Open Postman
2. Click **Import** button
3. Select the file: `QuickHire_API.postman_collection.json`
4. All endpoints will be imported and ready to test

### Sample Test Scenarios

#### 1. Get All Jobs
```
GET http://localhost:8000/api/jobs
```

#### 2. Search for Developer Jobs
```
GET http://localhost:8000/api/jobs?search=developer
```

#### 3. Filter by Category
```
GET http://localhost:8000/api/jobs?category=Software Development
```

#### 4. Create a New Job
```
POST http://localhost:8000/api/jobs
Content-Type: application/json

{
  "title": "Mobile App Developer",
  "company": "Mobile Solutions",
  "location": "Remote",
  "category": "Software Development",
  "description": "Hiring mobile app developer with React Native experience..."
}
```

#### 5. Submit Application
```
POST http://localhost:8000/api/applications
Content-Type: application/json

{
  "job_id": 1,
  "name": "Jane Smith",
  "email": "jane@example.com",
  "resume_link": "https://www.dropbox.com/s/abc123/resume.pdf",
  "cover_note": "I am excited to apply for this position..."
}
```

## 📁 Project Structure

```
QuickHire/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── JobController.php
│   │   │       └── ApplicationController.php
│   │   └── Requests/
│   │       ├── StoreJobRequest.php
│   │       └── StoreApplicationRequest.php
│   └── Models/
│       ├── Job.php
│       └── Application.php
├── database/
│   ├── migrations/
│   │   ├── 2024_03_06_000001_create_jobs_table.php
│   │   └── 2024_03_06_000002_create_applications_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── JobSeeder.php
├── routes/
│   └── api.php
├── API_DOCUMENTATION.md
├── QuickHire_API.postman_collection.json
└── README.md
```

### Key Files

- **JobController.php** - Handles all job-related operations (CRUD)
- **ApplicationController.php** - Handles job application submissions
- **StoreJobRequest.php** - Validation rules for creating jobs
- **StoreApplicationRequest.php** - Validation rules for submitting applications
- **Job.php** - Job model with relationship to applications
- **Application.php** - Application model with relationship to jobs
- **api.php** - API route definitions

## 🎯 Validation Rules

### Creating a Job
- `title`: Required, max 255 characters
- `company`: Required, max 255 characters
- `location`: Required, max 255 characters
- `category`: Required, max 255 characters
- `description`: Required

### Submitting an Application
- `job_id`: Required, must exist in jobs table
- `name`: Required, max 255 characters
- `email`: Required, valid email format, max 255 characters
- `resume_link`: Required, valid URL format, max 500 characters
- `cover_note`: Required

## 🚀 Sample Data

The seeder creates 6 sample jobs:
1. Senior Full Stack Developer - Tech Solutions Inc (Dhaka)
2. UI/UX Designer - Creative Studio (Remote)
3. DevOps Engineer - Cloud Systems Ltd (Chittagong)
4. Frontend Developer - Digital Agency (Dhaka)
5. Project Manager - Qtec Solution Limited (Dhaka)
6. Data Scientist - Analytics Corp (Remote)

## 📝 Notes

- **No Authentication:** As per requirements, no authentication/authorization is implemented
- **CORS Enabled:** Frontend can make requests from any origin
- **Cascade Delete:** Deleting a job automatically deletes all its applications
- **Clean Responses:** All API responses follow a consistent format

## 🔗 Related Files

- [Complete API Documentation](API_DOCUMENTATION.md)
- [Postman Collection](QuickHire_API.postman_collection.json)

## 📞 Support

For any questions or issues, please create an issue in the repository.

---

**Built with ❤️ using Laravel**
