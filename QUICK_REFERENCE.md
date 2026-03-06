# 🚀 QuickHire Backend - Quick Reference

## Server is Running ✅
- **URL:** http://127.0.0.1:8000
- **Base API:** http://127.0.0.1:8000/api

---

## 📋 Available Endpoints

### Jobs API

```bash
# Get all jobs
GET http://127.0.0.1:8000/api/jobs

# Search jobs
GET http://127.0.0.1:8000/api/jobs?search=developer

# Filter by category
GET http://127.0.0.1:8000/api/jobs?category=Software Development

# Filter by location
GET http://127.0.0.1:8000/api/jobs?location=Dhaka

# Combined filters
GET http://127.0.0.1:8000/api/jobs?search=developer&category=Software Development&location=Dhaka

# Get single job
GET http://127.0.0.1:8000/api/jobs/1

# Create job
POST http://127.0.0.1:8000/api/jobs
Content-Type: application/json
{
  "title": "Job Title",
  "company": "Company Name",
  "location": "Location",
  "category": "Category",
  "description": "Job description..."
}

# Delete job
DELETE http://127.0.0.1:8000/api/jobs/1
```

### Applications API

```bash
# Submit application
POST http://127.0.0.1:8000/api/applications
Content-Type: application/json
{
  "job_id": 1,
  "name": "Your Name",
  "email": "your@email.com",
  "resume_link": "https://your-resume-url.com",
  "cover_note": "Your cover letter..."
}
```

---

## 🧪 Testing

### Option 1: Use Test Script
```powershell
.\test-api.ps1
```

### Option 2: Import Postman Collection
1. Open Postman
2. Import `QuickHire_API.postman_collection.json`
3. Start testing!

### Option 3: Use cURL or PowerShell
```powershell
# Get all jobs
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/jobs" -Method GET

# Search
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/jobs?search=developer" -Method GET

# Create job
$body = @{
    title = "New Job"
    company = "Company"
    location = "Location"
    category = "Category"
    description = "Description"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/jobs" -Method POST -Body $body -ContentType "application/json"
```

---

## 📊 Sample Data

6 jobs are pre-loaded:
1. Senior Full Stack Developer (Dhaka)
2. UI/UX Designer (Remote)
3. DevOps Engineer (Chittagong)
4. Frontend Developer (Dhaka)
5. Project Manager (Dhaka)
6. Data Scientist (Remote)

---

## 📚 Documentation Files

- **README.md** - Complete setup guide
- **API_DOCUMENTATION.md** - Detailed API reference
- **IMPLEMENTATION_COMPLETE.md** - Implementation summary
- **QuickHire_API.postman_collection.json** - Postman collection
- **test-api.ps1** - Automated test script

---

## ✅ Status

✓ Server Running  
✓ Database Connected  
✓ 6 Jobs Seeded  
✓ All Endpoints Working  
✓ Validation Active  
✓ CORS Enabled  

**Ready for frontend integration!**
