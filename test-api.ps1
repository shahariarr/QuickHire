# QuickHire API Test Script

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "   QuickHire API Test Results" -ForegroundColor Cyan
Write-Host "========================================`n" -ForegroundColor Cyan

$baseUrl = "http://127.0.0.1:8000/api"

# Test 1: Get All Jobs
Write-Host "[TEST 1] GET /api/jobs - Fetching all jobs..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/jobs" -Method GET -Headers @{"Accept"="application/json"}
    Write-Host "✓ Success" -ForegroundColor Green
    Write-Host "  Total Jobs: $($response.data.Count)" -ForegroundColor White
    Write-Host "  Sample Job: $($response.data[0].title) at $($response.data[0].company)" -ForegroundColor White
} catch {
    Write-Host "✗ Failed: $_" -ForegroundColor Red
}

Start-Sleep -Seconds 1

# Test 2: Search Jobs
Write-Host "`n[TEST 2] GET /api/jobs?search=developer - Search functionality..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/jobs?search=developer" -Method GET -Headers @{"Accept"="application/json"}
    Write-Host "✓ Success" -ForegroundColor Green
    Write-Host "  Found Jobs: $($response.data.Count)" -ForegroundColor White
} catch {
    Write-Host "✗ Failed: $_" -ForegroundColor Red
}

Start-Sleep -Seconds 1

# Test 3: Filter by Category
Write-Host "`n[TEST 3] GET /api/jobs?category=Software Development - Filter by category..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/jobs?category=Software Development" -Method GET -Headers @{"Accept"="application/json"}
    Write-Host "✓ Success" -ForegroundColor Green
    Write-Host "  Jobs in Software Development: $($response.data.Count)" -ForegroundColor White
} catch {
    Write-Host "✗ Failed: $_" -ForegroundColor Red
}

Start-Sleep -Seconds 1

# Test 4: Get Single Job
Write-Host "`n[TEST 4] GET /api/jobs/1 - Get job details..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/jobs/1" -Method GET -Headers @{"Accept"="application/json"}
    Write-Host "✓ Success" -ForegroundColor Green
    Write-Host "  Job: $($response.data.title)" -ForegroundColor White
    Write-Host "  Company: $($response.data.company)" -ForegroundColor White
} catch {
    Write-Host "✗ Failed: $_" -ForegroundColor Red
}

Start-Sleep -Seconds 1

# Test 5: Create New Job
Write-Host "`n[TEST 5] POST /api/jobs - Create new job..." -ForegroundColor Yellow
try {
    $body = @{
        title = "Test Backend Developer"
        company = "Test Company Inc"
        location = "Dhaka, Bangladesh"
        category = "Software Development"
        description = "This is a test job posting created via API"
    } | ConvertTo-Json

    $response = Invoke-RestMethod -Uri "$baseUrl/jobs" -Method POST -Body $body -ContentType "application/json" -Headers @{"Accept"="application/json"}
    Write-Host "✓ Success" -ForegroundColor Green
    Write-Host "  Created Job ID: $($response.data.id)" -ForegroundColor White
    Write-Host "  Job Title: $($response.data.title)" -ForegroundColor White
    $newJobId = $response.data.id
} catch {
    Write-Host "✗ Failed: $_" -ForegroundColor Red
    $newJobId = $null
}

Start-Sleep -Seconds 1

# Test 6: Submit Application
Write-Host "`n[TEST 6] POST /api/applications - Submit job application..." -ForegroundColor Yellow
try {
    $body = @{
        job_id = 1
        name = "Test Applicant"
        email = "test@example.com"
        resume_link = "https://drive.google.com/file/d/test123/view"
        cover_note = "This is a test application submitted via API"
    } | ConvertTo-Json

    $response = Invoke-RestMethod -Uri "$baseUrl/applications" -Method POST -Body $body -ContentType "application/json" -Headers @{"Accept"="application/json"}
    Write-Host "✓ Success" -ForegroundColor Green
    Write-Host "  Application ID: $($response.data.id)" -ForegroundColor White
    Write-Host "  Applicant: $($response.data.name)" -ForegroundColor White
} catch {
    Write-Host "✗ Failed: $_" -ForegroundColor Red
}

Start-Sleep -Seconds 1

# Test 7: Delete Job (if we created one)
if ($newJobId) {
    Write-Host "`n[TEST 7] DELETE /api/jobs/$newJobId - Delete test job..." -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/jobs/$newJobId" -Method DELETE -Headers @{"Accept"="application/json"}
        Write-Host "✓ Success" -ForegroundColor Green
        Write-Host "  Message: $($response.message)" -ForegroundColor White
    } catch {
        Write-Host "✗ Failed: $_" -ForegroundColor Red
    }
}

# Test 8: Validation Error Test
Write-Host "`n[TEST 8] POST /api/applications - Test validation (should fail)..." -ForegroundColor Yellow
try {
    $body = @{
        job_id = 999999
        name = ""
        email = "invalid-email"
        resume_link = "not-a-url"
        cover_note = ""
    } | ConvertTo-Json

    $response = Invoke-RestMethod -Uri "$baseUrl/applications" -Method POST -Body $body -ContentType "application/json" -Headers @{"Accept"="application/json"}
    Write-Host "✗ Test Failed: Should have returned validation errors" -ForegroundColor Red
} catch {
    Write-Host "✓ Validation working correctly" -ForegroundColor Green
    Write-Host "  Returned expected validation errors" -ForegroundColor White
}

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "   All Tests Completed!" -ForegroundColor Cyan
Write-Host "========================================`n" -ForegroundColor Cyan
