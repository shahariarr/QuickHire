<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'category',
        'type',
        'description',
    ];

    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
